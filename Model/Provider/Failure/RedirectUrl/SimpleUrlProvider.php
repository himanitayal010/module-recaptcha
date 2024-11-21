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

use Magento\Framework\UrlInterface;
use Hts\ReCaptcha\Model\Provider\Failure\RedirectUrlProviderInterface;

class SimpleUrlProvider implements RedirectUrlProviderInterface
{
    /**
     * @var string
     */
    private $urlPath;

    /**
     * @var array
     */
    private $urlParams;

    /**
     * @var UrlInterface
     */
    private $url;

    /**
     * SimpleUrlProvider constructor.
     * @param UrlInterface $url
     * @param $urlPath
     * @param null $urlParams
     */
    public function __construct(
        UrlInterface $url,
        $urlPath,
        $urlParams = null
    ) {
        $this->urlPath = $urlPath;
        $this->urlParams = $urlParams;
        $this->url = $url;
    }

    /**
     * Get redirection URL
     * @return string
     */
    public function execute()
    {
        return $this->url->getUrl($this->urlPath, $this->urlParams);
    }
}
