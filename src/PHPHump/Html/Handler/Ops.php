<?php
namespace PHPHump\Html\Handler;
/**
 * @author Sahil Gulati <sahil.gulati1991@outlook.com>
 * @desc
 */
class Ops
{
    /**
     * Checks whether a tag string is valid or not
     * @param String $tag
     * @return boolean
     */
    public static function isValidTag($tag)
    {
        if(!empty($tag) && is_string($tag))
        {
            if(preg_match('#^\s*<\s*[\w]+#', $tag) || preg_match('#^\s*<\/\s*[\w]+\s*\>$#', $tag))
            {
                return true;
            }
        } 
        return false;
    }
    
    /**
     * Checks whether a tag string is of closing or not
     * @param String $tag
     * @return boolean
     */
    public static function isClosingTag($tag)
    {
        if(!empty($tag) && is_string($tag))
        {
            if(preg_match('#<\/[\w]+>#', $tag))
            {
                return true;
            }
        }
        return false;
    }
    /**
     * Checks whether a tag string is of opening or not
     * @param String $tag
     * @return boolean
     */
    public static function isOpeningTag($tag)
    {
        if(!empty($tag) && is_string($tag))
        {
            if(preg_match('#<[\w]+#', $tag))
            {
                return true;
            }
        } 
        return false;
    }
    
    public static function isIgnoringTag($ignoringTagsArray,$tag)
    {
        foreach($ignoringTagsArray as $ignoringTag)
        {
            if(stripos($tag, $ignoringTag)===0)
            {
                return true;
            }
        }
        return false;
    }


    public static function getTagName($tag)
    {
        if(Ops::isOpeningtag($tag))
        {
            preg_match('#^\s*<\s*([a-zA-Z\-0-9]+)#', $tag,$matches);
            return $matches[1];
        }
        else if(Ops::isClosingTag($tag))
        {
            preg_match('#\s*<\s*\/\s*([a-zA-Z\-0-9]+)#', $tag,$matches);
            return $matches[1];
        }
    }

    /**
     * This function will return all the tags in the array<br/> 
     * from the HTML template string received as a parameter.
     * @param String Whole Html template string
     * @return Array Array of tags
     */
    public static function extractTags($htmlString)
    {
        $tagsArray=array();
        if(!empty($htmlString) && is_string($htmlString))
        {
            $tagsArray=explode('<',$htmlString);
            unset($tagsArray[0]);
            foreach($tagsArray as $key => $tag)
            {
                $tagsArray[$key]="<".$tag;
            }
        }
        return $tagsArray;
    }
    
    private static function getFileLines($htmlString)
    {
        $linesArray=array();
        if(!empty($htmlString) && is_string($htmlString))
        {
            $linesArray=explode("\n", $htmlString);
        }
        return $linesArray;
    }
    
