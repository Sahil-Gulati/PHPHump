<?php
namespace PHPHump\Modules\Tags;
/**
 * @author Sahil Gulati <sahil.gulati1991@outlook.com>
 * @desc
 */
class HumpRequire extends \PHPHump\Html\Handler\Ops
{
    protected function requireOnce($tagsArray)
    {
        $tag=  parent::getElement($tagsArray);
        $tagsArray= parent::unsetFirstElement($tagsArray);
        $tag= self::modify($tag);
        $filePath= parent::getAttribute($tag,"file");
        $force= parent::getAttribute($tag,"force");
        $this->validatePath($filePath);
        \PHPHump\Html\Handler\Coordinator::$humpObject->__require($filePath,$force);
        $tagsArray=  parent::unsetInnerHtml($tagsArray);
        return $tagsArray;
    }
    protected function validatePath($filePath)
    {
        if(empty($filePath))
        {
            throw new \PHPHump\Exception\Exception(\PHPHump\Constants\Exception::ATTRIBUTE,5,$filePath);
        }
        if(!file_exists($filePath))
        {
            throw new \PHPHump\Exception\Exception(\PHPHump\Constants\Exception::FILE,404,$filePath);
        }
    }
    public static function modify($tag)
    {
        return (new \PHPHump\Html\Content\Handler)->modify($tag);
    }
    public static function retrieveValue($variableName)
    {
        return \PHPHump\Html\Content\Handler::retrieveValue($variableName);
    }
    public static function retrieveNestedValue($variableName)
    {
        return \PHPHump\Html\Content\Handler::retrieveNestedValue($variableName);
    }
    public static function setValue($key,$value)
    {
        \PHPHump\Html\Handler\Coordinator::$humpObject->{$key}=$value;
    }
}