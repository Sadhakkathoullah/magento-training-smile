<?php
/**
 * Created by PhpStorm.
 * User: training
 * Date: 11/29/17
 * Time: 2:43 PM
 */

namespace Training\Seller\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Training\Seller\Api\Data\SellerInterface;
use Magento\Framework\DB\Adapter\AdapterInterface;
use Training\Seller\Model\Seller;

class InstallSchema implements InstallSchemaInterface
{
    /**
     * {@inheritdoc}
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();

        /**
         * Create table 'cms_block'
         */
        $table = $installer->getConnection()
            ->newTable($installer->getTable(SellerInterface::TABLE_NAME)
        )->addColumn(
            Seller::FIELD_SELLER_ID,
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            ['identity' => true, 'nullable' => false,'unsigned' => true,'primary' => true],
            'Seller ID'
        )->addColumn(
            SellerInterface::FIELD_NAME,
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            ['nullable' => false],
            'Seller Name'
        )->addColumn(
            SellerInterface::FIELD_IDENTIFIER,
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            ['nullable' => false],
            'Seller Identifier'
        )->addColumn(
            SellerInterface::FIELD_CREATED_AT,
            \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
            null,
            ['nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT],
            'Seller creation time'
        )->addColumn(
            SellerInterface::FIELD_UPDATED_AT,
            \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
            null,
            ['nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT_UPDATE],
            'Seller Modification Time'
        )->addIndex(
            $setup->getIdxName(
            $installer->getTable(
                SellerInterface::TABLE_NAME),
                [SellerInterface::FIELD_IDENTIFIER],
                AdapterInterface::INDEX_TYPE_UNIQUE
            ),
            [SellerInterface::FIELD_IDENTIFIER],
            ['type' => AdapterInterface::INDEX_TYPE_UNIQUE]
        )->setComment(
            'Training Seller Table'
        );
        $installer->getConnection()->createTable($table);
    }
}