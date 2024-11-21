<?php
/**
 * HTS Inc.
 *
 * @category  HTS
 * @package   HTS_ReCaptcha
 * @author    HTS
 * @copyright Copyright (c) HTS Inc.
 */

namespace Hts\ReCaptcha\Block\LayoutProcessor\Checkout;

use Magento\Checkout\Block\Checkout\LayoutProcessorInterface;
use Hts\ReCaptcha\Model\LayoutSettings;

class Onepage implements LayoutProcessorInterface
{
    /**
     * @var LayoutSettings
     */
    private $layoutSettings;

    /**
     * Onepage constructor.
     * @param LayoutSettings $layoutSettings
     */
    public function __construct(
        LayoutSettings $layoutSettings
    ) {
        $this->layoutSettings = $layoutSettings;
    }

    /**
     * Process js Layout of block
     *
     * @param array $jsLayout
     * @return array
     */
    public function process($jsLayout)
    {
        $jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']['children']
            ['shippingAddress']['children']['customer-email']['children']
            ['hts_recaptcha']['settings'] = $this->layoutSettings->getCaptchaSettings();

        $jsLayout['components']['checkout']['children']['authentication']['children']
            ['hts_recaptcha']['settings'] = $this->layoutSettings->getCaptchaSettings();

        return $jsLayout;
    }
}
