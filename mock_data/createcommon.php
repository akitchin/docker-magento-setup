<?php

function createWebsite($objectManager,$code) {
    $_website = $objectManager->create('Magento\Store\Model\Website');
    $_store = $objectManager->create('Magento\Store\Model\Group');
    $_store_view = $objectManager->create('Magento\Store\Model\Store');

    $_website->setName('AAJJKK' . $code)->setCode('aajjkk' . $code);
    $_website->save();

    $_store->setWebsiteId($_website->getId())->setName('Main Website Store')->setRootCategoryId(2);
    $_store->save();

    $_store_view->setGroupId($_store->getId())->setName('Default Store View')->setCode('aajjkk' . $code)->setIsActive(TRUE);
    $_store_view->save();
    return array($_website, $_store, $_store_view);
}

function createProduct($objectManager,$websiteId,$storeId) {
    $_product = $objectManager->create('Magento\Catalog\Model\Product');
    $_productImages = $objectManager->create('Magento\CatalogImportExport\Model\Import\Product');

    $importDir = __DIR__ . '/pub/media/import/';
    $image1Name = "1.jpg";
    $image2Name = "2.png";
    $image3Name = "3.png";
    $image1 = $importDir . $image1Name;
    $image2 = $importDir . $image2Name;
    $image3 = $importDir . $image3Name;

    $key = time(). '-' . rand();

    $_product->setName('Test Product')
            ->setDescription('Test Product')
            ->setShortDescription('Test Product')
            ->setUrlKey('test-'. $key)
            ->setCategoryIds(array(2)) // 38 - A Category, 41 - B Category
            ->setTypeId('simple')
            ->setAttributeSetId(4) // 4 - Default, 16 - My Custom Attribute (Newly Created)
            ->setSku('test-' . $key)
            ->setWebsiteIds(array($websiteId)) // Your Website Id
            ->setStoreId($storeId) // Your Store Id
            ->setVisibility(4)
            ->setPrice(1.5)
            ->setStatus(1)
            ->setWeight(0.5);

    $_product->setStockData(array(
        'use_config_manage_stock' => 0, //'Use config settings' checkbox
        'manage_stock' => 1, //manage stock
        'min_sale_qty' => 1, //Minimum Qty Allowed in Shopping Cart
        'max_sale_qty' => 2, //Maximum Qty Allowed in Shopping Cart
        'is_in_stock' => 1, //Stock Availability
        'qty' => 100 //qty
            )
    );

    // START SET ATTRIBUTES OF MY NEW ATTRIBUTE STE
    //$_product->addData(
    //        array(
    //            'label' => "Test",
    //            'material' => 319, // 319 - Gold, 320  - Silver
    //        )
    //);
    // END SET ATTRIBUTES OF MY NEW ATTRIBUTE STE

    // START SET IMAGES
    $_product->addImageToMediaGallery($image3, array('image', 'small_image', 'thumbnail'), false, false); // Add Image 3
    $_product->addImageToMediaGallery($image2, array('image', 'small_image', 'thumbnail'), false, false); // Add Image 2    
    $_product->addImageToMediaGallery($image1, array('image', 'small_image', 'thumbnail'), false, false); // Add Image 1        
    // STOP  SET IMAGES    


    $_product->save();

    return $_product;
}