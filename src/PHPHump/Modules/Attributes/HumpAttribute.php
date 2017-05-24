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
        $tag=  parent::modify(parent::getElement($tagsArray));
        $tagsArray =  parent::unsetFirstElement($tagsArray);
        $attributeValue= parent::getAttribute($tag,"hump-attribute");
        list($exists,$value)=parent::retrieveValue($attributeValue);
        if($exists===true)
        {
            $tag=  parent::trimAttribute(parent::addAttributes($tag, $value), "hump-attribute");
            $tagsArray=array_merge(
                    array(
                        "<empty>",
                        $tag
                    ),
                    $tagsArray);
        }
        else
        {
            \PHPHump\Exception\Variable::isThrowable($attributeValue, false);
        }
        return $tagsArray;
    }
}