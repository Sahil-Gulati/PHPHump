<?php
namespace PHPHump\Modules\Tags;
/**
 * @author Sahil Gulati <sahil.gulati1991@outlook.com>
 */
class HumpSwitch extends HumpTemplate
{
    public function switcher(array $tagsArray=array())
    {
        $switchOverVariable=parent::getAttribute(parent::getElement($tagsArray),"switch-over");
        list($exists,$variableValue)= self::retrieveValue($switchOverVariable);
        $tagsArray=  parent::unsetFirstElement($tagsArray);
        if($exists===true)
        {
            $innerHtmlArray=  parent::getInnerHtml($tagsArray);
            $caseArray=$this->retrieveCase($innerHtmlArray,$variableValue);
            $this->__prepare($caseArray);
        }
        else
        {
            parent::modify("#[".$switchOverVariable."]#");
        }
        $tagsArray=parent::unsetInnerHtml($tagsArray);
        return $tagsArray;
    }
    public function retrieveCase(array $tagsArray=array(),$switchOverVariable)
    {
        foreach ($tagsArray as $key => $tag)
        {
            if(parent::getTagName($tag)=='humpCase' && parent::getAttribute($tag,"case")==$switchOverVariable)
            {
                $tagsArray=  parent::unsetFirstElement($tagsArray);
                $innerHtml=  parent::getInnerHtml($tagsArray);
                return $innerHtml;
            }
            elseif(parent::getTagName($tag)=='humpDefault')
            {
                $tagsArray=  parent::unsetFirstElement($tagsArray);
                $innerHtml=  parent::getInnerHtml($tagsArray);
                return $innerHtml;
            }
            $tagsArray= parent::unsetFirstElement($tagsArray);
        }
        return $tagsArray;
    }
}