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

use Hts\ReCaptcha\Api\ValidateInterface;
use ReCaptcha\ReCaptcha;

class Validate implements ValidateInterface
{
    /**
     * @var Config
     */
    private $config;

    /**
     * Validate constructor.
     * @param Config $config
     */
    public function __construct(
        Config $config
    ) {
        $this->config = $config;
    }

    /**
     * Return true if reCaptcha validation has passed
     * @param string $reCaptchaResponse
     * @param string $remoteIp
     * @return bool
     */
    public function validate($reCaptchaResponse, $remoteIp)
    {
        $secret = $this->config->getPrivateKey();

        if ($reCaptchaResponse) {
            // @codingStandardsIgnoreStart
            $reCaptcha = new ReCaptcha($secret);
            // @codingStandardsIgnoreEmd

            $res = $reCaptcha->verify($reCaptchaResponse, $remoteIp);

            if ($res->isSuccess()) {
                return true;
            }
        }

        return false;
    }
}
