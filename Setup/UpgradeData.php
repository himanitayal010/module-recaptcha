<?php
/**
 * HTS Inc.
 *
 * @category  HTS
 * @package   HTS_ReCaptcha
 * @author    HTS
 * @copyright Copyright (c) HTS Inc.
 */

namespace Hts\ReCaptcha\Setup;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\UpgradeDataInterface;

class UpgradeData implements UpgradeDataInterface
{
    /**
     * @var ScopeConfigInterface
     */
    private $scopeConfig;

    /**
     * UpgradeData constructor.
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig
    ) {
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * Move config from srcPath to dstPath
     * @param ModuleDataSetupInterface $setup
     * @param string $srcPath
     * @param string $dstPath
     */
    private function moveConfig(ModuleDataSetupInterface $setup, $srcPath, $dstPath)
    {
        $value = $this->scopeConfig->getValue($srcPath);

        if (is_array($value)) {
            foreach (array_keys($value) as $k) {
                $this->moveConfig($setup, $srcPath . '/' . $k, $dstPath . '/' . $k);
            }
        } else {
            $connection = $setup->getConnection();
            $configData = $setup->getTable('core_config_data');
            $connection->update($configData, ['path' => $dstPath], 'path='.$connection->quote($srcPath));
        }
    }

    private function upgradeTo010100(ModuleDataSetupInterface $setup)
    {
        $this->moveConfig(
            $setup,
            'hts_security/recaptcha',
            'hts_security_recaptcha/general'
        );
    }

    private function upgradeTo010101(ModuleDataSetupInterface $setup)
    {
        $this->moveConfig(
            $setup,
            'hts_security_recaptcha/general/enabled_frontend',
            'hts_security_recaptcha/frontend/enabled'
        );
        $this->moveConfig(
            $setup,
            'hts_security_recaptcha/general/enabled_backend',
            'hts_security_recaptcha/backend/enabled'
        );
    }

    /**
     * Upgrades data for a module
     *
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     */
    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        if (version_compare($context->getVersion(), '1.1.0') < 0) {
            $this->upgradeTo010100($setup);
        }

        if (version_compare($context->getVersion(), '1.2.0') < 0) {
            $this->upgradeTo010101($setup);
        }

        $setup->endSetup();
    }
}
