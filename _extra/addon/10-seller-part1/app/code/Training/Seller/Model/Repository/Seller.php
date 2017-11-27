<?php
/**
 * Magento 2 Training Project
 * Module Training/Seller
 */
namespace Training\Seller\Model\Repository;

use Magento\Framework\Api\SearchCriteriaInterface;
use Training\Seller\Api\SellerRepositoryInterface;
use Training\Seller\Api\Data\SellerInterfaceFactory;
use Training\Seller\Api\Data\SellerInterface;
use Training\Seller\Api\Data\SellerSearchResultsInterfaceFactory;
use Training\Seller\Model\ResourceModel\Seller as SellerResourceModel;
use Training\Seller\Model\Repository\ManagementFactory as RepositoryManagementFactory;
use Training\Seller\Model\Repository\Management as RepositoryManagement;

/**
 * Seller Repository
 *
 * @author    Laurent MINGUET <lamin@smile.fr>
 * @copyright 2017 Smile
 */
class Seller implements SellerRepositoryInterface
{
    /**
     * @var RepositoryManagement
     */
    protected $sellerRepositoryManagement;

    /**
     * PHP Constructor
     *
     * @param SellerInterfaceFactory              $objectFactory
     * @param SellerResourceModel                 $objectResource
     * @param SellerSearchResultsInterfaceFactory $searchResultsFactory
     * @param RepositoryManagementFactory         $repositoryManagementFactory
     */
    public function __construct(
        SellerInterfaceFactory              $objectFactory,
        SellerResourceModel                 $objectResource,
        SellerSearchResultsInterfaceFactory $searchResultsFactory,
        RepositoryManagementFactory         $repositoryManagementFactory
    ) {
        $this->sellerRepositoryManagement = $repositoryManagementFactory->create();

        $this->sellerRepositoryManagement
            ->setObjectFactory($objectFactory)
            ->setObjectResource($objectResource)
            ->setSearchResultFactory($searchResultsFactory)
            ->setIdentifierFieldName(SellerInterface::FIELD_IDENTIFIER);
    }

    /**
     * @inheritdoc
     */
    public function getById($objectId)
    {
        return $this->sellerRepositoryManagement->getEntityById($objectId);
    }

    /**
     * @inheritdoc
     */
    public function getByIdentifier($objectIdentifier)
    {
        return $this->sellerRepositoryManagement->getEntityByIdentifier($objectIdentifier);
    }

    /**
     * @inheritdoc
     */
    public function getList(SearchCriteriaInterface $searchCriteria = null)
    {
        return $this->sellerRepositoryManagement->getEntities($searchCriteria);
    }

    /**
     * @inheritdoc
     */
    public function save(SellerInterface $object)
    {
        return $this->sellerRepositoryManagement->saveEntity($object);
    }

    /**
     * @inheritdoc
     */
    public function deleteById($objectId)
    {
        return $this->sellerRepositoryManagement->deleteEntityById($objectId);
    }

    /**
     * @inheritdoc
     */
    public function deleteByIdentifier($objectIdentifier)
    {
        return $this->sellerRepositoryManagement->deleteEntityByIdentifier($objectIdentifier);
    }
}
