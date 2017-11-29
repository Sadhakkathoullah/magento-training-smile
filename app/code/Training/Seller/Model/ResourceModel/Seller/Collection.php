<?php
/**
 * Magento 2 Training Project
 * Module Training/Seller
 */
namespace Training\Seller\Model\ResourceModel\Seller;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Training\Seller\Api\Data\SellerInterface;
use Training\Seller\Model\ResourceModel\Seller;


/**
 * Seller Collection
 *
 */
class Collection extends AbstractCollection
{

    /**
     * Definition resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            \Training\Seller\Model\Seller::class,
            \Training\Seller\Model\ResourceModel\Seller::class
        );
    }

    /**
     * Returns pairs id - name
     *
     * @return array
     */
    public function toOptionArray()
    {
        return $this->_toOptionArray(SellerInterface::FIELD_SELLER_ID,SellerInterface::FIELD_NAME);
    }
}
