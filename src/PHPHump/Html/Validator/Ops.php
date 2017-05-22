<?php
namespace PHPHump\Html\Validator;
/**
 * @author Sahil Gulati <sahil.gulati1991@outlook.com>
 * @desc
 */
class Ops extends \PHPHump\Html\Handler\Ops
{
    /**
     *
     * @var Array This array will contains 
     */
    protected static $ignoringTags=array();
   
    public static function isInIgnoringTags($tag)
    {
        if(isset(self::$ignoringTags["starts_with"]) && is_array(self::$ignoringTags["starts_with"]) && count(self::$ignoringTags["starts_with"])>0)
        {
            foreach(self::$ignoringTags["starts_with"] as $needle)
            {
                if(strpos($tag, $needle)===0)
                {
                    return true;
                }
            }
        }
    }
    
    public static function getTemplateValidatorException($errorType,$expectedTag,$erroredTag,$tagNo,$lineNo)
    {
        $stdClassObject = new \stdClass();
        $stdClassObject->errorType=$errorType;
        $stdClassObject->expectedTag=$expectedTag;
        $stdClassObject->erroredTag=$erroredTag;
        $stdClassObject->tagNo=$tagNo;
        $stdClassObject->lineNo=$lineNo;
        return $stdClassObject;
    } 
}