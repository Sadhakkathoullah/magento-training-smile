<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Training\Seller\Controller;

use Magento\Framework\App\ActionFactory;
use Magento\Framework\App\Request\Http;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\RouterInterface;
use Magento\Framework\App\Action\Forward as ForwardAction;

/**
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class Router implements RouterInterface
{
    /**
     * @var ActionFactory
     */
    private $actionFactory;

    /**
     * Router constructor.
     * @param ActionFactory $actionFactory
     */
    public function __construct(ActionFactory $actionFactory)
    {
        $this->actionFactory = $actionFactory;
    }


    /**
     * Validate and Match Cms Page and modify request
     *
     * @param \Magento\Framework\App\RequestInterface $request
     * @return \Magento\Framework\App\ActionInterface|null
     */
    public function match(RequestInterface $request)
    {
        /** @var Http $request */
        $url = $request->getPathInfo();

        if ($url === '/sellers.html') {
            $request->setPathInfo('/seller/seller/index');
            return $this->actionFactory->create(ForwardAction::class);
        }

        if (preg_match('%^/seller/(.+)\.html$%', $url, $match)) {
            $request->setPathInfo(sprintf('/seller/seller/view/identifier/%s', $match[1]));
            return $this->actionFactory->create(ForwardAction::class);
        }

        return null;
    }
}
