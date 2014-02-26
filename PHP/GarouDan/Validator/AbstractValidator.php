<?php
namespace GarouDan\Validator;

/**
 * Abstract class to provide validations.
 */
abstract class AbstractValidator
{
    const ERROR = "Error";
    const WARNING = "Warning";
    const SUCCESS = "Success";
    
    /**
     * @var array Validation messages.
     */
    public static $_messages = array();
    
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
    public static function setMessage($type, $key, $message)
    {
        self::$_messages[$type][$key] = $message;
    }
    
    /**
     * 
     * @param array $data
     * @param array $ignorable
     * @throws \DomainException
     * @throws \InvalidArgumentException
     */
    public static function isValidCollection(array $data, array $ignorable = null)
    {
        if (!is_array($data)) {
            throw new \DomainException("The data provided must be an array.");
        } elseif (empty($data)) {
            throw new \InvalidArgumentException("The data provided is empty.");
        }
    }
}

