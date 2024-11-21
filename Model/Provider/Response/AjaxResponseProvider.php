<?php
/**
 * HTS Inc.
 *
 * @category  HTS
 * @package   HTS_ReCaptcha
 * @author    HTS
 * @copyright Copyright (c) HTS Inc.
 */

namespace Hts\ReCaptcha\Model\Provider\Response;

use Magento\Framework\App\RequestInterface;
use Magento\Framework\Json\DecoderInterface;
use Hts\ReCaptcha\Model\Provider\ResponseProviderInterface;

class AjaxResponseProvider implements ResponseProviderInterface
{
    /**
     * @var RequestInterface
     */
    private $request;

    /**
     * @var DecoderInterface
     */
    private $decoder;

    /**
     * AjaxResponseProvider constructor.
     * @param RequestInterface $request
     * @param DecoderInterface $decoder
     */
    public function __construct(
        RequestInterface $request,
        DecoderInterface $decoder
    ) {
        $this->request = $request;
        $this->decoder = $decoder;
    }

    /**
     * Handle reCaptcha failure
     * @return string
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function execute()
    {
        if ($content = $this->request->getContent()) {
            try {
                $jsonParams = $this->decoder->decode($content);
                if (isset($jsonParams['g-recaptcha-response'])) {
                    return $jsonParams['g-recaptcha-response'];
                }
            } catch (\Exception $e) {
                return '';
            }
        }
    }
}
