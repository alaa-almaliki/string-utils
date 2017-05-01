<?php
namespace StringUtils\Validator;

/**
 * Class File
 * @package StringValidator
 * @author Alaa Al-Maliki <alaa.almaliki@gmail.com>
 */
class File extends AbstractString
{
    /**
     * @return bool
     */
    protected function _validateOptions()
    {
        return parent::_validateOptions() && $this->_validateFile();
    }

    /**
     * @return bool
     */
    protected function _validateFile()
    {
        return $this->_fileExist()
            && (!empty($this->_getAllowedExtensions()) ? in_array($this->_getFileExtension(), $this->_getAllowedExtensions()) : true)
            && ($this->_getSizeOption() > 0 ? $this->_getFileSize() <= $this->_getSizeOption(): true);

    }

    /**
     * @return array
     */
    protected function _getAllowedExtensions()
    {
        $extensions =  (isset($this->_options['allowed_extensions'])? $this->_options['allowed_extensions'] : '');
        return array_map([$this, 'cb'], explode(',', $extensions));
    }

    /**
     * @param $value
     * @return string
     */
    private function cb($value)
    {
        return trim($value);
    }

    /**
     * @return int
     */
    protected function _getSizeOption()
    {
        return (isset($this->_options['file_size'])? (int) $this->_options['file_size'] : 0);
    }

    /**
     * @return mixed|string
     */
    protected function _getFileExtension()
    {
        return pathinfo($this->getValue(), PATHINFO_EXTENSION);
    }

    /**
     * @return int
     */
    protected function _getFileSize()
    {
        return filesize($this->getValue());
    }

    /**
     * @return bool
     */
    protected function _fileExist()
    {
        return file_exists($this->getValue());
    }
}