#User Guide
Run the below script to update the custom_product_type value to 'Sale'.
COMMAND: php bin/magento product:update_custom_attribute

Run the below script to validate unit test.
COMMAND For Unit Test: vendor/bin/phpunit -c dev/tests/unit/phpunit.xml.dist app/code/Test/CustomAttribute/Test/Unit/
