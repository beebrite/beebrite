<?php

require_once 'braintree-php-2.14.0/lib/Braintree.php';
require_once __DIR__ . '/vendor/autoload.php';

Braintree_Configuration::environment('sandbox');
Braintree_Configuration::merchantId('wgz3s6kxr9db26wb');
Braintree_Configuration::publicKey('x4mgbkb3yn8xfsqk');
Braintree_Configuration::privateKey('b0bc2a09fabc1ab6c548a6f92abb22bf');

global $app;
$app = new Silex\Application();

$app->get('/', function () {
    include 'views/response.php';
    return "";
});

$app->run();

?>
