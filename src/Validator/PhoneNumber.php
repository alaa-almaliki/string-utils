<?php
namespace StringUtils\Validator;

use libphonenumber\PhoneNumberUtil;
use libphonenumber\NumberParseException;

/**
 * Class PhoneNumber
 * @package StringValidator
 * @author Alaa Al-Maliki <alaa.almaliki@gmail.com>
 */
class PhoneNumber extends AbstractString
{
    /** @var  bool  */
    protected $_canPrintException = false;

    /**
     * @return bool
     */
    protected function _validateOptions()
    {
        return parent::_validateOptions() && $this->_validatePhoneNumber();
    }

    /**
     * @return bool
     */
    protected function _validatePhoneNumber()
    {
        $phoneUtil = $this->_getPhoneUtil();

        try {
            $valid = $phoneUtil->isValidNumber($phoneUtil->parse($this->getValue(), $this->_getCountryCode()));
        } catch (NumberParseException $e) {
            if ($this->canPrintException()) {
                print_r($e->getMessage() . PHP_EOL);
            }
            $valid = false;
        }

        return $valid;
    }

    /**
     * @param null|bool $flag
     * @return bool
     */
    public function canPrintException($flag = null)
    {
        if ($flag !== null) {
            $this->_canPrintException = $flag;
        }

        return $this->_canPrintException;
    }

    /**
     * @return string
     */
    protected function _getCountryCode()
    {
        return (isset($this->_options['country_code'])? $this->_options['country_code'] : null);
    }

    /**
     * @return PhoneNumberUtil
     */
    protected function _getPhoneUtil()
    {
        return PhoneNumberUtil::getInstance();
    }
}