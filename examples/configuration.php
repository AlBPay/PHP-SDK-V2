<?php
error_reporting(-1);
ini_set('display_errors', 'On');

/**
 * Setting up testing configuration
 * All testing details you can find here https://documentation.albpay.io/docs/page/2/
 */
define('SDK_ROOTPATH', __DIR__);
require_once SDK_ROOTPATH . '/../vendor/autoload.php';
\Cloudipsp\Configuration::setMerchantId(1545859);
\Cloudipsp\Configuration::setSecretKey('test');
\Cloudipsp\Configuration::setApiVersion('1.0');
\Cloudipsp\Configuration::setRequestType('json');
