<?php
/**
 * Created by PhpStorm.
 * User: training
 * Date: 11/28/17
 * Time: 3:07 PM
 */

namespace Training\Helloworld\Controller\Product;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Catalog\Api\ProductRepositoryInterface;

use Magento\Framework\Api\FilterBuilder;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\SortOrderBuilder;
use Magento\Framework\Controller\ResultFactory;

use Magento\Framework\Controller\Result\Raw as ResultRaw;

class Search extends Action
{
    /**
     * @var ProductRepositoryInterface
     */
    protected $productRepository;
    /**
     * @var SearchCriteriaBuilder
     */
    protected $searchCriteriaBuilder;
    /**
     * @var FilterBuilder
     */
    protected $filterBuilder;
    /**
     * @var SortOrderBuilder
     */
    protected $sortOrderBuilder;

    /**
     * Search constructor.
     * @param Context $context
     * @param ProductRepositoryInterface $productRepository
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param FilterBuilder $filterBuilder
     * @param SortOrderBuilder $sortOrderBuilder
     */
    public function __construct(
        Context $context,
        ProductRepositoryInterface $productRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        FilterBuilder $filterBuilder,
        SortOrderBuilder $sortOrderBuilder
    ) {
        $this->productRepository = $productRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->sortOrderBuilder = $sortOrderBuilder;
        $this->filterBuilder = $filterBuilder;

        parent::__construct($context);
    }

    public function execute()
    {
        $filterDescription = array();
        $filterDescription[] = $this->filterBuilder
            ->setField('description')->setConditionType('like')->setValue('%comfortable%')
            ->create();

        $filterName = array();
        $filterName[] = $this->filterBuilder
            ->setField('name')->setConditionType('like')->setValue('%bruno%')
            ->create();

        $sortOrder = $this->sortOrderBuilder
            ->setField('name')->setDescendingDirection()
            ->setField('description')->setDescendingDirection()
            ->create();

        $searchCriteria = $this->searchCriteriaBuilder
            ->addFilters($filterDescription)
            ->addFilters($filterName)
            ->addSortOrder($sortOrder)
            ->setPageSize(6)
            ->setCurrentPage(1)
            ->create();

        $products = $this->productRepository->getList($searchCriteria)->getItems();

        $html = '<ul>';
        foreach ($products as $product) {
            $html .= '<li>' . $product->getSku() . ' => ' . $product->getName() . '</li>';
        }
        $html .= '</ul>';
        /** @var ResultRaw $result */
        $result = $this->resultFactory->create(ResultFactory::TYPE_RAW);
        $result->setContents($html);
        return $result;

    }
}