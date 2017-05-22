<?php
namespace PHPHump\Reader;
/**
 * @author Sahil Gulati <sahil.gulati1991@outlook.com>
 * @desc
 */
class Config
{
    /**
     * @var String This varible will hold config json file content
     * and Valid content 
     */
    private $configJson="";
    public static $ignoringTags=array();
    public static $globalRequire=array();
    public static $errorStatus=true;
    public static $erroredVariabledReplacement=array('{','}');
    public function __construct($configJson)
    {
        $this->configJson=$configJson;
    }
    public function configure()
    {
        self::$globalRequire=$this->setGlobalRequirements();
        self::$errorStatus=$this->setErrorsStatus();
        self::$ignoringTags=$this->setIgnoringTags();
        $this->setErroredVariableReplacement();
    }
    
    private function setIgnoringTags($startsWith=true,$endsWith=false)
    {
        $ignoringTags=array();
        $ignoringTags["starts_with"]=array();
        $ignoringTags["ends_with"]=array();
        if(!empty($this->configJson))
        {
            $jsonObject=json_decode($this->configJson);
            if(property_exists($jsonObject, 'ignore'))
            {
                if(property_exists($jsonObject->ignore, 'tags'))
                {
                    if(property_exists($jsonObject->ignore->tags, 'starts_with'))
                    {
                        if($startsWith==true)
                        {
                            $ignoringTags["starts_with"]=$jsonObject->ignore->tags->starts_with;
                        }
                        if($endsWith==true)
                        {
                            $ignoringTags["ends_with"]=$jsonObject->ignore->tags->ends_with;
                        }
                    }
                }
            }
        }
        return $ignoringTags;
    }
    
    private function setGlobalRequirements()
    {
        if(!empty($this->configJson))
        {
            $jsonObject=json_decode($this->configJson);
            if(property_exists($jsonObject, "global_include"));
            {
                return $jsonObject->global_include;
            }
        }
    }
    private function setErrorsStatus()
    {
        if(!empty($this->configJson))
        {
            $jsonObject=json_decode($this->configJson);
            if(property_exists($jsonObject, "debug_errors"))
            {
                if(is_bool($jsonObject->debug_errors))
                {
                    return $jsonObject->debug_errors;
                }
            }
            else
            {
                return true;
            }
        }
    }
    private function setErroredVariableReplacement()
    {
        if(!empty($this->configJson))
        {
            $jsonObject=json_decode($this->configJson);
            if(property_exists($jsonObject, "error_variable"))
            {
                if(property_exists($jsonObject->error_variable, "prefix") && !preg_match('/\s*\#\s*\[$/',$jsonObject->error_variable->prefix))
                {
                    self::$erroredVariabledReplacement[0]=$jsonObject->error_variable->prefix;
                }
                if(property_exists($jsonObject->error_variable, "postfix") && !preg_match('/^\s*\]\s*\#/',$jsonObject->error_variable->postfix))
                {
                    self::$erroredVariabledReplacement[1]=$jsonObject->error_variable->postfix;
                }
            }
        }
    }
}