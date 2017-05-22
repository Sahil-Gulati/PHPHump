<?php
namespace PHPHump\Modules\Attributes;
/**
 * @author Sahil Gulati <sahil.gulati1991@outlook.com>
 * @desc
 */
class HumpLoop extends HumpWhile
{
    
    public function loopify($tagsArray)
    {
        $loopAttributes=$this->validateLoopAttribute(parent::getAttribute(parent::getElement($tagsArray), "hump-loop"));
        $topTag=parent::trimAttribute(parent::getElement(parent::getInnerHtml($tagsArray)),"hump-loop");
        $tagsArray=  parent::unsetFirstElement($tagsArray);
        $innerHtmlArray=parent::getInnerHtml($tagsArray);
        $remainingHtmlArray=  parent::unsetInnerHtml($tagsArray);
        $endingTag= parent::getElement($remainingHtmlArray);
        list($exists,$dataArray)=self::retrieveValue($loopAttributes[0]);
        if(count($loopAttributes)==2)
        {
            if($exists===true)
            {
                $this->checkForArray($dataArray);
                foreach ($dataArray as $key => $$loopAttributes[1])
                {
                    self::setValue($loopAttributes[1], $$loopAttributes[1]);
                    self::setValue($loopAttributes[1]."_key", $key);
                    $this->htmlHumpString.=parent::modify($topTag);
                    $this->__prepare($innerHtmlArray);
                    $this->htmlHumpString.=$endingTag;
                }
            }
            else
            {
                \PHPHump\Exception\Variable::isThrowable($loopAttributes[0],false);
            }
        }
        elseif(count($loopAttributes)==3)
        {
            if($exists===true)
            {
                $this->checkForArray($dataArray);
                foreach ($dataArray as $$loopAttributes[1] => $$loopAttributes[2])
                {
                    self::setValue($loopAttributes[1], $$loopAttributes[1]);
                    self::setValue($loopAttributes[2], $$loopAttributes[2]);
                    $this->htmlHumpString.=parent::modify($topTag);
                    $this->__prepare($innerHtmlArray);
                    $this->htmlHumpString.=$endingTag;
                }
            }
            else
            {
                \PHPHump\Exception\Variable::isThrowable($loopAttributes[0],false);
            }
        }
        return $remainingHtmlArray;
    }
    
    public function checkForArray($dataArray)
    {
        if(!is_array($dataArray))
        {
            \PHPHump\Exception\Variable::isThrowable($dataArray,false);//to furnish
        }
    }
    public function validateLoopAttribute($attribute)
    {
        $loopAttributes=array();
        if(preg_match("#^\s*([\w]+)[\s]+as[\s]+([\w]+)[\s]*$#", $attribute,$matches))
        {
            if(!empty($matches[1]) && !empty($matches[2]))
            {
                $loopAttributes[]=$matches[1];
                $loopAttributes[]=$matches[2];
            }
        }
        elseif(preg_match("#^\s*([\w]+)[\s]+as[\s]+([\w]+)[\s]+\-\>[\s]+([\w]+)[\s]*$#", $attribute,$matches))
        {
            if(!empty($matches[1]) && !empty($matches[2]))
            {
                $loopAttributes[]=$matches[1];
                $loopAttributes[]=$matches[2];
                $loopAttributes[]=$matches[3];
            }
        }
        else
        {
            throw new \PHPHump\Exception\Attribute(1,$attribute);
        }
        return $loopAttributes;
    }
}