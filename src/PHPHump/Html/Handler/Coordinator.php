<?php
namespace PHPHump\Html\Handler;
/**
 * @author Sahil Gulati <sahil.gulati1991@outlook.com>
 */

class Coordinator extends \PHPHump\Modules\Attributes\HumpIf
{
    protected static $htmlString="";
    /**
     *
     * @var This variable will carry whole html string which will be displayed to browser 
     */
    protected $htmlHumpString="";
    /**
     *
     * @var \PHPHump\Hump 
     */
    public static $humpObject=null;
    protected function __construct($htmlString,\PHPHump\Hump $humpObject)
    {
        self::$htmlString=$htmlString;
        self::$humpObject=$humpObject;
    }
    protected function __prepare($tagsArray)
    {
        $attributePrefix= \PHPHump\Reader\Config::$attributePrefix;
        while(count($tagsArray)>0)
        {
            if(!empty(parent::getAttribute(parent::getElement($tagsArray),"$attributePrefix-attribute")))
            {
                $tagsArray=$this->attributize($tagsArray);
            }
            elseif(!empty(parent::getAttribute(parent::getElement($tagsArray),"$attributePrefix-if")) && !empty(parent::getAttribute(parent::getElement($tagsArray),"$attributePrefix-loop")))
            {
                $tagsArray=$this->conditionalLoop($tagsArray);
            }
            elseif(!empty(parent::getAttribute(parent::getElement($tagsArray),"$attributePrefix-if")))
            {
                $tagsArray=$this->conditional($tagsArray);
            }
            elseif(!empty(parent::getAttribute(parent::getElement($tagsArray), "$attributePrefix-loop")))
            {
                $tagsArray=$this->loopify($tagsArray);
            }
            elseif(!empty (parent::getAttribute(parent::getElement($tagsArray),"$attributePrefix-while")))
            {
                $tagsArray=$this->whileLoop($tagsArray);
            }
            elseif(parent::getTagName(parent::getElement($tagsArray))=='humpSwitch')
            {
                $tagsArray=$this->switcher($tagsArray);
            }
            elseif(parent::getTagName(parent::getElement($tagsArray))=='humpTemplate')
            {
                $tagsArray=$this->templatize($tagsArray);
            }
            elseif(parent::getTagName(parent::getElement($tagsArray))=='humpAssign')
            {
                $tagsArray=$this->assign($tagsArray);
            }
            elseif(parent::getTagName(parent::getElement($tagsArray))=='humpRequire')
            {
                $tagsArray=$this->requireOnce($tagsArray);
            }
            else
            {
                $this->htmlHumpString.=parent::modify(parent::getElement($tagsArray));
            }
            $tagsArray=parent::unsetFirstElement($tagsArray);
        }
        return $this->htmlHumpString;
    }
}