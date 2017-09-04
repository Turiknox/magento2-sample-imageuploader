<?php
/*
 * Turiknox_SampleImageUploader

 * @category   Turiknox
 * @package    Turiknox_SampleImageUploader
 * @copyright  Copyright (c) 2017 Turiknox
 * @license    https://github.com/turiknox/magento2-sample-imageuploader/blob/master/LICENSE.md
 * @version    1.0.0
 */
namespace Turiknox\SampleImageUploader\Setup;

use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class InstallSchema implements InstallSchemaInterface
{

    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();
        $tableName = $installer->getTable('turiknox_sampleimageuploader_image');

        if (!$installer->tableExists('turiknox_sampleimageuploader_image')) {
            $table = $installer->getConnection()
                ->newTable($tableName)
                ->addColumn(
                    'image_id',
                    Table::TYPE_INTEGER,
                    null,
                    [
                        'identity' => true,
                        'unsigned' => true,
                        'nullable' => false,
                        'primary' => true
                    ],
                    'Image ID'
                )
                ->addColumn(
                    'image',
                    Table::TYPE_TEXT,
                    255,
                    array(
                        'nullable'  => false,
                    ),
                    'Image'
                );
            $installer->getConnection()->createTable($table);
        }
        $installer->endSetup();
    }
}
