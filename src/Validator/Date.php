<?php
namespace StringUtils\Validator;

/**
 * Class Date
 * @package StringValidator
 * @author Alaa Al-Maliki <alaa.almaliki@gmail.com>
 */
class Date extends AbstractString
{
    /** @var array  */
    private static $delimiters = [
        '-',
        '/',
        '.'
    ];

    /**
     * @return bool
     */
    protected function _validateOptions()
    {
        return parent::_validateOptions() && $this->_validateDate();
    }

    /**
     * @return bool|mixed
     */
    protected function _validateDate()
    {
        $dateArray = $this->_getDateArray();
        $dateFormat = isset($this->_options['date_format'])? $this->_options['date_format'] : false;
        if ($dateFormat === false) {
            $year = $dateArray[2];
            return ($this->_isShortYear($year) || $this->_isLongYear($year))
                && ($dateArray[0] > 12 && $dateArray[1] > 12)? false: true;
        }

        $ddmm = $this->_isDay($dateArray[0]) && $this->_isMonth($dateArray[1]);
        $mmdd = $this->_isMonth($dateArray[0]) && $this->_isDay($dateArray[1]);

        $validDates = [
            'dd/mm/yy'      => $ddmm && $this->_isShortYear($dateArray[2]),
            'dd/mm/yyyy'    => $ddmm && $this->_isLongYear($dateArray[2]),
            'mm/dd/yy'      => $mmdd && $this->_isShortYear($dateArray[2]),
            'mm/dd/yyyy'    => $mmdd && $this->_isLongYear($dateArray[2])
        ];

        if (!in_array($dateFormat, array_keys($validDates))) {
            return false;
        }

        return $validDates[$dateFormat];
    }

    /**
     * @return array
     */
    protected function _getDateArray()
    {
        return explode($this->_getDelimiter(), $this->getValue());
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    protected function _getDelimiter()
    {
        foreach (self::$delimiters as $delimiter) {
            if (strpos($this->getValue(), $delimiter) !== false) {
                return $delimiter;
            }
        }
        throw new \Exception('Can not find date delimiter');
    }

    /**
     * @param  string $value
     * @return bool
     */
    protected function _isDay($value)
    {
        return 31 >= $value && 0 < $value;
    }

    /**
     * @param  string $value
     * @return bool
     */
    protected function _isMonth($value)
    {
        return 0 < $value && 12 >= $value;
    }

    /**
     * @param  string $value
     * @return bool
     */
    protected function _isShortYear($value)
    {
        return $this->_validateYear('short', $value);
    }

    /**
     * @param  string $value
     * @return bool
     */
    protected function _isLongYear($value)
    {
        return $this->_validateYear('long', $value);
    }

    /**
     * @param  string $type
     * @param  string $value
     * @return bool
     */
    private function _validateYear($type, $value)
    {
        $types = [
            'short' => '2',
            'long' => '4'
        ];

        $pattern = sprintf('/^[1-9]{%d}$/', $types[$type]);
        return $this->_regex($pattern, $value);
    }
}