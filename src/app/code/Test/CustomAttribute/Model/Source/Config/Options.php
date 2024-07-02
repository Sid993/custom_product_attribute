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
namespace Test\CustomAttribute\Model\Source\Config;

use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;

class Options extends AbstractSource
{
    public const NEW = 'new';
    public const SALE = 'sale';
    public const EXCLUSIVE = 'exclusive';

    /**
     * @return array
     */
    public function getAllOptions(): array
    {
        $this->_options = [
            ['label' => 'New', 'value' => self::NEW],
            ['label' => 'Sale', 'value' => self::SALE],
            ['label' => 'Exclusive', 'value' => self::EXCLUSIVE]
        ];
        return $this->_options;
    }
}
