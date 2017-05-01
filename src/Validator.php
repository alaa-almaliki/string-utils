<?php
namespace StringUtils;

/**
 * Class Validator
 * @package StringValidator
 * @author Alaa Al-Maliki <alaa.almaliki@gmail.com>
 */
final class Validator
{
    /** @var bool  */
    static private $debugMode = false;

    /**
     * @param string $className
     * @param string $value
     * @param array $options
     * @param bool $debug
     * @return bool
     */
    static public function is($className, $value, array $options = [], $debug = null)
    {
        $fullClassName = [
            __NAMESPACE__,
            'Validator',
            $className
        ];
        $fullClassName = implode('\\', $fullClassName);
        $object = new $fullClassName($value, $options);

        if (self::$debugMode || $debug === true) {
            $object->debug();
        }
        return $object->isValid();
    }

    /**
     * @param string $value
     * @param array $options
     * @param bool $debug
     * @return bool
     */
    static function isDate($value, array $options = [], $debug = null)
    {
        return self::is('Date', $value, $options, $debug);
    }

    /**
     * @param  string $value
     * @param  array $options
     * @param  bool $debug
     * @return bool
     */
    static public function isEmail($value, array $options = [], $debug = null)
    {
        return self::is('Email', $value, $options, $debug);
    }

    /**
     * @param  string $value
     * @param  array $options
     * @param  null|bool $debug
     * @return bool
     */
    static public function isFile($value, array $options = [], $debug = null)
    {
        return self::is('File', $value, $options, $debug);
    }

    /**
     * @param  string $value
     * @param  array $options
     * @param  null|bool $debug
     * @return bool
     */
    static public function isName($value, array $options = [], $debug = null)
    {
        return self::is('Name', $value, $options, $debug);
    }

    /**
     * @param  string $value
     * @param  array $options
     * @param  null|bool $debug
     * @return bool
     */
    static public function isPassword($value, array $options = [], $debug = null)
    {
        return self::is('Password', $value, $options, $debug);
    }

    /**
     * @param  string $value
     * @param  array $options
     * @param  null|bool $debug
     * @return bool
     */
    static public function isPhoneNumber($value, array $options = [], $debug = null)
    {
        return self::is('PhoneNumber', $value, $options, $debug);
    }

    /**
     * @param  string $value
     * @param  array $options
     * @param  null|bool $debug
     * @return bool
     */
    static public function isText($value, array $options = [], $debug = null)
    {
        return self::is('Text', $value, $options, $debug);
    }

    /**
     * @param  string $value
     * @param  array $options
     * @param  null|bool $debug
     * @return bool
     */
    static public function isTime($value, array $options = [], $debug = null)
    {
        return self::is('Time', $value, $options, $debug);
    }

    /**
     * @param  string $value
     * @param  array $options
     * @param  null|bool $debug
     * @return bool
     */
    static public function isNumeric($value, array $options = [], $debug = null)
    {
        return self::is('Numeric', $value, $options, $debug);
    }

    /**
     * @param  string $value
     * @param  array $options
     * @param  null|bool $debug
     * @return bool
     */
    static public function isAlphabet($value, array $options = [], $debug = null)
    {
        return self::is('Alphabet', $value, $options, $debug);
    }

    /**
     * @param  string $value
     * @param  array $options
     * @param  null|bool $debug
     * @return bool
     */
    static public function isAlnum($value, array $options = [], $debug = null)
    {
        return self::is('Alnum', $value, $options, $debug);
    }

    /**
     * @param $flag
     */
    static public function setDebugMode($flag)
    {
        self::$debugMode = $flag;
    }
}