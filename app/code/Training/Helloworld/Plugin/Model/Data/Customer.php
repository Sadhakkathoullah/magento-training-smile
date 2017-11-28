<?php
/**
 * Created by PhpStorm.
 * User: training
 * Date: 11/28/17
 * Time: 10:46 AM
 */

namespace Training\Helloworld\Plugin\Model\Data;

use Magento\Customer\Model\Customer as ModelCustomer;


class Customer
{
    /**
     * @param ModelCustomer $subject
     * @param $value
     * @return array
     */

    public function beforeSetFirstName(ModelCustomer $subject, $value)
    {
        $value = mb_convert_case($value, MB_CASE_TITLE);
        return [$value];
    }
}