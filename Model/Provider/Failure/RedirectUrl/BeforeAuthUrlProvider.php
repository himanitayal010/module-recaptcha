<?php
/**
 * HTS Inc.
 *
 * @category  HTS
 * @package   HTS_ReCaptcha
 * @author    HTS
 * @copyright Copyright (c) HTS Inc.
 */

namespace Hts\ReCaptcha\Model\Provider\Failure\RedirectUrl;

use Magento\Customer\Model\Url;
use Magento\Framework\Session\SessionManagerInterface;
use Hts\ReCaptcha\Model\Provider\Failure\RedirectUrlProviderInterface;

class BeforeAuthUrlProvider implements RedirectUrlProviderInterface
{
    /**
     * @var SessionManagerInterface
     */
    private $sessionManager;

    /**
     * @var Url
     */
    private $url;

    /**
     * BeforeAuthUrlProvider constructor.
     * @param SessionManagerInterface $sessionManager
     * @param Url $url
     */
    public function __construct(
        SessionManagerInterface $sessionManager,
        Url $url
    ) {
        $this->sessionManager = $sessionManager;
        $this->url = $url;
    }

    /**
     * Get redirection URL
     * @return string
     */
    public function execute()
    {
        $beforeUrl = $this->sessionManager->getBeforeAuthUrl();
        return $beforeUrl ?: $this->url->getLoginUrl();
    }
}
