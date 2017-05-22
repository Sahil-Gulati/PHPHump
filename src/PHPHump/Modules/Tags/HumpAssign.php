<?php
namespace PHPHump\Modules\Tags;
/**
 * @author Sahil Gulati <sahil.gulati1991@outlook.com>
 * @desc
 */
class HumpAssign extends HumpRequire
{
    protected function assign(array $tagsArray=array())
    {
        $firstElement=  parent::getElement($tagsArray);
        $tagsArray=  parent::unsetFirstElement($tagsArray);
        $key=  parent::getAttribute(parent::modify($firstElement), "key");
        if(empty($key))
        {
            throw new \PHPHump\Exception\Attribute(4);
        }
        $value=  parent::getAttribute($firstElement, "value");
        self::setValue($key, $value);
        $tagsArray=  parent::unsetInnerHtml($tagsArray);
        return $tagsArray;
    }
    
}