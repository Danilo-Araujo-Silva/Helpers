<?php
namespace GarouDan\Validator;

/**
 * Abstract class to provide validations.
 */
abstract class AbstractValidator
{
    /**
     * @var array Validation messages.
     */
    protected static $_messages = array();
    
    protected static $_input = array();
    
    protected static $_ignore = array();
    
    /**
     * Get the validation messages.
     */
    public static function getMessages()
    {
        return self::$_messages;
    }
    
    /**
     * Set a validation message of a certain type, on a certain key with a
     *  certain message.
     * 
     * @param string $type    Type of the validation return.
     * @param string $key     Name of the field validated.
     * @param string $message Validation message.
     */
    protected static function setMessage($key, $message)
    {
        self::$_messages[$type][$key] = $message;
    }    
    
    public static function getKeyByMethodName($method)
    {
        return \lcfirst(\preg_replace("/^[_]isValid$/", "", (string) $method));
    }
    
    public static function _isValidData(array $input, array $ignorable)
    {
        if (($message = self::_isValidInput($input)) !== true) {
            throw new \DomainException($message);
        } elseif (($message = self::isValidIgnorable($ignorable)) !== true) {
            throw new \DomainException($message);
        }
        
        $finalKeys = array_diff(array_keys($ignorable));
    }
    
    public static function _isValidArray($input)
    {
        if (!is_array($input)) {
            return "The input is not an array.";
        }
        
        return true;
    }
    
    public static function _isValidMultidimensionalArray($input)
    {
        if (($message = self::_isValidArray($input)) !== true) {
            return $message;
        } elseif (count($input) == count($input, COUNT_RECURSIVE)) {
            return "The input is not a multidimensional array.";
        }
        
        return true;
    }
    
    public static function _isValidUnidimensionalArray($input)
    {
        if (($message = self::_isValidArray($input)) !== true) {
            return $message;
        } elseif (($message = self::_isMultidimensionalArray($input)) === true) {
            return "The input is not a unidimensional array.";
        }
        
        return true;
    }
}

