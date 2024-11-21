<?php
/**
 * HTS Inc.
 *
 * @category  HTS
 * @package   HTS_ReCaptcha
 * @author    HTS
 * @copyright Copyright (c) HTS Inc.
 */

namespace Hts\ReCaptcha\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\HTTP\PhpEnvironment\RemoteAddress;
use Hts\ReCaptcha\Api\ValidateInterface;
use Hts\ReCaptcha\Model\IsCheckRequiredInterface;
use Hts\ReCaptcha\Model\Provider\FailureProviderInterface;
use Hts\ReCaptcha\Model\Provider\ResponseProviderInterface;

class ReCaptchaObserver implements ObserverInterface
{
    /**
     * @var FailureProviderInterface
     */
    private $failureProvider;

    /**
     * @var ValidateInterface
     */
    private $validate;

    /**
     * @var RemoteAddress
     */
    private $remoteAddress;

    /**
     * @var ResponseProviderInterface
     */
    private $responseProvider;

    /**
     * @var IsCheckRequiredInterface
     */
    private $isCheckRequired;

    /**
     * ReCaptchaObserver constructor.
     * @param ResponseProviderInterface $responseProvider
     * @param ValidateInterface $validate
     * @param FailureProviderInterface $failureProvider
     * @param RemoteAddress $remoteAddress
     * @param IsCheckRequiredInterface $isCheckRequired
     */
    public function __construct(
        ResponseProviderInterface $responseProvider,
        ValidateInterface $validate,
        FailureProviderInterface $failureProvider,
        RemoteAddress $remoteAddress,
        IsCheckRequiredInterface $isCheckRequired
    ) {
        $this->responseProvider = $responseProvider;
        $this->validate = $validate;
        $this->failureProvider = $failureProvider;
        $this->remoteAddress = $remoteAddress;
        $this->isCheckRequired = $isCheckRequired;
    }

    /**
     * @param Observer $observer
     * @return void
     */
    public function execute(Observer $observer)
    {
        if ($this->isCheckRequired->execute()) {
            $reCaptchaResponse = $this->responseProvider->execute();
            $remoteIp = $this->remoteAddress->getRemoteAddress();

            /** @var \Magento\Framework\App\Action\Action $controller */
            $controller = $observer->getControllerAction();

            if (!$this->validate->validate($reCaptchaResponse, $remoteIp)) {
                $this->failureProvider->execute($controller ? $controller->getResponse(): null);
            }
        }
    }
}
