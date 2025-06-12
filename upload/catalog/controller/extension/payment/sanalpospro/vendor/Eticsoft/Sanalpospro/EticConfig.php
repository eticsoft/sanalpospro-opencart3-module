<?php
namespace Eticsoft\Paythor\Sanalpospro;

class EticConfig
{
    private static $settings;

    public static function setSettings($settings)
    {
        self::$settings = $settings;
    }

    public static function get($key)
    {
        $getSettings = self::$settings->getSetting('payment_sanalpospro');
        if (!isset($getSettings['payment_sanalpospro_' . $key])) {
            throw new \Exception('Config key not found: ' . $key);
        }
        return $getSettings['payment_sanalpospro_' . $key];
    }

    public static function set($key, $value)
    {
        $getSettings = self::$settings->getSetting('payment_sanalpospro');
        if (!isset($getSettings['payment_sanalpospro_' . $key])) {
            throw new \Exception('Config key not found: ' . $key);
        }
        $getSettings['payment_sanalpospro_' . $key] = $value;
        self::$settings->editSetting('payment_sanalpospro', $getSettings);
    }
}