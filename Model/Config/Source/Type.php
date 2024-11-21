<?php
/**
 * HTS Inc.
 *
 * @category  HTS
 * @package   HTS_ReCaptcha
 * @author    HTS
 * @copyright Copyright (c) HTS Inc.
 */

namespace Hts\ReCaptcha\Model\Config\Source;

class Type implements \Magento\Framework\Option\ArrayInterface
{
    const TYPE_RECAPTCHA = 'recaptcha';
    const TYPE_INVISIBLE = 'invisible';

    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray()
    {
        return [
            ['value' => 'recaptcha', 'label' => __('reCaptcha v2')],
            ['value' => 'invisible', 'label' => __('Invisible reCaptcha')],
        ];
    }

    /**
     * Get options in "key-value" format
     *
     * @return array
     */
    public function toArray()
    {
        $options = $this->toOptionArray();
        $return = [];

        foreach ($options as $option) {
            $return[$option['value']] = $option['label'];
        }

        return $return;
    }
}
