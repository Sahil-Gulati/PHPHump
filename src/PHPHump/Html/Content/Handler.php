<?php
namespace PHPHump\Html\Content;
/**
 * @author Sahil Gulati <sahil.gulati1991@outlook.com>
 * @desc
 */

class Handler
{
    public function modify($tag)
    {
        while(preg_match('/#\[([\w]+)\]#/', $tag,$variables))
        {
            list($exists,$variableValue)=self::retrieveValue($variables[1]);
            if($exists===true)
            {
                $variableValue=  is_array($variableValue) || is_object($variableValue) ? json_encode($variableValue) : $variableValue;
                $tag=str_replace($variables[0], $variableValue, $tag);
            }
            else
            {
                $tag=$this->isThrowable($tag,$variables,false);
            }
        }
        while(preg_match("/#\[((?:[\w]+)\s*(?:\-\>\s*[\w]+)*)\]#/", $tag,$variables))
        {
            list($exists,$variableValue)=self::retrieveNestedValue($variables[1]);
            if($exists===true)
            {
                $tag=str_replace($variables[0], $variableValue, $tag);
            }
            else
            {
                $tag=$this->isThrowable($tag,$variables,true);
            }
        }
        return $tag;
    }
    
    public static function setValue($key,$value)
    {
        \PHPHump\Html\Handler\Coordinator::$humpObject->{$key}=$value;
    }
    
    public static function retrieveValue($variableName)
    {
        $result=array();
        if(property_exists(\PHPHump\Html\Handler\Coordinator::$humpObject, $variableName)==true)
        {
            $result[0]=true;
            $result[1]=\PHPHump\Html\Handler\Coordinator::$humpObject->{$variableName};
            return $result;
        }
        $result[0]=false;
        $result[1]=false;
        return $result;
    }
    
    public static function retrieveNestedValue($nestedVariableString)
    {
        $data=array();
        $indexes=explode("->", $nestedVariableString);
        $variableName=trim($indexes[0]);
        unset($indexes[0]);
        if(property_exists(\PHPHump\Html\Handler\Coordinator::$humpObject, $variableName)==true)
        {
            $result=\PHPHump\Html\Handler\Coordinator::$humpObject->{$variableName};
            foreach ($indexes as $index)
            {
                if(!empty($result[$index]))
                {
                    $result=$result[$index];
                }
                else
                {
                    $data[0]=false;
                    $data[1]=false;
                    return $data;
                }
            }
            $data[0]=true;
            if(!is_string($result))
            {
                $result=json_encode($result);
            }
            $data[1]=$result;
            return $data;
        }
        $data[0]=false;
        $data[1]=false;
        return $data;
    }
    public function isThrowable($tag,$variables,$isNested=false)
    {
        if(\PHPHump\Reader\Config::$errorStatus===true)
        {
            throw new \PHPHump\Exception\Variable($variables[1],$isNested);
        }
        else
        {
           list($prefix,$postfix)=\PHPHump\Reader\Config::$erroredVariabledReplacement;
           $tag=str_replace($variables[0], $prefix.$variables[1].$postfix, $tag);
        }
        return $tag;
    }
}