<?php
/**
 * Magento 2 Training Project
 * Module Training/Seller
 */
namespace Training\Seller\Model\Product\Seller;

use Magento\Framework\EntityManager\Operation\ExtensionInterface;
use Magento\Catalog\Api\Data\ProductInterface;
use Training\Seller\Helper\Data as DataHelper;

class ReadHandler implements ExtensionInterface
{
    /**
     * @var DataHelper
     */
    protected $dataHelper;

    /**
     * ReadHandler Constructor
     *
     * @param DataHelper $dataHelper
     */
    public function __construct(DataHelper $dataHelper)
    {
        $this->dataHelper = $dataHelper;
    }


    /**
     * @param ProductInterface $product
     * @param array $arguments
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     * @return ProductInterface
     */
    public function execute($product, $arguments = [])
    {
        // get all the extension attributes
        $extension = $product->getExtensionAttributes();

        if ($extension->getSellers() !== null) {
            return $product;
        }

        // get the sellers linked to the product
        $sellers = $this->dataHelper->getProductSellers($product);

        // add them to the specific attribute "sellers"
        $extension->setSellers($sellers);

        // save it to the product
        $product->setExtensionAttributes($extension);

        return $product;
    }
}
