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

namespace Magento\CatalogGraphQl\Test\Unit\Model\Resolver\Product;

use PHPUnit\Framework\TestCase;
use Magento\Catalog\Model\Product;
use PHPUnit\Framework\MockObject\MockObject;
use Magento\Framework\GraphQl\Config\Element\Field;
use Test\CustomAttribute\Model\Source\Config\Options;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Test\CustomAttribute\Model\Resolver\CustomProductType;
use Magento\Framework\GraphQl\Query\Resolver\ContextInterface;

class CustomProductTypeTest extends TestCase
{
    /**
     * @var Field|MockObject
     */
    private Field|MockObject $fieldMock;

    /**
     * @var ContextInterface|MockObject
     */
    private ContextInterface|MockObject $contextMock;

    /**
     * @var ResolveInfo|MockObject
     */
    private ResolveInfo|MockObject $infoMock;

    /**
     * @var Options|MockObject
     */
    private Options|MockObject $optionMock;

    /**
     * @var CustomProductType
     */
    private CustomProductType $customProductType;

    protected function setUp(): void
    {
        $this->fieldMock = $this->createMock(Field::class);
        $this->contextMock = $this->getMockForAbstractClass(ContextInterface::class);
        $this->infoMock = $this->createMock(ResolveInfo::class);
        $this->optionMock = $this->createMock(Options::class);
        $this->customProductType = new CustomProductType(
            $this->optionMock
        );
    }

    /**
     * @dataProvider dataProviderForResolve
     * @param $options
     * @param $value
     * @param $expected
     * @return void
     */
    public function testResolve($options, $value, $expected): void
    {
        $this->optionMock->expects($this->any())->method('getAllOptions')->willReturn($options);

        $result = $this->customProductType->resolve(
            $this->fieldMock,
            $this->contextMock,
            $this->infoMock,
            [
                'custom_product_type' => $value
            ],
            []
        );
        $this->assertEquals($expected, $result);
    }

    /**
     * @return array
     */
    public static function dataProviderForResolve(): array
    {
        return [
            [
                [
                    ['label' => 'New', 'value' => 'new'],
                    ['label' => 'Sale', 'value' => 'sale'],
                    ['label' => 'Exclusive', 'value' => 'exclusive']
                ],
                "sale",
                "Sale"
            ],
            [
                [
                    ['label' => 'New', 'value' => 'new'],
                    ['label' => 'Sale', 'value' => 'sale'],
                    ['label' => 'Exclusive', 'value' => 'exclusive']
                ],
                "new",
                "New"
            ],
            [
                [
                    ['label' => 'New', 'value' => 'new'],
                    ['label' => 'Sale', 'value' => 'sale'],
                    ['label' => 'Exclusive', 'value' => 'exclusive']
                ],
                "exclusive",
                "Exclusive"
            ],
            [
                [
                    ['label' => 'New', 'value' => 'new'],
                    ['label' => 'Sale', 'value' => 'sale'],
                    ['label' => 'Exclusive', 'value' => 'exclusive']
                ],
                "",
                ""
            ]
        ];
    }
}
