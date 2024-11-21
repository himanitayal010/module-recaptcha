<?php
/**
 * HTS Inc.
 *
 * @category  HTS
 * @package   HTS_ReCaptcha
 * @author    HTS
 * @copyright Copyright (c) HTS Inc.
 */

namespace Hts\ReCaptcha\Model;


class LayoutSettings
{
    /**
     * @var Config
     */
    private $config;

    /**
     * LayoutSettings constructor.
     * @param Config $config
     */
    public function __construct(
        Config $config
    ) {
        $this->config = $config;
    }

    /**
     * Return captcha config for frontend
     * @return array
     */
    public function getCaptchaSettings()
    {
        return [
            'siteKey' => $this->config->getPublicKey(),
            'size' => $this->config->getFrontendSize(),
            'badge' => $this->config->getFrontendPosition(),
            'theme' => $this->config->getFrontendTheme(),
            'lang' => $this->config->getLanguageCode(),
            'enabled' => [
                'login' => $this->config->isEnabledFrontendLogin(),
                'create' => $this->config->isEnabledFrontendCreate(),
                'forgot' => $this->config->isEnabledFrontendForgot(),
                'contact' => $this->config->isEnabledFrontendContact(),
            ]
        ];
    }
}
