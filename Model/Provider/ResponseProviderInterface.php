<?php
/**
 * HTS Inc.
 *
 * @category  HTS
 * @package   HTS_ReCaptcha
 * @author    HTS
 * @copyright Copyright (c) HTS Inc.
 */

namespace Hts\ReCaptcha\Model\Provider;

interface ResponseProviderInterface
{
    /**
     * Handle reCaptcha failure
     * @return string
     */
    public function execute();
}
