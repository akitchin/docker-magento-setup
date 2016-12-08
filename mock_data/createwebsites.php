<?php
include('app/bootstrap.php');
include('createcommon.php');

use Magento\Framework\App\Bootstrap;

$bootstrap = Bootstrap::create(BP, $_SERVER);
$objectManager = $bootstrap->getObjectManager();

$state = $objectManager->get('Magento\Framework\App\State');
$state->setAreaCode('frontend');

try {
     
    $results = createWebsite($objectManager,$argv[2]);
    $_website = $results[0];
    $_store = $results[1];
    $_store_view = $results[2];

    $_product = createProduct($objectManager,$_website->getId(), $_store_view->getId());

    echo "<pre>";
    echo "Success: Website Id: " . $_website->getId();
    echo "Success: Store Id: " . $_store->getId();
    echo "Success: Store View Id: " . $_store_view->getId();
    echo "Success: Product Id: " . $_product->getId();
    echo "</pre>";
} catch (Exception $e) {
    print_r($e->getMessage());
}
