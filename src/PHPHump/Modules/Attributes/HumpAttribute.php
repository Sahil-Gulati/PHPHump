<?php
namespace PHPHump\Modules\Attributes;
/**
 * @author Sahil Gulati <sahil.gulati1991@outlook.com>
 * @desc
 */
class HumpAttribute extends \PHPHump\Modules\Tags\HumpSwitch
{
    protected function attributize($tagsArray)
    {
        $attributePrefix= \PHPHump\Reader\Config::$attributePrefix;
        $tag=  parent::modify(parent::getElement($tagsArray));
        $tagsArray =  parent::unsetFirstElement($tagsArray);
        $attributeValue= parent::getAttribute($tag,"$attributePrefix-attribute");
        list($exists,$value)=parent::retrieveValue($attributeValue);
        if($exists===true)
        {
            $tag=  parent::trimAttribute(parent::addAttributes($tag, $value), "$attributePrefix-attribute");
            $tagsArray=array_merge(
                    array(
                        "<empty>",
                        $tag
                    ),
                    $tagsArray);
        }
        else
        {
            \PHPHump\Exception\Exception::isThrowable(\PHPHump\Constants\Exception::VARIABLE,$attributeValue,false);
        }
        return $tagsArray;
    }
}