    public static function getLineNo($htmlString,$tagNo)
    {
        $lineNo=0;
        $linesArray=self::getFileLines($htmlString);
        while(count($linesArray)!=0)
        {
            $noOfOccurence=  substr_count($linesArray[$lineNo], "<");
            $tagNo=$tagNo-$noOfOccurence;
            if($tagNo<=0)
            {
                $lineNo++;
                break;
            }
            unset($linesArray[$lineNo]);
            $lineNo++;
        }
        return $lineNo;
    }
    public static function getHtmlTagRepresentation($tag)
    {
        $tag=str_replace("<", "&lt;", $tag);
        $tag=str_replace(">", "&gt;", $tag);
        return $tag;
    }
    public static function getLastElement(array $array=array())
    {
        return array_pop($array);
    }
    public static function getElement(array $array=array(),$elementNo=1)
    {
        $counter=1;
        foreach($array as $tag)
        {
            if($elementNo==$counter)
            {
                return $tag;
            }
            $counter++;
        }
    }
    public static function unsetLastElement(array $array=array())
    {
        array_pop($array);
        return $array;
    }
    public static function unsetFirstElement(array $array=array())
    {
        foreach($array as $key => $element)
        {
            unset($array[$key]);
            return $array;
        }
    }
    public static function getAttributes($tag)
    {
        preg_match_all("#[\w\-]+\s*\=\s*(?:\"|\')[^\"\']+(?:\"|\')#", $tag,$matches);
        return $matches[0];
    }
    public static function trimAttribute($tag,$attributeName)
    {
        $attributeValue=self::getAttribute($tag, $attributeName);
        $completeAttribute1=$attributeName."="."\"$attributeValue\"";
        $completeAttribute2=$attributeName."="."\'$attributeValue'";
        $tag=str_replace($completeAttribute1, "", $tag);
        $tag=str_replace($completeAttribute2, "", $tag);
        return $tag;
    }
    /**
     * This function will generate string of attributes from the given array
     * @param Array $attributes
     * @return String
     */
    private static function createAttributeString($attributes=array())
    {
        if(is_array($attributes) && count($attributes)>0)
        {
            $attributesString=array();
            foreach($attributes as $key=> $value)
            {
                if(is_string($key) && !empty($key) && is_string($value) && !empty($value))
                {
                    $attributesString[]=" $key=\"$value\" ";
                }
            }
            return implode("", $attributesString);
        }
    }
    /**
     * This function will add specified attributes to given tag
     * @param String $tag
     * @param Array $attributes
     * @return String
     */
    public static function addAttributes($tag,$attributes=array())
    {
        if(preg_match("/^\s*(<\s*[a-zA-Z]+)/", $tag,$matches))
        {
            $tag=ltrim($tag,$matches[0]);
            return $tag=$matches[1]. self::createAttributeString($attributes).$tag;
        }
    }
    /**
     * 
     * @param type $tag
     * @param type $attributeName
     * @todo To correct reqular expression
     */
    public static function getAttribute($tag,$attributeName)
    {
        if(!empty($tag) && !empty($attributeName))
        {
            $attributes=self::getAttributes($tag);
            foreach($attributes as $attribute)
            {
                if(preg_match("/".$attributeName."\s*=\s*/",$attribute,$matches))
                {
                    $attriuteValue=explode("=", $attribute);
                    preg_match("#(?:\"|\')([^\"\']+)(?:\"|\')#", $attriuteValue[1],$matches);
                    return $matches[1];
                }
            }
        }
    }
    public static function getInnerHtml($tagsArray)
    {
        $tempTagsArray=array();
        $innerHtmlArray=array();
        $innerHtmlArrayWithEmptyTags=array();
        $previousTime=time();
        while(count($tagsArray)!=0)
        {
            self::isDeadLocking($previousTime, time(), "getting inner html");
            $firstElement=self::getElement($tagsArray);
            if(self::isIgnoringTag(\PHPHump\Reader\Config::$ignoringTags['starts_with'], $firstElement))
            {
                $innerHtmlArrayWithEmptyTags[]=$firstElement;
                $tagsArray=self::unsetFirstElement($tagsArray);
            }
            elseif(self::isOpeningTag($firstElement))
            {
                $tempTagsArray[]=self::getTagName($firstElement);
                $innerHtmlArray[]=self::getElement($tagsArray);
                $innerHtmlArrayWithEmptyTags[]=$firstElement;
                $tagsArray=self::unsetFirstElement($tagsArray);
            }
            else if(self::isClosingTag($firstElement))
            {
                if(self::getLastElement($tempTagsArray)==self::getTagName($firstElement))
                {
                    $tempTagsArray=self::unsetLastElement($tempTagsArray);
                    $innerHtmlArray[]=self::getElement($tagsArray);
                    $innerHtmlArrayWithEmptyTags[]=$firstElement;
                    $tagsArray=self::unsetFirstElement($tagsArray);
                }
                /**
                 * Case 1. When there is time to abort
                 */
                if(count($tempTagsArray)==0 && self::isClosingTag(self::getElement($tagsArray)))
                {
                    break;
                }
            }
        }
        return $innerHtmlArrayWithEmptyTags;;
    }
    public static function unsetInnerHtml(array $tagsArray=array())
    {
        $tempTagsArray=array();
        $previousTime=time();
        while(count($tagsArray)!=0)
        {
            self::isDeadLocking($previousTime, time(), "unsetting inner html");
            if(self::isIgnoringTag(\PHPHump\Reader\Config::$ignoringTags["starts_with"], self::getElement($tagsArray)))
            {
                $tagsArray=self::unsetFirstElement($tagsArray);
            }
            else if(self::isOpeningTag(self::getElement($tagsArray)))
            {
                $tempTagsArray[]=  self::getTagName(self::getElement($tagsArray));
                $tagsArray=self::unsetFirstElement($tagsArray);
            }
            elseif(self::isClosingTag(self::getElement($tagsArray)))
            {
                if(self::getTagName(self::getElement($tagsArray))==self::getLastElement($tempTagsArray))
                {
                    $tempTagsArray=self::unsetLastElement($tempTagsArray);
                    $tagsArray=self::unsetFirstElement($tagsArray);
                }
                if(count($tempTagsArray)==0 && self::isClosingTag(self::getElement($tagsArray)))
                {
                    break;
                }
            }
        }
        return $tagsArray;
    }
    public function makeClosingTag($tag)
    {
        if(!empty($tag))
        {
            preg_match("#^\<[\s]*([\w]+)#", $tag,$matches);
            return "</".$matches[1].">";
        }
    }
    public function extractModules(array $tagsArray=array())
    {
        $tempTagsArray=array();
        $modulesArray=array();
        $moduleCounter=0;
        $previousTime=time();
        while(count($tagsArray)>0)
        {
            self::isDeadLocking($previousTime, time(), "extracting modules");
            if(self::isOpeningTag(self::getElement($tagsArray)))
            {
                $tempTagsArray[]= self::getTagName(self::getElement($tagsArray));
                $modulesArray[$moduleCounter]=  isset($modulesArray[$moduleCounter]) ? $modulesArray[$moduleCounter] : "";
                $modulesArray[$moduleCounter].=self::getElement($tagsArray);
                $tagsArray=self::unsetFirstElement($tagsArray);
            }
            else if(self::isClosingTag(self::getElement($tagsArray)))
            {
                if(self::getTagName(self::getElement($tagsArray))==self::getLastElement($tempTagsArray))
                {
                    $tempTagsArray=self::unsetLastElement($tempTagsArray);
                    $modulesArray[$moduleCounter]=  isset($modulesArray[$moduleCounter]) ? $modulesArray[$moduleCounter] : "";
                    $modulesArray[$moduleCounter].=self::getElement($tagsArray);
                    $tagsArray=self::unsetFirstElement($tagsArray);
                }
                if(count($tempTagsArray)==0)
                {
                    $moduleCounter++;
                }
            }
        }
        return $modulesArray;
    }
    public static function  stripComments($htmlSourceString="")
    {
        if(!empty($htmlSourceString))
        {
            $htmlTagsArray=  self::extractTags($htmlSourceString);
            $toUnset=false;
            foreach($htmlTagsArray as $key => $tag)
            {
                if(strpos($tag, "<!--")===0 && strpos($tag, "-->"))
                {
                    unset($htmlTagsArray[$key]);
                    continue;
                }
                elseif(strpos($tag, "<!--")===0)
                {
                    $toUnset=true;
                }
                elseif(strpos($tag, "-->") && $toUnset===true)
                {
                    $htmlTagsArray[$key]=  self::unsetTillCommentEnd($htmlTagsArray[$key]);
                    $toUnset=false;
                }
                if($toUnset===true)
                {
                    unset($htmlTagsArray[$key]);
                }
            }
            return implode("",$htmlTagsArray);
        }
    }
    private static function unsetTillCommentEnd($tag)
    {
        $tag=explode("-->",$tag);
        array_shift($tag);
        return implode("-->", $tag);
    }
    private static function isDeadLocking($oldTime, $newTime,$message)
    {
        if($newTime-$oldTime > \PHPHump\Reader\Config::$deadLockPeriod)
        {
            throw new Exception("Deadlocking period reached while $message!");
        }
    }
}   