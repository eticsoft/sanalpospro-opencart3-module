<?php
class ModelExtensionPaymentSanalpospro extends Model {
    public function getMethod() {
        $this->load->language('extension/payment/sanalpospro');

        $method_data = array(
            'code'       => 'sanalpospro',
            'title'      => $this->language->get('text_title'),
            'terms'      => '',
            'sort_order' => 1
        );
        return $method_data;
    }
} 