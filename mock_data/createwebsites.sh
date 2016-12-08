#!/bin/bash

/usr/bin/php bin/magento indexer:reindex
cat magento_stores_bell_curve.csv | awk '{ $NF = sprintf("php createwebsites.php %d %04d", $1, i); i++; print }' | bash
