<?php
/**
 * Created by PhpStorm.
 * User: training
 * Date: 11/29/17
 * Time: 10:52 AM
 */
namespace Training\Seller\Model;

use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractModel;
use Training\Seller\Api\Data\SellerInterface;

/**
 * Class Seller
 * @package Training\Seller\Api\Model
 */
class Seller extends abstractModel implements identityInterface, SellerInterface
{

    /**
     * Seller cache tag
     */
    const CACHE_TAG = 'training_seller';

    /**
     * @var string
     */
    protected $_cacheTag = self::CACHE_TAG;

    /**
     * Magento Constructor
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            \Training\Seller\Model\ResourceModel\Seller::class
        );
    }

    /**
     * Get field: seller_id
     *
     * @return int|null
     */
    public function getSellerId()
    {
        return (int) $this->getData(self::FIELD_SELLER_ID);
    }

    /**
     * Get field: identifier
     *
     * @return string
     */
    public function getIdentifier()
    {
        return (string) $this->getData(self::FIELD_IDENTIFIER);
    }

    /**
     * Get field: name
     *
     * @return string
     */
    public function getName()
    {
        return (string) $this->getData(self::FIELD_NAME);
    }

    /**
     * Get field: created_at
     *
     * @return string|null
     */
    public function getCreatedAt()
    {
        return (string) $this->getData(self::FIELD_CREATED_AT);
    }

    /**
     * Get field: updated_at
     *
     * @return string|null
     */
    public function getUpdatedAt()
    {
        return (string) $this->getData(self::FIELD_UPDATED_AT);
    }

    /**
     * Set field: seller_id
     *
     * @param int $value
     *
     * @return SellerInterface
     */
    public function setSellerId($value)
    {
        return $this->setData(self::FIELD_SELLER_ID, (string) $value);
    }

    /**
     * Set field: identifier
     *
     * @param string $value
     *
     * @return SellerInterface
     */
    public function setIdentifier($value)
    {
        return $this->setData(self::FIELD_IDENTIFIER, (string) $value);
    }

    /**
     * Set field: name
     *
     * @param string $value
     *
     * @return SellerInterface
     */
    public function setName($value)
    {
        return $this->setData(self::FIELD_NAME, (string) $value);
    }

    /**
     * Set field: created_at
     *
     * @param string $value
     *
     * @return SellerInterface
     */
    public function setCreatedAt($value)
    {
        return $this->setData(self::FIELD_CREATED_AT, (string) $value);
    }

    /**
     * Set field: updated_at
     *
     * @param string $value
     *
     * @return SellerInterface
     */
    public function setUpdatedAt($value)
    {
        return $this->setData(self::FIELD_UPDATED_AT, (string) $value);
    }

    /**
     * Return unique ID(s) for each object in system
     *
     * @return string[]
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId(), self::CACHE_TAG . '_' . $this->getIdentifier()];
    }

    /**
     * Populate the object from array values
     * It is better to use setters instead of the generic setData method
     *
     * @param array $values
     *
     * @return Seller
     */
    public function populateFromArray(array $values)
    {
        $this->setIdentifier($values['identifier']);
        $this->setName($values['name']);

        return $this;
    }
}