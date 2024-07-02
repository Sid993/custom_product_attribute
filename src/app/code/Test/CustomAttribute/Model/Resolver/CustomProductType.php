<?php
/**
 * Test.
 *
 * @category   Test
 * @package    Test_CustomAttribute
 * @author     Test
 * @copyright  Copyright
 * @license    https://test.com/license.html
 */
declare(strict_types=1);
namespace Test\CustomAttribute\Model\Resolver;

use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Catalog\Api\AttributeSetRepositoryInterface;

/**
 * Class to resolve custom_product_type field in product GraphQL query
 */
class CustomProductType implements ResolverInterface
{
    /**
     * @var \Test\CustomAttribute\Model\Source\Config\Options
     */
    private $options;

    /**
     * @param \Test\CustomAttribute\Model\Source\Config\Options $options
     */
    public function __construct(
        \Test\CustomAttribute\Model\Source\Config\Options $options
    ) {
        $this->options = $options;
    }

    /**
     * @inheritdoc
     */
    public function resolve(Field $field, $context, ResolveInfo $info, array $value = null, array $args = null)
    {
        $customProductType = $this->options->getAllOptions();
        $label = "";
        foreach ($customProductType as $option) {
            if ($option['value'] == $value['custom_product_type']) {
                $label = $option['label'];
            }
        }
        return $label;
    }
}
