<?php
/**
 * Magento 2 Training Project
 * Module Training/Helloworld
 */

namespace Training\Helloworld\Controller\Product;

use Magento\Catalog\Api\Data\ProductInterfaceFactory;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Exception\NotFoundException;


/**
 * Action: Index/Index
 *
 * @author    Laurent MINGUET <lamin@smile.fr>
 * @copyright 2017 Smile
 */
class Index extends Action
{
    /**
     * @var ProductInterfaceFactory
     */
    protected $productFactory;

    /**
     * Execute the action
     *
     * @param Context $context
     * @param ProductInterfaceFactory $productFactory
     */

    public function __construct(Context $context, ProductInterfaceFactory $productFactory)
    {
        parent::__construct($context);
        $this->productFactory = $productFactory;
    }

    public function execute()
    {
        $product = $this->getAskedProduct();

        if ($product === null) {
            throw new NotFoundException(__('product not found'));
        }
        //$result = $this->productFactory->
        $result = $this->resultFactory->create(ResultFactory::TYPE_RAW);
        $result->setContents('Product:' . $product->getName());

        return $result;
    }

    /**
     * get the asked product
     *
     * @return \Magento\Catalog\Api\Data\ProductInterface|null
     */
    public function getAskedProduct()
    {
        $productId = (int)$this->getRequest()->getParam('id');
        if (!$productId) {
            return null;
        }

        $product = $this->productFactory->create();
        $product->getResource()->load($product, $productId);
        if (!$product->getId()) {
            return null;
        }

        return $product;
    }
}
