<?php
/**
 * Magento 2 Training Project
 * Module Training/Seller
 */
namespace Training\Seller\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Training\Seller\Api\SellerRepositoryInterface;
use Training\Seller\Api\Data\SellerInterface;
use Training\Seller\Api\Data\SellerInterfaceFactory;

/**
 * Install Data
 *
 * @author    Laurent MINGUET <lamin@smile.fr>
 * @copyright 2017 Smile
 */
class InstallData implements InstallDataInterface
{
    /**
     * @var SellerInterfaceFactory
     */
    protected $sellerFactory;

    /**
     * @var SellerRepositoryInterface
     */
    private $sellerRepository;

    /**
     * PHP Constructor
     *
     * @param SellerRepositoryInterface $sellerRepository
     * @param SellerInterfaceFactory    $sellerFactory
     */
    public function __construct(
        SellerRepositoryInterface $sellerRepository,
        SellerInterfaceFactory    $sellerFactory
    ) {
        $this->sellerRepository = $sellerRepository;
        $this->sellerFactory    = $sellerFactory;
    }

    /**
     * Installs data
     *
     * @param ModuleDataSetupInterface $setup   Setup
     * @param ModuleContextInterface   $context Context
     *
     * @return void
     * @SuppressWarnings("PMD.UnusedFormalParameter")
     */
    public function install(
        ModuleDataSetupInterface $setup,
        ModuleContextInterface $context
    ) {
        /** @var SellerInterface $model */
        $model = $this->sellerFactory->create();
        $model->setIdentifier('main')->setName('Main Seller');

        $this->sellerRepository->save($model);
    }
}
