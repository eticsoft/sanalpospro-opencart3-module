<?php
namespace Eticsoft\Paythor\Sanalpospro;

class EticContext
{
    public static function get($key)
    {   
        return \Context::getContext()->$key;
    }
}