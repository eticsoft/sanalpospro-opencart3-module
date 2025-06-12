<?php


require_once DIR_CATALOG . 'controller/extension/payment/sanalpospro/vendor/inc.php';

use Eticsoft\Paythor\Sanalpospro\InternalApi;
use Eticsoft\Paythor\Sanalpospro\Payment;
use Eticsoft\Paythor\Sanalpospro\EticConfig;

class ControllerExtensionPaymentSanalpospro extends Controller
{
    public function install()
    {
        $this->load->model('setting/setting');
        $this->load->model('setting/extension');
        $this->load->model('setting/event');
        $this->version = "10.0.1";

        // Event eklemek
        $this->model_setting_event->addEvent(
            'sanalpospro_product_installment_tab',
            'catalog/view/product/product/after',
            'extension/payment/sanalpospro/addProductTab',
            1, // Status
            10 // Sort order
        );

        $this->model_setting_event->addEvent(
            'sanalpospro_admin_order',
            'admin/view/sale/order_info/before',
            'extension/payment/sanalpospro/addOrderInfo',
            1, // Status
            10 // Sort order
        );

        // Ödeme ayarlarını eklemek
        $xfvv = hash('sha256', time() . rand(1000000, 9999999));
        $this->model_setting_setting->editSetting('payment_sanalpospro', [
            'payment_sanalpospro_order_status' => 2,
            'payment_sanalpospro_currency_convert' => 'no',
            'payment_sanalpospro_showInstallmentsTabs' => 'no',
            'payment_sanalpospro_paymentPageTheme' => 'classic',
            'payment_sanalpospro_installments' => '{}',
            'payment_sanalpospro_status' => 1,
            'payment_sanalpospro_public_key' => '',
            'payment_sanalpospro_secret_key' => '',
            'payment_sanalpospro_xfvv' => $xfvv,
        ]);

        // Extension'ı yüklemek
        $this->model_setting_extension->install('payment', 'sanalpospro');
    }

    public function uninstall()
    {
        $this->load->model('setting/setting');
        $this->load->model('setting/extension');
        $this->load->model('setting/event');
        $this->model_setting_event->deleteEventByCode('sanalpospro_product_installment_tab');
        $this->model_setting_event->deleteEventByCode('sanalpospro_admin_order');
        $this->model_setting_setting->deleteSetting('payment_sanalpospro');
        $this->model_setting_extension->uninstall('payment', 'sanalpospro');
    }


