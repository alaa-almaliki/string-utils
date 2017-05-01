<?php
namespace StringUtils\Validator;

/**
 * Class Alphabet
 * @package StringUtils\Validator
 * @author Alaa Al-Maliki <alaa.almaliki@gmail.com>
 */
class Alphabet extends AbstractString
{
    /**
     * @return bool
     */
    protected function _validateOptions()
    {
        return parent::_validateOptions() && $this->_regex('/^([a-z])+$/i');
    }
}