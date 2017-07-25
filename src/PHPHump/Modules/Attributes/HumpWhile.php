<?php
namespace PHPHump\Modules\Attributes;
/**
 * This class will handle hump while module.
 * @author Sahil Gulati <sahil.gulati1991@outlook.com>
 */
class HumpWhile extends HumpAttribute
{
    private $validCounterTypes=array(
        "decr",
        "incr");
    protected function whileLoop($tagsArray)
    {
        $attributePrefix= \PHPHump\Reader\Config::$attributePrefix;
        $loopVariable= parent::getAttribute(parent::getElement($tagsArray),"$attributePrefix-while");
        $counterType= parent::getAttribute(parent::getElement($tagsArray),"counter-type");
        list($exists,$variableValue)=  parent::retrieveValue($loopVariable);
        if($this->isValidWhileLoopAttributes($variableValue, $counterType))
        {
            if($exists===true)
            {
                $firstElement=parent::trimAttribute(parent::trimAttribute(parent::getElement($tagsArray),"$attributePrefix-while"),"counter-type");
                $tagsArray=  parent::unsetFirstElement($tagsArray);
                $whileInnerHtml = parent::getInnerHtml($tagsArray);
                $tagsArray = parent::unsetInnerHtml($tagsArray);
                while($variableValue)
                {
                    $this->htmlHumpString.=parent::modify($firstElement);
                    $this->__prepare($whileInnerHtml);
                    $this->htmlHumpString.=parent::makeClosingTag($firstElement);
                    if($counterType=='decr')
                    {
                        $variableValue--;
                    }
                    elseif($counterType=='incr')
                    {
                        $variableValue++;
                    }
                }
            }
            else
            {
                if(!\PHPHump\Exception\Exception::isThrowable(\PHPHump\Constants\Exception::VARIABLE,$loopVariable, false))
                {
                    $tagsArray=  parent::unsetFirstElement($tagsArray);
                    $tagsArray= parent::unsetInnerHtml($tagsArray);
                }
            }
        }
        return $tagsArray;
    }
    protected function isValidWhileLoopAttributes($loopVariable,$counterType)
    {
        if(!is_int($loopVariable))
        {
            throw new \PHPHump\Exception\Exception(\PHPHump\Constants\Exception::ATTRIBUTE,3,"");
        }
        if(!in_array($counterType, $this->validCounterTypes))
        {
            throw new \PHPHump\Exception\Exception(\PHPHump\Constants\Exception::ATTRIBUTE,2,$counterType);
        }
        return true;
    }
    
}