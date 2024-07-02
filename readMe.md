#Installation

Magento2 Test CustomAttribute module installation is very easy, please follow the steps for installation-

Unzip the respective extension zip and create Test(vendor) then CustomAttribute(module) name folder inside your magento/app/code/ directory and then move all module's files into magento root directory Magento2/app/code/Test/CustomAttribute/ folder.
Run Following Command via terminal
php bin/magento setup:upgrade php bin/magento setup:di:compile php bin/magento setup:static-content:deploy

Flush the cache and reindex all.
now module is properly installed

#User Guide
Run the below script to update the custom_product_type value to 'Sale'.
COMMAND: php bin/magento product:update_custom_attribute

Run the below script to validate unit test.
COMMAND For Unit Test: vendor/bin/phpunit -c dev/tests/unit/phpunit.xml.dist app/code/Test/CustomAttribute/Test/Unit/