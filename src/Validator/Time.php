<?php
namespace StringUtils\Validator;

/**
 * Class Time
 * @package StringValidator
 * @author Alaa Al-Maliki <alaa.almaliki@gmail.com>
 */
class Time extends AbstractString
{
    /** @var array  */
    private static $defaultTimeFormats = [
        'h:i',
        'h:i:s',
        'H:i',
        'H:i:s'
    ];

    /**
     * @return bool
     */
    protected function _validateOptions()
    {
        return parent::_validateOptions() && $this->_validateTime();
    }

    /**
     * @return bool
     */
    protected function _validateTime()
    {
        $valid = true;

        if (empty($this->_getTimeFormats())) {
            return (($this->_validateHour12($this->_get('hour')) || $this->_validateHour24($this->_get('hour')))
                    && $this->_validateMinutesOrSeconds($this->_get('minute')))
                || $this->_validateMinutesOrSeconds($this->_get('second'));
        }

        foreach ($this->_getTimeFormats() as $format) {
            switch ($format) {
                case 'h':
                    $valid &= $this->_validateHour12($this->_get('hour'));
                    break;
                case 'H':
                    $valid &= $this->_validateHour24($this->_get('hour'));
                    break;
                case 'i':
                    $valid &= $this->_validateMinutesOrSeconds($this->_get('minute'));
                    break;
                case 's':
                    $valid &= $this->_validateMinutesOrSeconds($this->_get('second'));
                    break;
                default:
                    $valid = false;
            }
        }

        return $valid;
    }

    /**
     * @param  int $value
     * @return bool
     */
    protected function _validateHour24($value)
    {
        return 0 <= $value && 23 >= $value;
    }

    /**
     * @param  int $value
     * @return bool
     */
    protected function _validateHour12($value)
    {
        return 1 <= $value && 12 >= $value;
    }

    /**
     * @param  int $value
     * @return bool
     */
    protected function _validateMinutesOrSeconds($value)
    {
        return 0 <= $value && 59 >= $value;
    }

    /**
     * @return array
     */
    protected function _getTimeFormats()
    {
        $timeFormat =  (isset($this->_options['time_format'])? $this->_options['time_format'] : '');

        if (!in_array($timeFormat, self::$defaultTimeFormats)) {
            return [];
        }

        return explode(':', $timeFormat);
    }

    /**
     * @param  string $time
     * @return int
     */
    protected function _get($time)
    {
        $timeArray = explode(':', $this->getValue());
        if (empty($timeArray)) {
            return -1;
        }

        switch ($time) {
            case 'hour':
                return (isset($timeArray[0]) ? $timeArray[0] : -1);
            case 'minute':
                return (isset($timeArray[1]) ? $timeArray[1] : -1);
            case 'second':
                return (isset($timeArray[2]) ? $timeArray[2] : -1);
            default:
                return -1;
        }
    }
}