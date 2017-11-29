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
$client->addService('trainingSellerSellerRepositoryV1');


$object = [
    'object' => [
        'identifier'    => 'second',
        'name'          => 'Second Seller Name'
    ]
];

$search = [
    'searchCriteria' => [
        'filterGroups' => [
            [
                'filters' => [
                    [
                        'field'     => 'identifier',
                        'conditionType' => 'like',
                        'value' => '%on%'
                    ]
                ]
            ]
        ]
    ]
];

$client->trainingSellerSellerRepositoryV1Save($object);
$client->trainingSellerSellerRepositoryV1GetByIdentifier(['objectIdentifier' => $object['object']['identifier']]);
$client->trainingSellerSellerRepositoryV1DeleteByIdentifier(['objectIdentifier' => $object['object']['identifier']]);

$ps = $client->trainingSellerSellerRepositoryV1Save($object);
$client->trainingSellerSellerRepositoryV1GetById(['objectId' => $ps->sellerId]);

$client->trainingSellerSellerRepositoryV1GetList($search);

$client->trainingSellerSellerRepositoryV1DeleteById(['objectId' => $ps->sellerId]);

