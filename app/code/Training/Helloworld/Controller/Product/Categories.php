<?php
/**
 * Created by PhpStorm.
 * User: training
 * Date: 11/28/17
 * Time: 2:03 PM
 */

namespace Training\Helloworld\Controller\Product;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Catalog\Model\ResourceModel\Product\Collection as ProductCollection;
use Magento\Catalog\Model\ResourceModel\Category\Collection as CategoryCollection;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory as ProductCollectionFactory;
use Magento\Catalog\Model\ResourceModel\Category\CollectionFactory as CategoryCollectionFactory;
use Magento\Framework\Controller\ResultFactory;
use Magento\Catalog\Model\Product as ProductModel;
use Magento\Catalog\Model\Category as CategoryModel;
use Magento\Framework\Controller\Result\Raw as ResultRaw;


class Categories extends Action
{

    /**
     * @var ProductCollectionFactory
     */
    protected $productCollectionFactory;

    /**
     * @var CategoryCollectionFactory
     */
    protected $categoryCollectionFactory;

    /**
     * Categories constructor.
     * @param Context $context
     * @param ProductCollectionFactory $productCollectionFactory
     * @param CategoryCollectionFactory $categoryCollectionFactory
     */
    public function __construct(Context $context, ProductCollectionFactory $productCollectionFactory, CategoryCollectionFactory $categoryCollectionFactory)
    {
        $this->categoryCollectionFactory = $categoryCollectionFactory;
        $this->productCollectionFactory = $productCollectionFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        /** @var ProductCollection $productCollection */
        $productCollection = $this->productCollectionFactory->create();
        $productCollection->addAttributeToFilter('name',array('like' => '%bag%'))
            ->addCategoryIds()->load();

        $categoryIds = array();
        foreach ($productCollection->getItems() as $product) {
            /** @var ProductModel $product */
            $categoryIds = array_merge($categoryIds, $product->getCategoryIds());
        }
        $categoryIds = array_unique($categoryIds);
        /** @var CategoryCollection $catCollection */
        $catCollection = $this->categoryCollectionFactory->create();
        $catCollection
            ->addAttributeToFilter('entity_id', array('in' => $categoryIds))
            ->addAttributeToSelect('name')
            ->load();


        $html = '<ul>';
        foreach ($productCollection->getItems() as $product) {
            $html.= '<li>';
            $html.= $product->getId().' => '.$product->getSku().' => '.$product->getName();
            $html.= '<ul>';
            foreach ($product->getCategoryIds() as $categoryId) {
                /** @var CategoryModel $category */
                $category = $catCollection->getItemById($categoryId);
                $html.= '<li>'.$categoryId.' => '.$category->getName().'</li>';
            }
            $html.= '</ul>';
            $html.= '</li>';
        }
        $html.= '</ul>';

        /** @var ResultRaw $result */
        $result = $this->resultFactory->create(ResultFactory::TYPE_RAW);
        $result->setContents($html);
        return $result;
    }
}