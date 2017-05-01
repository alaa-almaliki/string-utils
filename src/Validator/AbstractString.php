<?php
namespace StringUtils\Validator;

/**
 * Class AbstractInput
 * @package StringValidator
 * @author Alaa Al-Maliki <alaa.almaliki@gmail.com>
 */
abstract class AbstractString implements StringValidatorInterface
{
    /** @var  string */
    protected $_value;
    /** @var array */
    protected $_options = [];

    /**
     * AbstractInput constructor.
     * @param string $value
     * @param array $options
     */
    public function __construct($value, array $options = [])
    {
        $this->_value = trim($value);
        $this->_options = $options;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->_value;
    }

    /**
     * @return array
     */
    public function getOptions()
    {
        return $this->_options;
    }

    /**
     * @return bool
     */
    public function isValid()
    {
        return !empty($this->getValue()) && $this->_validateOptions();
    }

    /**
     * @return bool
     */
    protected function _validateOptions()
    {
        $valid = true;
        if (empty($this->_options)) {
            $valid = true;
        }

        foreach ($this->_getValidationRules() as $key => $value) {
            $valid &= $value === $this->_getValidationValue($key);
        }

        return $valid;
    }

    /**
     * @param  string $rule
     * @return bool
     */
    protected function _getValidationValue($rule)
    {
        $values = [
            'min_length'    => strlen($this->_value) >= (int)$this->_options[$rule],
            'max_length'    => strlen($this->_value) <= (int)$this->_options[$rule],
            'allow_xml'     => $this->_regex('/[<>]/'),
        ];

        if (!in_array($rule, array_keys($values))) {
            return true;
        }

        return $values[$rule];
    }

    /**
     * @return array
     */
    protected function _getValidationRules()
    {
        $validationRules = [];
        foreach ($this->_options as $key => $value) {
            if ($value !== null) {
                $validationRules[$key] = (bool) $value;
            }
        }

        return $validationRules;
    }

    /**
     * @param  string $pattern
     * @param  string|null $value
     * @return bool
     */
    protected function _regex($pattern, $value = null)
    {
        if (null === $value) {
            $value = $this->_value;
        }
        return (bool) preg_match($pattern, $value);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getValue();
    }

    /**
     * @return mixed
     */
    public function debug()
    {
        $valid = $this->isValid();
        $optionStatement = (!empty($this->_options) ? 'with options:' : '');

        if (!empty($optionStatement)) {
            foreach ($this->_options as $option => $value) {
                $valueToString = (is_bool($value) ? ($value === false ? 'false': 'true') : $value);
                $optionStatement .= sprintf(' %s (%s),', $option, $valueToString);
            }
        }

        $debugStatement = sprintf(
            '%s is %s %s %s',
            $this->getValue(),
            ($valid ? 'valid' : 'not valid'),
            rtrim($optionStatement, ','),
            PHP_EOL
        );
        return print_r($debugStatement);
    }
}