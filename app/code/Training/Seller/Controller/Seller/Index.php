<?php
/**
 * Created by PhpStorm.
 * User: training
 * Date: 11/30/17
 * Time: 9:53 AM
 */

namespace Training\Seller\Controller\Seller;

use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\Result\Raw as ResultRaw;

class Index extends AbstractAction
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
        $searchResult = $this->sellerRepository->getList();

        $html = '<ul>';
        foreach ($searchResult->getItems() as $seller) {
            $html.= '<li><a href="/seller/'.$seller->getIdentifier().'.html">'.$seller->getName().'</a></li>';
        }
        $html.= '</ul>';

        /** @var ResultRaw $result */
        $result = $this->resultFactory->create(ResultFactory::TYPE_RAW);
        $result->setContents($html);

        return $result;

    }
}