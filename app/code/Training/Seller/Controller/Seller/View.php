<?php
/**
 * Created by PhpStorm.
 * User: training
 * Date: 11/30/17
 * Time: 9:53 AM
 */

namespace Training\Seller\Controller\Seller;

use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\NotFoundException;

use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\Result\Raw as ResultRaw;

class View extends AbstractAction
{

    /**
     * Execute action based on request and return result
     *
     * Note: Request will be added as operation argument in future
     *
     * @return \Magento\Framework\Controller\ResultInterface|ResponseInterface
     * @throws \Magento\Framework\Exception\NotFoundException
     */
    public function execute()
    {
        $identifier = $this->getRequest()->getParam('identifier');
        if(!$identifier){
            throw new NotFoundException(__('The identifier is missing'));
        }

        try {
            $currentSeller = $this->sellerRepository->getByIdentifier($identifier);
        }catch(NoSuchEntityException $e){
            throw new NotFoundException(__('The seller does not exist'));
        }

        $html = '
<h1>'.$currentSeller->getName().'</h1>
<hr />
<p>#'.$currentSeller->getIdentifier().'</p>
<hr />
<a href="/sellers.html">back to the list</a>
';


        /** @var ResultRaw $result */
        $result = $this->resultFactory->create(ResultFactory::TYPE_RAW);
        $result->setContents($html);

        return $result;
    }
}