<?php
/**
 * Magento 2 Training Project
 * Module Training/Seller
 */
namespace Training\Seller\Model\ResourceModel;

use Magento\Framework\DB\Select;
use Magento\Framework\EntityManager\EntityManager;
use Magento\Framework\EntityManager\MetadataPool;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Magento\Framework\Model\ResourceModel\Db\Context;
use Magento\Framework\Model\AbstractModel;
use Training\Seller\Api\Data\SellerInterface;

/**
 * Seller Resource Model
 *
 * @author    Laurent MINGUET <lamin@smile.fr>
 * @copyright 2017 Smile
 */
class Seller extends AbstractDb
{
    /**
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * @var MetadataPool
     */
    protected $metadataPool;

    /**
     * Class constructor
     *
     * @param Context       $context
     * @param EntityManager $entityManager
     * @param MetadataPool  $metadataPool
     * @param string        $connectionName
     */
    public function __construct(
        Context       $context,
        EntityManager $entityManager,
        MetadataPool  $metadataPool,
        $connectionName = null
    ) {
        parent::__construct($context, $connectionName);

        $this->entityManager = $entityManager;
        $this->metadataPool  = $metadataPool;
    }

    /**
     * Magento Constructor
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            SellerInterface::TABLE_NAME,
            SellerInterface::FIELD_SELLER_ID
        );
    }

    /**
     * Get connection
     *
     * @return \Magento\Framework\DB\Adapter\AdapterInterface|false
     */
    public function getConnection()
    {
        return $this->metadataPool->getMetadata(SellerInterface::class)->getEntityConnection();
    }

    /**
     * Load an object
     *
     * @param AbstractModel $object
     * @param mixed         $value
     * @param string        $field
     *
     * @return $this
     * @throws \Exception
     */
    public function load(AbstractModel $object, $value, $field = null)
    {
        $objectId = $this->getObjectId($value, $field);

        if ($objectId) {
            $this->entityManager->load($object, $objectId);
        }

        return $this;
    }

    /**
     * Save an object
     *
     * @param AbstractModel $object
     *
     * @return $this
     * @throws \Exception
     */
    public function save(AbstractModel $object)
    {
        $this->entityManager->save($object);

        return $this;
    }

    /**
     * Delete an object
     *
     * @param AbstractModel $object
     *
     * @return $this
     * @throws \Exception
     */
    public function delete(AbstractModel $object)
    {
        $this->entityManager->delete($object);

        return $this;
    }

    /**
     * get the id of an object
     *
     * @param mixed         $value
     * @param null          $field
     *
     * @return bool|int|string
     */
    protected function getObjectId($value, $field = null)
    {
        $entityMetadata = $this->metadataPool->getMetadata(SellerInterface::class);
        if (is_null($field)) {
            $field = $entityMetadata->getIdentifierField();
        }
        $entityId = $value;

        if ($field != $entityMetadata->getIdentifierField()) {
            $field = $this->getConnection()->quoteIdentifier(sprintf('%s.%s', $this->getMainTable(), $field));
            $select = $this->getConnection()->select()->from($this->getMainTable())->where($field . '=?', $value);

            $select->reset(Select::COLUMNS)
                ->columns($this->getMainTable() . '.' . $entityMetadata->getIdentifierField())
                ->limit(1);
            $result = $this->getConnection()->fetchCol($select);
            $entityId = count($result) ? $result[0] : false;
        }
        return $entityId;
    }
}
