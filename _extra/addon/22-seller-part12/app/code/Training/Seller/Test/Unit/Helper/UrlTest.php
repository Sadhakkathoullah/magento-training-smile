<?php
/**
 * Magento 2 Training Project
 * Module Training/Seller
 */
namespace Training\Helper\Test\Unit\Helper;

use \PHPUnit\Framework\TestCase;
use \Magento\Framework\TestFramework\Unit\Helper\ObjectManager;
use \Training\Seller\Helper\Url as HelperUrl;

/**
 * Url Helper test
 *
 * @author    Laurent MINGUET <lamin@smile.fr>
 * @copyright 2017 Smile
 */
class UrlTest extends TestCase
{
    /**
     * @var ObjectManager
     */
    protected $objectManager;

    /**
     * Setting up tests
     */
    protected function setUp()
    {
        $this->objectManager   = new ObjectManager($this);
    }

    /**
     * Test the getSellersUrl method
     */
    public function testSellerUrlsSuccess()
    {
        $expectedUrl = '/sellers.html';

        $helper = $this->getUrlHelper($expectedUrl);

        $resultUrl = $helper->getSellersUrl();

        $this->assertEquals($expectedUrl, $resultUrl);
    }

    /**
     * Test the getSellerUrl method
     */
    public function testSellerUrlSuccess()
    {
        $expectedUrl = '/seller/test.html';

        $helper = $this->getUrlHelper($expectedUrl);

        $resultUrl = $helper->getSellerUrl('test');

        $this->assertEquals($expectedUrl, $resultUrl);
    }


    /**
     * Get the helper to test
     *
     * @param string $askedUrl
     *
     * @return HelperUrl
     */
    protected function getUrlHelper($askedUrl)
    {
        $urlBuilder = $this
            ->getMockBuilder(\Magento\Framework\Url::class)
            ->disableOriginalConstructor()
            ->setMethods(['getDirectUrl'])
            ->getMock();
        
        $urlBuilder
            ->expects($this->once())
            ->method('getDirectUrl')
            ->will($this->returnValue($askedUrl));
        
        $context = $this
            ->getMockBuilder(\Magento\Framework\App\Helper\Context::class)
            ->disableOriginalConstructor()
            ->setMethods(['getUrlBuilder'])
            ->getMock();

        $context
            ->expects($this->any())
            ->method('getUrlBuilder')
            ->will($this->returnValue($urlBuilder));
        
        /** @var HelperUrl $helper */
        $helper = $this->objectManager->getObject(
            HelperUrl::class,
            [
                'context' => $context,
            ]
        );

        return $helper;
    }
}
