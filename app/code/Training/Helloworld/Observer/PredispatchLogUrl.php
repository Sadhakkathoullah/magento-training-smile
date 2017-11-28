<?php
/**
 * Created by PhpStorm.
 * User: training
 * Date: 11/28/17
 * Time: 10:04 AM
 */

namespace Training\Helloworld\Observer;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Psr\Log\LoggerInterface;
use Magento\Framework\HTTP\PhpEnvironment\Request;

class PredispatchLogUrl implements ObserverInterface
{
    protected $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }


    public function execute(Observer $observer)
    {
        // TODO: Implement execute() method.
        /** @var Request $request */
        $request = $observer->getEvent()->getdata('request');
        $url= $request->getPathInfo();
        $this->logger->info('Current Url :'.$url);
    }
}