    public function index()
    {
        $this->load->language('extension/payment/sanalpospro');

        $this->document->setTitle($this->language->get('heading_title'));
        $this->load->model('setting/setting');
        $this->load->model('localisation/order_status');


        $data['heading_title'] = $this->language->get('heading_title');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['header'] = $this->load->controller('common/header');

        $php_version = phpversion();
        if (version_compare($php_version, '7.4', '<')) {
            $data['php_version_warning'] = $this->language->get('php_version_warning');
            $this->editSetting('payment_sanalpospro_status', 0);
            return $this->response->setOutput($this->load->view('extension/payment/sanalpospro', $data));
        }

        $data['php_version_warning'] = '';

        $order_statuses_raw = $this->model_localisation_order_status->getOrderStatuses();
        $order_statuses = [];
        foreach ($order_statuses_raw as $order_status) {
            $order_statuses[$order_status['order_status_id']] = $order_status['name'];
        }
        $settings = $this->model_setting_setting->getSetting('payment_sanalpospro');

        // if extension is not active for php version warning, activate it
        if ($settings['payment_sanalpospro_status'] == 0) {
            $this->editSetting('payment_sanalpospro_status', 1);
        }

        $data['order_status'] = $settings['payment_sanalpospro_order_status'];
        $data['currency_convert'] = $settings['payment_sanalpospro_currency_convert'];
        $data['showInstallmentsTabs'] = $settings['payment_sanalpospro_showInstallmentsTabs'];
        $data['paymentPageTheme'] = $settings['payment_sanalpospro_paymentPageTheme'];
        $data['order_statuses'] = json_encode($order_statuses);

        $data['text_yes'] = $this->language->get('yes');
        $data['text_no'] = $this->language->get('no');
        $data['text_classic'] = $this->language->get('classic');
        $data['text_modern'] = $this->language->get('modern');

        $data['iapi_url'] = $this->url->link('extension/payment/sanalpospro/iapi', 'user_token=' . $this->session->data['user_token']);
        $data['iapi_xfvv'] = $settings['payment_sanalpospro_xfvv'];
        $data['store_url'] = HTTPS_CATALOG;

        return $this->response->setOutput($this->load->view('extension/payment/sanalpospro', $data));
    }
    private function editSetting($key, $value)
    {
        $this->load->model('setting/setting');
        $settings = $this->model_setting_setting->getSetting('payment_sanalpospro');
        $settings[$key] = $value;
        $this->model_setting_setting->editSetting('payment_sanalpospro', $settings);
    }
    public function iapi ()
    {
        if (!isset($_SERVER['HTTP_REFERER']) || parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST) !== $_SERVER['HTTP_HOST']) {
            header('Content-Type: application/json');
            header('HTTP/1.0 404 Not Found');
            die(json_encode(['status' => 'error', 'message' => 'Not Found']));
        }
        $this->load->model('setting/setting');
        $settings = $this->model_setting_setting;
        $api = InternalApi::getInstance()->setController($this)->setSettings($settings)->run();
        header('Content-Type: application/json');
        die(json_encode($api->response));
    }
    public function addOrderInfo(&$route, &$data, &$output)
    {
        $this->load->language('extension/payment/sanalpospro');
        $order_id = $this->request->get['order_id'];
        $this->load->model('sale/order');
        $order = $this->model_sale_order->getOrder($order_id);
        if (empty($order) || $order['payment_code'] != 'sanalpospro') {
            return;
        }

        $order_history = $this->model_sale_order->getOrderHistories($order_id);
        $last_history = [];
        if (!empty($order_history)) {
            $last_history = end($order_history);
        }
        if (empty($last_history) || !strpos($last_history['comment'], 'Sanal Pos Pro')) {
            return;
        }

        $transaction_id = '';
        if (!empty($last_history['comment'])) {
            $comment_parts = explode(' ', trim($last_history['comment']));
            $transaction_id = end($comment_parts);
        }
        try {
            if(empty($transaction_id)){
                return;
            }
            $this->load->model('setting/setting');
            $settings = $this->model_setting_setting;
            EticConfig::setSettings($settings);
            $payment_info = Payment::getByToken($transaction_id);
            if ($payment_info['status'] == 'success') {
                $transaction_data = $payment_info['data']['transaction'];
                $order_data['order_status'] = $this->language->get('text_payment_' . $transaction_data['status']);
                $order_data['transaction'] = $transaction_data;
                $order_data['logo'] = (($payment_info['data']['program'])['theme'])['logo_url'];
                if ($transaction_data['gateway_fee'] > 0) {
                    $order_data['process_fee'] = $transaction_data['gateway_fee'];
                    $order_data['text_process_fee'] = $this->language->get('text_process_fee');
                }
            }
        } catch (\Exception $e) {
            $order_data['error'] = $e->getMessage();
        }
        $order_data['warning_message'] = $this->language->get('text_warning_message');
        $order_data['process_detail'] = $this->language->get('text_process_detail');
        $order_data['process_value'] = $this->language->get('text_process_value');
        $order_data['text_process_detail'] = $this->language->get('text_process_detail');
        $order_data['text_process_value'] = $this->language->get('text_process_value');
        $order_data['text_order_status'] = $this->language->get('text_order_status');
        $order_data['text_order_id'] = $this->language->get('text_order_id');
        $order_data['text_amount'] = $this->language->get('text_amount');
        $order_data['text_currency'] = $this->language->get('text_currency');
        $order_data['text_installment'] = $this->language->get('text_installment');
        $order_data['text_process_fee'] = $this->language->get('text_process_fee');
        $order_data['text_no_installment'] = $this->language->get('text_no_installment');
        $order_data['text_created_at'] = $this->language->get('text_created_at');
        $content = $this->load->view('extension/payment/sanalpospro/order/order_info', $order_data);
        $data['tabs'][] = [
            'code' => 'sanalpospro_order_info',
            'title' => 'Sanal Pos Pro',
            'content' => $content
        ];
    }
} 