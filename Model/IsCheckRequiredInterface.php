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

interface IsCheckRequiredInterface
{
    /**
     * Return true if check is required
     * @return bool
     */
    public function execute();
}
