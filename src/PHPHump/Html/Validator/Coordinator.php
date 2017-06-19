<?php

namespace PHPHump\Html\Validator;
/**
 * @author Sahil Gulati <sahil.gulati1991@outlook.com>
 * @desc
 */
 class Coordinator extends Ops
{
    /**
     *
     * @var String This will content HTML content of the file. 
     */
    protected $htmlString="";
    /**
     *
     * @var String This config Json holds JSON configuration of PHP and its optional 
     */
    protected $configJson="";
    /**
     *
     * @var \PHPHump\Reader\Config This variable will hold config reader object
     */
    protected $configReaderObj=null;

    protected function __construct($htmlString)
    {
        $this->htmlString=$htmlString;
        parent::$ignoringTags= \PHPHump\Reader\Config::$ignoringTags;
    }

    protected function validateTags()
    {
        if(empty($this->configJson))
        {
            $tagsArray=parent::extractTags($this->htmlString);
            foreach ($tagsArray as $tagIndex => $tag)
            {
                if(!parent::isOpeningTag($tag) && !parent::isClosingTag($tag))
                {
                    if(parent::isIgnoringTag(\PHPHump\Reader\Config::$ignoringTags["starts_with"], $tag))
                    {
                        continue;
                    }
                    $lineNo=parent::getLineNo($this->htmlString, $tagIndex);
                    throw new \PHPHump\Exception\Exception(
                        \PHPHump\Constants\Exception::VALIDATOR,
                        500,
                        parent::getTemplateValidatorException(
                            1,
                            null, 
                             str_replace("<", "&lt;", $tag),
                            $tagIndex, 
                            $lineNo));
                }
            }
        }
    }
    
    protected function validateHtml()
    {
        $tempTagsArray=array();
        $tagsArray=parent::extractTags($this->htmlString);
        $previousTime=time();
        $index=1;
        while(count($tagsArray)!=0)
        {
            \PHPHump\Html\Handler\Ops::isDeadLocking($previousTime, time(), "validating html");
            $tagName=Ops::getTagName($tagsArray[$index]);
            if(parent::isInIgnoringTags($tagsArray[$index]))
            {
                unset($tagsArray[$index]);
                $index++;
                continue;
            }
            else if(Ops::isOpeningTag($tagsArray[$index]))
            {
                $tempTagsArray[]=$tagName;
            }
            else if(Ops::isClosingTag($tagsArray[$index]))
            { 
                if(Ops::getLastElement($tempTagsArray)==$tagName)
                {
                    $tempTagsArray=Ops::unsetLastElement($tempTagsArray);
                }
                else
                {
                    throw new \PHPHump\Exception\Exception(
                        \PHPHump\Constants\Exception::VALIDATOR,
                        500,
                        parent::getTemplateValidatorException(
                            2,
                            Ops::getHtmlTagRepresentation("</".Ops::getLastElement($tempTagsArray).">"),
                            Ops::getHtmlTagRepresentation($tagsArray[$index]),
                            $index,
                            Ops::getLineNo($this->htmlString, $index)));
                }
            }
            unset($tagsArray[$index]);
            $index++;
        }
        if(is_array($tempTagsArray) && count($tempTagsArray)>0)
        {
            throw new \PHPHump\Exception\Exception(
                        \PHPHump\Constants\Exception::VALIDATOR,
                        500,
                        parent::getTemplateValidatorException(
                            2,
                            Ops::getHtmlTagRepresentation("</".Ops::getLastElement($tempTagsArray).">"),
                            Ops::getHtmlTagRepresentation(""),
                            $index,
                            Ops::getLineNo($this->htmlString, $index)));
        }
    }
    
}