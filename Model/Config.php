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

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Phrase;
use Magento\Store\Model\ScopeInterface;
use Hts\ReCaptcha\Model\Config\Source\Type;

class Config
{
    const XML_PATH_ENABLED_BACKEND = 'hts_security_recaptcha/backend/enabled';
    const XML_PATH_ENABLED_FRONTEND = 'hts_security_recaptcha/frontend/enabled';

    const XML_PATH_TYPE_FRONTEND = 'hts_security_recaptcha/frontend/type';
    const XML_PATH_LANGUAGE_CODE = 'hts_security_recaptcha/frontend/lang';

    const XML_PATH_POSITION_FRONTEND = 'hts_security_recaptcha/frontend/position';

    const XML_PATH_SIZE_BACKEND = 'hts_security_recaptcha/backend/size';
    const XML_PATH_SIZE_FRONTEND = 'hts_security_recaptcha/frontend/size';
    const XML_PATH_THEME_BACKEND = 'hts_security_recaptcha/backend/theme';
    const XML_PATH_THEME_FRONTEND = 'hts_security_recaptcha/frontend/theme';

    const XML_PATH_PUBLIC_KEY = 'hts_security_recaptcha/general/public_key';
    const XML_PATH_PRIVATE_KEY = 'hts_security_recaptcha/general/private_key';

    const XML_PATH_ENABLED_FRONTEND_LOGIN = 'hts_security_recaptcha/frontend/enabled_login';
    const XML_PATH_ENABLED_FRONTEND_FORGOT = 'hts_security_recaptcha/frontend/enabled_forgot';
    const XML_PATH_ENABLED_FRONTEND_CONTACT = 'hts_security_recaptcha/frontend/enabled_contact';
    const XML_PATH_ENABLED_FRONTEND_CREATE = 'hts_security_recaptcha/frontend/enabled_create';

    /**
     * @var ScopeConfigInterface
     */
    private $scopeConfig;

    /**
     * Config constructor.
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(ScopeConfigInterface $scopeConfig)
    {
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * Get error
     * @return Phrase
     */
    public function getErrorDescription()
    {
        return __('Incorrect reCAPTCHA');
    }

    /**
     * Get google recaptcha public key
     * @return string
     */
    public function getPublicKey()
    {
        if (!empty($this->scopeConfig->getValue(static::XML_PATH_PUBLIC_KEY))) {
            return trim($this->scopeConfig->getValue(static::XML_PATH_PUBLIC_KEY));
        }
    }

    /**
     * Get google recaptcha private key
     * @return string
     */
    public function getPrivateKey()
    {
        if(!empty($this->scopeConfig->getValue(static::XML_PATH_PRIVATE_KEY))) {
            return trim($this->scopeConfig->getValue(static::XML_PATH_PRIVATE_KEY));
        }
    }

    /**
     * Return true if enabled on backend
     * @return bool
     */
    public function isEnabledBackend()
    {
        if (!$this->getPrivateKey() || !$this->getPublicKey()) {
            return false;
        }

        return (bool) $this->scopeConfig->getValue(static::XML_PATH_ENABLED_BACKEND);
    }

    /**
     * Return true if enabled on frontend
     * @return bool
     */
    public function isEnabledFrontend()
    {
        if (!$this->getPrivateKey() || !$this->getPublicKey()) {
            return false;
        }

        return (bool) $this->scopeConfig->getValue(static::XML_PATH_ENABLED_FRONTEND);
    }

    /**
     * Return true if enabled on frontend login
     * @return bool
     */
    public function isEnabledFrontendLogin()
    {
        if (!$this->isEnabledFrontend()) {
            return false;
        }

        return (bool) $this->scopeConfig->getValue(static::XML_PATH_ENABLED_FRONTEND_LOGIN);
    }

    /**
     * Return true if enabled on frontend forgot password
     * @return bool
     */
    public function isEnabledFrontendForgot()
    {
        if (!$this->isEnabledFrontend()) {
            return false;
        }

        return (bool) $this->scopeConfig->getValue(static::XML_PATH_ENABLED_FRONTEND_FORGOT);
    }

    /**
     * Return true if enabled on frontend contact
     * @return bool
     */
    public function isEnabledFrontendContact()
    {
        if (!$this->isEnabledFrontend()) {
            return false;
        }

        return (bool) $this->scopeConfig->getValue(static::XML_PATH_ENABLED_FRONTEND_CONTACT);
    }

    /**
     * Return true if enabled on frontend create user
     * @return bool
     */
    public function isEnabledFrontendCreate()
    {
        if (!$this->isEnabledFrontend()) {
            return false;
        }

        return (bool) $this->scopeConfig->getValue(static::XML_PATH_ENABLED_FRONTEND_CREATE);
    }

    /**
     * Get data size
     * @return string
     */
    public function getFrontendSize()
    {
        if ($this->getFrontendType() == Type::TYPE_INVISIBLE) {
            return 'invisible';
        }

        return $this->scopeConfig->getValue(static::XML_PATH_SIZE_FRONTEND);
    }

    /**
     * Get data size
     * @return string
     */
    public function getBackendSize()
    {
        return $this->scopeConfig->getValue(static::XML_PATH_SIZE_BACKEND);
    }

    /**
     * Get data size
     * @return string
     */
    public function getFrontendTheme()
    {
        if ($this->getFrontendType() == Type::TYPE_INVISIBLE) {
            return null;
        }

        return $this->scopeConfig->getValue(static::XML_PATH_THEME_FRONTEND);
    }

    /**
     * Get data size
     * @return string
     */
    public function getBackendTheme()
    {
        return $this->scopeConfig->getValue(static::XML_PATH_THEME_BACKEND);
    }

    /**
     * Get data size
     * @return string
     */
    public function getFrontendPosition()
    {
        if ($this->getFrontendType() != Type::TYPE_INVISIBLE) {
            return null;
        }

        return $this->scopeConfig->getValue(static::XML_PATH_POSITION_FRONTEND);
    }

    /**
     * Get data size
     * @return string
     */
    public function getFrontendType()
    {
        return $this->scopeConfig->getValue(static::XML_PATH_TYPE_FRONTEND);
    }

    /**
     * Get language code
     * @return string
     */
    public function getLanguageCode()
    {
        return $this->scopeConfig->getValue(static::XML_PATH_LANGUAGE_CODE, ScopeInterface::SCOPE_STORE);
    }
}
