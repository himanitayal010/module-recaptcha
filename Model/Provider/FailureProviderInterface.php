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

use Magento\Framework\App\ResponseInterface;

interface FailureProviderInterface
{
    /**
     * Handle reCaptcha failure
     * @param ResponseInterface $response
     * @return void
     */
    public function execute(ResponseInterface $response = null);
}
