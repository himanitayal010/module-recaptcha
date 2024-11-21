<?php
/**
 * HTS Inc.
 *
 * @category  HTS
 * @package   HTS_ReCaptcha
 * @author    HTS
 * @copyright Copyright (c) HTS Inc.
 */

namespace Hts\ReCaptcha\Plugin\Block\Account;

use Magento\Framework\Json\DecoderInterface;
use Magento\Framework\Json\EncoderInterface;
use Hts\ReCaptcha\Model\LayoutSettings;

class AuthenticationPopupPlugin
{
    /**
     * @var EncoderInterface
     */
    private $encoder;

    /**
     * @var DecoderInterface
     */
    private $decoder;

    /**
     * @var LayoutSettings
     */
    private $layoutSettings;

    /**
     * AuthenticationPopupPlugin constructor.
     * @param EncoderInterface $encoder
     * @param DecoderInterface $decoder
     * @param LayoutSettings $layoutSettings
     */
    public function __construct(
        EncoderInterface $encoder,
        DecoderInterface $decoder,
        LayoutSettings $layoutSettings
    ) {
        $this->encoder = $encoder;
        $this->decoder = $decoder;
        $this->layoutSettings = $layoutSettings;
    }

    /**
     * @param \Magento\Customer\Block\Account\AuthenticationPopup $subject
     * @param array $result
     * @return string
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function afterGetJsLayout(\Magento\Customer\Block\Account\AuthenticationPopup $subject, $result)
    {
        $layout = $this->decoder->decode($result);
        $layout['components']['authenticationPopup']['children']['hts_recaptcha']['settings'] =
            $this->layoutSettings->getCaptchaSettings();

        return $this->encoder->encode($layout);
    }
}
