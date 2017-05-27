<?php
namespace PHPHump\Modules\Attributes;
/**
 * @author Sahil Gulati <sahil.gulati1991@outlook.com>
 * @desc
 */
class HumpIf extends HumpLoop
{
    public function conditional(array $tagsArray=array())
    {
        $tag=  parent::modify(parent::getElement($tagsArray));
        $tagsArray=array_merge(array($tag),parent::unsetFirstElement($tagsArray));
        $attribute=parent::getAttribute(parent::getElement($tagsArray),"hump-if");
        $attributeData=$this->parseIfAttribute($attribute);
        if($this->executeIfBlock($attributeData))
        {
            $trimmedTag= parent::trimAttribute(parent::getElement($tagsArray),"hump-if");
            $tagsArray=  array_merge(array($trimmedTag),parent::unsetFirstElement($tagsArray));
            $tagsArray=  array_merge(array("<empty>"),$tagsArray);   
        }
        else
        {
            $tagsArray= parent::unsetFirstElement($tagsArray);
            if(parent::isIgnoringTag(\PHPHump\Reader\Config::$ignoringTags["starts_with"], $tag)===false)
            {
                $tagsArray=parent::unsetInnerHtml($tagsArray);
            }
            else
            {
                $tagsArray=  array_merge(array("<empty>"),$tagsArray); 
            }
        }
        return $tagsArray;
    }
    
    private function parseIfAttribute($attribute)
    {
        $result=array();
        $attribute=$this->modify($attribute);
        if(preg_match('#^\s*([a-zA-Z0-9\_\.]+)\s*$#',$attribute,$matches))
        {
            $result["variable_name"]=$matches[1];
        }
        elseif(preg_match('#^\s*not\(\s*([a-zA-Z0-9\_\.]+)\s*\)\s*$#',$attribute,$matches))
        {
            $result["variable_name"]=$matches[1];
            $result["is_not"]=true;
        }
        elseif(preg_match('#^\s*not\((\s*([a-zA-Z0-9]+)\s*(\-\>[a-zA-Z0-9]+)+)\s*\)\s*#',$attribute,$matches))
        {
            $result["variable_name"]=$matches[1];
            $result["is_not"]=true;
            $result["is_nested"]=true;
        }
        elseif(preg_match('#^\s*([a-zA-Z0-9]+)\s*(\-\>[a-zA-Z0-9]+)+\s*#',$attribute,$matches))
        {
            $result["variable_name"]=$matches[0];
            $result["is_nested"]=true;
        }
        else
        {
            throw new \Exception("Some message for invalid variable name");
        }
        return $result;
    }
    
    protected function executeIfBlock($attributeData)
    {
        if(!isset($attributeData["is_nested"]))
        {
            if(!empty($attributeData["variable_name"]) && !isset($attributeData["is_not"]))
            {
                list($exists,$variableValue)=parent::retrieveValue($attributeData["variable_name"]);
                if($exists===true)
                {
                    return true;
                }
                return false;
            }
            elseif(!empty($attributeData["variable_name"]) && isset($attributeData["is_not"]))
            {
                list($exists,$variableValue)=parent::retrieveValue($attributeData["variable_name"]);
                if($exists===false)
                {
                    return true;
                }
                return false;
            }
            
        }
        elseif(isset($attributeData["is_nested"]))
        {
            if(!empty($attributeData["variable_name"]) && !isset($attributeData["is_not"]))
            {
                list($exists,$variableValue)=parent::retrieveNestedValue($attributeData["variable_name"]);
                if($exists===true)
                {
                    return true;
                }
                return false;
            }
            if(!empty($attributeData["variable_name"]) && isset($attributeData["is_not"]))
            {
                list($exists,$variableValue)=parent::retrieveNestedValue($attributeData["variable_name"]);
                if($exists===false)
                {
                    return true;
                }
                return false;
            }
        }
    }
    
    public function conditionalLoop(array $tagsArray=array())
    {
        $attribute=parent::getAttribute(parent::getElement($tagsArray),"hump-if");
        $attributeData=$this->parseIfAttribute($attribute);
        if($this->executeIfBlock($attributeData))
        {
            $firstElement= parent::trimAttribute(parent::getElement($tagsArray),"hump-if");
            $tagsArray= parent::unsetFirstElement($tagsArray);
            $tagsArray=array_merge(array("<empty>",$firstElement),$tagsArray);
            return $tagsArray;
        }
        else
        {
            $tagsArray= parent::unsetFirstElement($tagsArray);
            $tagsArray= parent::unsetInnerHtml($tagsArray);
            return $tagsArray;
        }
    }
}