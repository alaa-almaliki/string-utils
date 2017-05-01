<?php
namespace StringUtils\Validator;

/**
 * Class Alnum
 * @package StringUtils\Validator
 * @author Alaa Al-Maliki <alaa.almaliki@gmail.com>
 */
class Alnum extends AbstractString
{
    /**
     * @return bool
     */
    protected function _validateOptions()
    {
        return parent::_validateOptions() && $this->_regex('/^([a-z0-9])+$/i');
    }
}