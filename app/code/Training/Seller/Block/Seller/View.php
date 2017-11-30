<?php
/**
 * Created by PhpStorm.
 * User: training
 * Date: 11/30/17
 * Time: 1:58 PM
 */

namespace Training\Seller\Block\Seller;


use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Registry;
use Magento\Framework\View\Element\Template\Context;
use Training\Seller\Helper\Url as UrlHelper;

class View extends AbstractBlock implements IdentityInterface
{

    /**
     * Used to set the cache infos
     *
     * @return void
     */
    protected function _construct()
    {
        $seller = $this->getCurrentSeller();
        if ($seller) {
            $this->setData('cache_key', 'seller_view_' . $seller->getId());
            $this->setData('cache_lifetime', 600);
        }
    }

    public function getIdentities()
    {
        $identities = [];
        if ($this->getCurrentSeller()) {
            $identities = $this->getCurrentSeller()->getIdentities();
        }

        return $identities;
    }

    public function getCurrentSeller()
    {
        return $this->registry->registry('current_seller');
    }

}