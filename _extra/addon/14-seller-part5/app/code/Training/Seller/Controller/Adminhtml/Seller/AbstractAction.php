<?php
/**
 * Magento 2 Training Project
 * Module Training/Seller
 */
namespace Training\Seller\Controller\Adminhtml\Seller;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\NotFoundException;
use Magento\Framework\Registry;
use Training\Seller\Api\Data\SellerInterfaceFactory as SellerFactory;
use Training\Seller\Api\SellerRepositoryInterface   as SellerRepository;
use Training\Seller\Api\Data\SellerInterface        as Seller;

/**
 * Abstract Admin action for seller
 *
 * @author    Laurent MINGUET <lamin@smile.fr>
 * @copyright 2017 Smile
 */
abstract class AbstractAction extends Action
{
    /**
     * @var \Magento\Framework\Registry
     */
    protected $coreRegistry;

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
     * @param Registry         $coreRegistry
     * @param SellerFactory    $modelFactory
     * @param SellerRepository $modelRepository
     */
    public function __construct(
        Context          $context,
        Registry         $coreRegistry,
        SellerFactory    $modelFactory,
        SellerRepository $modelRepository
    ) {
        parent::__construct($context);

        $this->coreRegistry    = $coreRegistry;
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

    /**
     * Init the current model
     *
     * @param int|null $modelId
     *
     * @return Seller
     * @throws NotFoundException
     */
    protected function initModel($modelId)
    {
        /** @var \Training\Seller\Model\Seller $model */
        $model = $this->modelFactory->create();

        // Initial checking
        if ($modelId) {
            try {
                $model = $this->modelRepository->getById($modelId);
            } catch (NoSuchEntityException $e) {
                throw new NotFoundException(__('This seller does not exist'));
            }
        }

        // Register model to use later in blocks
        $this->coreRegistry->register('current_seller', $model);

        return $model;
    }
}
