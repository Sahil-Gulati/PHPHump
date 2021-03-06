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
    public static $ignoringTags=array(
            "starts_with"=>array(
                "<!DOCTYPE",
                "<hr",
                "<br",
                "<input",
                "<img",
                "<source",
                "<area",
                "<base",
                "<frame",
                "<link",
                "<meta"),
            "ends_with"=>array());
    public static $globalRequire=array();
    public static $errorStatus=true;
    public static $erroredVariableReplacement=array('{','}');
    public static $deadLockPeriod=2;
    public static $attributePrefix="hump";
    
    public function __construct($configJson)
    {
        $this->configJson=$configJson;
    }
    public function configure()
    {
        $this->setGlobalRequirements();
        $this->setErrorsStatus();
        $this->setIgnoringTags();
        $this->setErroredVariableReplacement();
        $this->setDeadLockPeriod();
        $this->setAttributePrefix();
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
        self::$ignoringTags["starts_with"]=  array_merge(self::$ignoringTags["starts_with"],$ignoringTags["starts_with"]);
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
                    self::$errorStatus= $jsonObject->debug_errors;
                }
            }
            else
            {
                self::$errorStatus= true;
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
                    self::$erroredVariableReplacement[0]=$jsonObject->error_variable->prefix;
                }
                if(property_exists($jsonObject->error_variable, "postfix") && !preg_match('/^\s*\]\s*\#/',$jsonObject->error_variable->postfix))
                {
                    self::$erroredVariableReplacement[1]=$jsonObject->error_variable->postfix;
                }
            }
        }
    }
    private function setDeadLockPeriod()
    {
        if(!empty($this->configJson))
        {
            $jsonObject=json_decode($this->configJson);
            if(property_exists($jsonObject, "deadlock_period"))
            {
                if(is_numeric($jsonObject->deadlock_period))
                {
                    self::$deadLockPeriod=$jsonObject->deadlock_period;
                }
            }
        }
    }
    private function setAttributePrefix()
    {
        if(!empty($this->configJson))
        {
            $jsonObject=json_decode($this->configJson);
            if(property_exists($jsonObject, "attribute_prefix"))
            {
                if(is_string($jsonObject->attribute_prefix))
                {
                    self::$attributePrefix=$jsonObject->attribute_prefix;
                }
            }
        }
    }
}