<?php

include('app/bootstrap.php');
include(‘createcommon.php’);

use Magento\Framework\App\Bootstrap;

$bootstrap = Bootstrap::create(BP, $_SERVER);
$objectManager = $bootstrap->getObjectManager();

$state = $objectManager->get('Magento\Framework\App\State');
$state->setAreaCode('frontend');

try {

    $_product = createProduct((int)$argv[2], (int)$argv[3]);

    echo "Success: Product Id: " . $_product->getId();
    exit;
} catch (Exception $e) {
    print_r($e->getMessage());
}
