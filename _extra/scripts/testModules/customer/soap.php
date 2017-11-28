<?php
/**
 * Created by PhpStorm.
 * User: training
 * Date: 11/28/17
 * Time: 4:17 PM
 */

require __DIR__.'/../_tools/init.php';

// Initialize the client
$client = new \SmileCoreTest\SoapClient();
$client->setDebug(true);
$client->setMagentoParams($params);
$client->addService('customerCustomerRepositoryV1');
$client->addService('customerCustomerRepositoryV1');

$client->customerCustomerRepositoryV1GetById(['customerId' => '1']);
