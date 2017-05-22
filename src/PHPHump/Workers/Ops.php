<?php
namespace PHPHump\Workers;

/**
 * @author Sahil Gulati <sahil.gulati1991@outlook.com>
 * @desc
 */
class Ops
{   
    public static function fileExists($filepath)
    {
        if(file_exists($filepath))
        {
            return true;
        }
        return false;
    }
    
    public static function getFileContent($filepath)
    {
        return file_get_contents($filepath);
    }
    /**
     * This Function will check whether a given JSON String
     * is valid or invalid/malformed.
     * @param String Json String 
     * @return Boolean
     */
    public static function isValidJson($jsonString)
    {
        if(!empty($jsonString) && is_string($jsonString))
        {
            json_decode($jsonString);
            if(json_last_error())
            {
                return false;
            }
        }
        return true;
    }
    public static function validateHtml($templateHtml)
    {
        (new \PHPHump\Html\Validator\Manager($templateHtml))->validate();
    }
}