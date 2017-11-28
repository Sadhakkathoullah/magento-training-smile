<?php
/**
 * Created by PhpStorm.
 * User: training
 * Date: 11/28/17
 * Time: 11:21 AM
 */

namespace Training\Helloworld\Rewrite\Catalog\Model;

use Magento\Catalog\Model\Product as ModelProduct;

class Product extends ModelProduct
{
    public function getName()
    {
        return parent::getName() . ' (Hello World)';
    }
}