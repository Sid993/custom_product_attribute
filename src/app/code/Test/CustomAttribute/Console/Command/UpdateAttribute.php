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
namespace Test\CustomAttribute\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Magento\Catalog\Model\Product\Action as ProductAction;

class UpdateAttribute extends Command
{
    /**
     * @var ProductAction
     */
    private $productAction;

    /**
     * @var \Magento\Framework\Module\Manager
     */
    protected $moduleManager;

    /**
     * @var \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory
     */
    protected $productCollectionFactory;

    /**
     * Initialize dependencies
     *
     * @param ProductAction $productAction
     * @param \Magento\Framework\Module\Manager $moduleManager
     * @param \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory
     * @return void
     */
    public function __construct(
        ProductAction $productAction,
        \Magento\Framework\Module\Manager $moduleManager,
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory
    ) {
        $this->productAction = $productAction;
        $this->moduleManager = $moduleManager;
        $this->productCollectionFactory = $productCollectionFactory;
        parent::__construct();
    }

    /**
     * @inheritdoc
     */
    protected function configure()
    {
        $this->setName('product:update_custom_attribute')
            ->setDescription('Update Custom Attribute Custom Command');
        parent::configure();
    }

    /**
     * @inheritdoc
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        try {
            if ($this->moduleManager->isEnabled('Test_CustomAttribute')) {
                $output->writeln('<info>Product CustomAttribute Update Command Execution Started.</info>');
                $productCollection = $this->productCollectionFactory->create()->addAttributeToSelect('entity_id');
                if ($productCollection->getSize()) {
                    $ids = $productCollection->getColumnValues('entity_id');
                    $defaultValue = \Test\CustomAttribute\Model\Source\Config\Options::SALE;
                    $this->productAction->updateAttributes($ids, ['custom_product_type' => $defaultValue], 0);
                    $output->writeln('<info>Product Update Command Executed Successfully.</info>');
                } else {
                    $output->writeln('<info>Product Not Available.</info>');
                }
            } else {
                $output->writeln('<error>Test_CustomAttribute is disabled.</error>');
            }
        } catch (\Exception $e) {
            $output->writeln('<error>'.$e->getMessage().'</error>');
            return \Magento\Framework\Console\Cli::RETURN_FAILURE;
        }
        return \Magento\Framework\Console\Cli::RETURN_SUCCESS;
    }
}
