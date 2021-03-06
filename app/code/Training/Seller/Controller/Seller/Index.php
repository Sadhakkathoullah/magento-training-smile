<?php
/**
 * Magento 2 Training Project
 * Module Training/Seller
 */
namespace Training\Seller\Controller\Seller;

use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\View\Result\Page as ResultPage;
use Magento\Framework\Api\SortOrder;
use Training\Seller\Api\Data\SellerInterface;

/**
 * Action : seller/index
 *
 */
class Index extends AbstractAction
{
    /**
     * Execute the action
     *
     * @return ResultPage
     */
    public function execute()
    {
        $searchCriteria = $this->getSearchCriteria();

        // get the list of the sellers
        $searchResult = $this->sellerRepository->getList($searchCriteria);

        // save it to the registry
        $this->registry->register('seller_search_result', $searchResult);

        /** @var ResultPage $result */
        $result = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $result->getConfig()->getTitle()->set(__('Sellers'));

        return $result;
    }

    /**
     * Get the search criteria
     *
     * @return \Magento\Framework\Api\SearchCriteria
     */
    protected function getSearchCriteria()
    {
        // get the asked filter name, with protection
        $searchName = (string) $this->_request->getParam('search_name', '');
        $searchName = strip_tags($searchName);
        $searchName = preg_replace('/[\'"%]/', '', $searchName);
        $searchName = trim($searchName);

        // build the filter, if needed, and add it to the criteria
        if ($searchName!== '') {
            // build the filter for the name
            $filters[] = $this->filterBuilder
                ->setField(SellerInterface::FIELD_NAME)
                ->setConditionType('like')
                ->setValue("%$searchName%")
                ->create();

            // add the filter to the criteria
            $this->searchCriteriaBuilder->addFilters($filters);
        }

        // get the asked sort order, with protection
        $sortOrder = (string) $this->_request->getParam('sort_order');
        $availableSort = [
            SortOrder::SORT_ASC,
            SortOrder::SORT_DESC,
        ];
        if (!in_array($sortOrder, $availableSort)) {
            $sortOrder = $availableSort[0];
        }

        // build the sort order and add it to the criteria
        $sort = $this->sortOrderBuilder
            ->setField(SellerInterface::FIELD_NAME)
            ->setDirection($sortOrder)
            ->create();
        $this->searchCriteriaBuilder->addSortOrder($sort);

        // build the criteria
        return $this->searchCriteriaBuilder->create();
    }
}
