<?php
namespace StringUtils\Validator;

/**
 * Class Password
 * @package StringValidator
 * @author Alaa Al-Maliki<alaa.almaliki@gmail.com>
 */
class Password extends AbstractString
{
    const PASSWORD_MIN_LENGTH = 6;

    /**
     * @return bool
     */
    protected function _validateOptions()
    {
        $this->_setDefaultMinLength();
        return parent::_validateOptions() && $this->_validatePassword();
    }

    /**
     * @return bool
     */
    protected function _validatePassword()
    {
        $patterns = $this->_getPasswordPatterns($this->_parseOption());
        $valid = true;
        foreach ($patterns as $pattern) {
            $valid &= $this->_regex($pattern);
        }
        return $valid;
    }

    /**
     * @return string
     */
    protected function _parseOption()
    {
        if (isset($this->_options['strict_password']) && $this->_options['strict_password'] === true) {
            return 'strict_password';
        }

        return 'basic_password';
    }

    /**
     * @param  string $passwordType
     * @return array
     */
    protected function _getPasswordPatterns($passwordType)
    {
        $defaultPattern = [
            '/[0-9]+/',
            '/[a-z]+/i',
        ];

        $patterns = [
            'basic_password' => $defaultPattern,
            'strict_password' => array_merge(['/[\'^£$%&*()}{@#~?><>,|=_+¬-]+/'], $defaultPattern),
        ];

        if (!in_array($passwordType, array_keys($patterns))) {
            $passwordType = 'basic_password';
        }

        return $patterns[$passwordType];
    }

    /**
     * @return $this
     */
    protected function _setDefaultMinLength()
    {
        if (!isset($this->_options['min_length'])) {
            $this->_options['min_length'] = self::PASSWORD_MIN_LENGTH;
        }

        return $this;
    }
}