<?php
/**
 * Magento 2 Training Project
 * Module Training/Seller
 */
namespace Training\Seller\Helper;

use Magento\Framework\App\Helper\AbstractHelper;


class Url extends AbstractHelper implements \Magento\Framework\View\Element\Block\ArgumentInterface
{
    /**
     * get the url of the sellers
     *
     * @return string
     */
    public function getSellersUrl()
    {
        return $this->_urlBuilder->getDirectUrl('sellers.html');
    }

    /**
     * get the url of a seller
     *
     * @param string $identifier
     *
     * @return string
     */
    public function getSellerUrl($identifier)
    {
        return $this->_urlBuilder->getDirectUrl('seller/'.$identifier.'.html');
    }
}
