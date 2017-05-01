<?php
namespace StringUtils\Validator;

/**
 * Class Number
 * @package StringUtils\Validator
 * @author Alaa Al-Maliki <alaa.almaliki@gmail.com>
 */
class Numeric extends AbstractString
{
    /**
     * @return bool
     */
    protected function _validateOptions()
    {
        return parent::_validateOptions() && !$this->_regex('/[^0-9]/');
    }
}