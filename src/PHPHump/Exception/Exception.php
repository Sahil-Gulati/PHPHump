<?php

/**
 * @author Sahil Gulati <sahil.gulati1991@outlook.com>
 * @desc
 */
namespace PHPHump\Exception;
class Exception extends \Exception
{
    protected $extendedMessage="";
    
    public function __construct($errorType)
    {
        $arguments=  func_get_args();
        print_r($arguments);
        switch ($errorType)
        {
            case \PHPHump\Constants\Exception::VARIABLE:
                if(class_exists(\PHPHump\Constants\Plugin::VARIABLE))
                {
                    $pluginClass=\PHPHump\Constants\Plugin::VARIABLE;
                    $message=$pluginClass::getMessage($arguments[1],$arguments[2]);
                    $this->extendedMessage=$pluginClass::getExtendedMessage($arguments[1],$arguments[2]);
                }
                else
                {
                    $message=\PHPHump\Exception\Variable::getMessage($arguments[1],$arguments[2]);
                    $this->extendedMessage=\PHPHump\Exception\Variable::getExtendedMessage($arguments[1],$arguments[2]);
                }
                break;
            case \PHPHump\Constants\Exception::FILE:
                if(class_exists(\PHPHump\Constants\Plugin::FILE))
                {
                    $pluginClass=\PHPHump\Constants\Plugin::FILE;
                    $message=$pluginClass::getMessage($arguments[1],$arguments[2]);
                    $this->extendedMessage=$pluginClass::getExtendedMessage($arguments[1],$arguments[2]);
                }
                else
                {
                    $message=  \PHPHump\Exception\File::getMessage($arguments[1],$arguments[2]);
                    $this->extendedMessage=\PHPHump\Exception\File::getExtendedMessage($arguments[1],$arguments[2]);
                }
                break;
            case \PHPHump\Constants\Exception::ATTRIBUTE:
                if(class_exists(\PHPHump\Constants\Plugin::ATTRIBUTE))
                {
                    $pluginClass=\PHPHump\Constants\Plugin::ATTRIBUTE;
                    $message=$pluginClass::getMessage($arguments[1],$arguments[2]);
                    $this->extendedMessage=$pluginClass::getExtendedMessage($arguments[1],$arguments[2]);
                }
                else
                {
                    $message=\PHPHump\Exception\Attribute::getMessage($arguments[1],$arguments[2]);
                    $this->extendedMessage=  \PHPHump\Exception\Attribute::getExtendedMessage($arguments[1],$arguments[2]);
                }
                break;
            case \PHPHump\Constants\Exception::VALIDATOR:
                if(class_exists(\PHPHump\Constants\Plugin::VALIDATOR))
                {
                    $pluginClass=\PHPHump\Constants\Plugin::VALIDATOR;
                    $message=$pluginClass::getMessage($arguments[1],$arguments[2]);
                    $this->extendedMessage=$pluginClass::getExtendedMessage($arguments[1],$arguments[2]);
                }
                else
                {
                    $message=  \PHPHump\Exception\Validator::getMessage($arguments[2]);
                    $this->extendedMessage=\PHPHump\Exception\Validator::getExtendedMessage($arguments[2]);
                }
                break;
        }
        parent::__construct($message);
    }
    public function getExtendedMessage()
    {
        return $this->extendedMessage;
    }
}
