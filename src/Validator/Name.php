<?php
namespace StringUtils\Validator;

/**
 * Class Name
 * @package StringValidator
 * @author Alaa Al-Maliki<alaa.almaliki@gmail.com>
 */
class Name extends AbstractString
{
    /**
     * @return bool
     */
    protected function _validateOptions()
    {
        return parent::_validateOptions() && $this->_validateName();
    }

    /**
     * @return bool
     */
    protected function _validateName()
    {
        return $this->_regex("/^[A-Z]*[a-zA-Z '&-]*[A-Za-z]$/");
    }
}
