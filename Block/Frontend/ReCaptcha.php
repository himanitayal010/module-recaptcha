<?php
/**
 * HTS Inc.
 *
 * @category  HTS
 * @package   HTS_ReCaptcha
 * @author    HTS
 * @copyright Copyright (c) HTS Inc.
 */

namespace Hts\ReCaptcha\Block\Frontend;

use Magento\Framework\Json\DecoderInterface;
use Magento\Framework\Json\EncoderInterface;
use Magento\Framework\View\Element\Template;
use Hts\ReCaptcha\Model\Config;
use Hts\ReCaptcha\Model\LayoutSettings;

class ReCaptcha extends Template
{
    /**
     * @var Config
     */
    private $config;

    /**
     * @var array
     */
    private $data;

    /**
     * @var DecoderInterface
     */
    private $decoder;

    /**
     * @var EncoderInterface
     */
    private $encoder;

    /**
     * @var LayoutSettings
     */
    private $layoutSettings;

    /**
     * ReCaptcha constructor.
     * @param Template\Context $context
     * @param DecoderInterface $decoder
     * @param EncoderInterface $encoder
     * @param LayoutSettings $layoutSettings
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        DecoderInterface $decoder,
        EncoderInterface $encoder,
        LayoutSettings $layoutSettings,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->data = $data;
        $this->decoder = $decoder;
        $this->encoder = $encoder;
        $this->layoutSettings = $layoutSettings;
    }

    /**
     * Get public reCaptcha key
     * @return string
     */
    public function getPublicKey()
    {
        return $this->config->getPublicKey();
    }

    /**
     * @inheritdoc
     */
    public function getJsLayout()
    {
        $layout = $this->decoder->decode(parent::getJsLayout());
        $layout['components']['hts-recaptcha']['settings'] = $this->layoutSettings->getCaptchaSettings();
        return $this->encoder->encode($layout);
    }
}
