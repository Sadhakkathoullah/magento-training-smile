<?php
/**
 * Created by PhpStorm.
 * User: training
 * Date: 11/30/17
 * Time: 10:02 AM
 */

namespace Training\Seller\Controller\Seller;


use Magento\Framework\Api\Search\SearchCriteriaBuilder;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Training\Seller\Api\SellerRepositoryInterface;

abstract class AbstractAction extends Action
{
    /**
     * @var SellerRepositoryInterface
     */
    protected $sellerRepository;

    /**
     * @var SearchCriteriaBuilder
     */
    private $searchCriteriaBuilder;

    /**
     * Index constructor.
     * @param Context $context
     * @param SellerRepositoryInterface $sellerRepository
     */
    public function __construct(Context $context,
                                SellerRepositoryInterface $sellerRepository,
                                SearchCriteriaBuilder $searchCriteriaBuilder
    ){

        parent::__construct($context);
        $this->sellerRepository = $sellerRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
    }

}