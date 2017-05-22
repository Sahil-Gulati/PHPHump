<?php
namespace PHPHump;
/**
 * @author Sahil Gulati <sahil.gulati1991@outlook.com>
 */
Hump_Loader::registerLoader();
final class Hump extends Workers\Manager
{
    /**
     * This class's constructor will accept either 1 & 2 or 3 parameter in which 3 parameter will given preference if provided all.
     * @param String $templateFilePath Path to template file
     * @param String $configFilePath Path to config file
     * @param String $htmlSourceString Source HTML string
     */
    public function __construct($templateFilePath,$configFilePath='',$htmlSourceString="")
    {
        parent::__construct($templateFilePath, $configFilePath,$htmlSourceString);
    }
}
class Hump_Loader
{
    public static function Loader($className)
    {
        if(!empty($className))
        {
            $className=  ltrim($className, __NAMESPACE__);
            $className=str_replace('\\', '/', $className);
            $className.=".php";
            $classPath=dirname(__FILE__);
            $classCompletePath=$classPath.$className;
            if(file_exists($classCompletePath))
            {
                require_once $classCompletePath;
            }
        }
    }
    public static function registerLoader()
    {
        ini_set("display_errors", 1);
        spl_autoload_register(array("\PHPHump\Hump_Loader","Loader"));
    }
}