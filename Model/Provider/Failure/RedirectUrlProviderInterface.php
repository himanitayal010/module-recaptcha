<?php
/**
 * HTS Inc.
 *
 * @category  HTS
 * @package   HTS_ReCaptcha
 * @author    HTS
 * @copyright Copyright (c) HTS Inc.
 */

namespace Hts\ReCaptcha\Model\Provider\Failure;

interface RedirectUrlProviderInterface
{
    /**
     * Get redirection URL
     * @return string
     */
    public function execute();
}
