<?php
/**
 * HTS Inc.
 *
 * @category  HTS
 * @package   HTS_ReCaptcha
 * @author    HTS
 * @copyright Copyright (c) HTS Inc.
 */

namespace Hts\ReCaptcha\Command;

use Magento\Framework\App\Cache\Manager;
use Magento\Framework\App\Config\ConfigResource\ConfigInterface;
use Hts\ReCaptcha\Model\Config;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ReCaptcha extends Command
{
    /**
     * @var ConfigInterface
     */
    private $config;

    /**
     * @var Manager
     */
    private $cacheManager;

    /**
     * ReCaptcha constructor.
     * @param ConfigInterface $config
     * @param Manager $cacheManager
     */
    public function __construct(
        ConfigInterface $config,
        Manager $cacheManager
    ) {
        parent::__construct();
        $this->config = $config;
        $this->cacheManager = $cacheManager;
    }

    /**
     * @inheritdoc
     */
    protected function configure()
    {
        $this->setName('hts:security:recaptcha:disable');
        $this->setDescription('Disable backend reCaptcha');

        parent::configure();
    }

    /**
     * @inheritdoc
     * @SuppressWarnings("PHPMD.UnusedFormalParameter")
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->config->saveConfig(
            Config::XML_PATH_ENABLED_BACKEND,
            '0',
            'default',
            0
        );

        $this->cacheManager->flush(['config']);
    }
}
