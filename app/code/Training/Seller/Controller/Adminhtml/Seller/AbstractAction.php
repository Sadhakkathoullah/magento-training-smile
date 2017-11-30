<?php
/**
 * Magento 2 Training Project
 * Module Training/Seller
 */
namespace Training\Seller\Controller\Adminhtml\Seller;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Training\Seller\Api\Data\SellerInterfaceFactory as SellerFactory;
use Training\Seller\Api\SellerRepositoryInterface   as SellerRepository;

/**
 * Abstract Admin action for seller
 *
 * @author    Laurent MINGUET <lamin@smile.fr>
 * @copyright 2017 Smile
 */
abstract class AbstractAction extends Action
{
    /**
     * @var SellerFactory
     */
    protected $modelFactory;

    /**
     * @var SellerRepository
     */
    protected $modelRepository;

    /**
     * PHP Constructor
     *
     * @param Context          $context
     * @param SellerFactory    $modelFactory
     * @param SellerRepository $modelRepository
     */
    public function __construct(
        Context          $context,
        SellerFactory    $modelFactory,
        SellerRepository $modelRepository
    ) {
        parent::__construct($context);

        $this->modelFactory    = $modelFactory;
        $this->modelRepository = $modelRepository;
    }

    /**
     * Is it allowed ?
     *
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Training_Seller::manage');
    }
}
