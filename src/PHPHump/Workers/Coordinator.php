<?php
namespace PHPHump\Workers;
/**
 * This class works as a coordinator which distributes the
 * work among different worker Ops.
 * @author Sahil Gulati <sahil.gulati1991@outlook.com>
 */
class Coordinator extends Ops
{
    /**
     * @var String Content of the template file path.
     */
    protected $templateFilePath="";
    /**
     * @var String Content of the config file path. 
     */
    protected $configFilePath="";
    /**
     * @var String This variable will contain JSON string obtained from file
     */
    protected $configJson='';
    /**
     * @var String This variable will contain HTML string obtained from file
     */
    protected $templateHtml='';
    /**
     * @var Boolean Flag for existence PHPHump Template file
     */
    protected static $existsTemplateFile=false;
    /**
     * @var Boolean Flag for existence PHPHump Config file
     */
    protected static $existsConfigFile=false;
    
    
    public function __initiate($templateFilePath,$configFilePath,$htmlSourceString="")
    {
        $this->configFilePath=$configFilePath;
        $this->templateFilePath=$templateFilePath;
        $this->templateHtml=$htmlSourceString;
    }
    
    /**
     * This function will look whether a file exists or not
     * @param String Path of the file
     * @param Int Type of file
     * @throws \PHPHump\Exception\File
     */
    protected function lookForFile($filePath,$fileType)
    {
        $exists=  parent::fileExists($filePath);
        switch ($fileType)
        {
            case \PHPHump\Constants\File::TEMPLATE_FILE_TYPE:
                if($exists==false)
                {
                    throw new \PHPHump\Exception\Exception(\PHPHump\Constants\Exception::FILE,404,$filePath);
                }
                self::$existsTemplateFile=true;
                break;
                
            case \PHPHump\Constants\File::CONFIG_FILE_TYPE:
                self::$existsConfigFile= ($exists==true) ? true : false;
                if(self::$existsConfigFile===true)
                {
                    $this->configFilePath=$filePath;
                }
                break;
            
            default:
                break;
        }
    }
    /**
     * 
     * @param String Path of the file
     * @param Int Integer specifing the type of file
     */
    protected function getContent($filePath,$fileType)
    {
        switch ($fileType)
        {
            case \PHPHump\Constants\File::TEMPLATE_FILE_TYPE;
                $this->templateHtml=Ops::getFileContent($filePath);
                break;
            case \PHPHump\Constants\File::CONFIG_FILE_TYPE;
                if(self::$existsConfigFile===true)
                {
                    $this->configJson=Ops::getFileContent($filePath);
                }
                break;
        }
    }
    
    protected function validateContent($fileType)
    {
        switch ($fileType)
        {
            case \PHPHump\Constants\File::TEMPLATE_FILE_TYPE:
                $this->templateHtml= \PHPHump\Html\Handler\Ops::stripComments($this->templateHtml);
                if(Ops::validateHtml($this->templateHtml))
                {
                    
                }
                break;
            case \PHPHump\Constants\File::CONFIG_FILE_TYPE:
                if(self::$existsConfigFile===true && !empty($this->configJson))
                {
                    if(Ops::isValidJson($this->configJson)==false)
                    {
                        throw new \PHPHump\Exception\Exception(\PHPHump\Constants\Exception::FILE,500,\PHPHump\Constants\File::CONFIG_FILE_TYPE);
                    }
                }
                $this->__execute(\PHPHump\Constants\File::CONFIG_FILE_TYPE);
                break;
        }
    }
    
    protected function __execute($fileType)
    {
        switch ($fileType)
        {
            case \PHPHump\Constants\File::TEMPLATE_FILE_TYPE:
                $string= (new \PHPHump\Html\Handler\Manager($this->templateHtml,$this))->prepare();
                Ops::validateHtml($string);
                return $string;
                break;
            case \PHPHump\Constants\File::CONFIG_FILE_TYPE:
                (new \PHPHump\Reader\Config($this->configJson))->configure();
                break;
        }
    }
    public function __require($filePath,$force=false)
    {
        if(parent::fileExists($filePath))
        {
            if($force===true)
            {
                include_once $filePath;
                return true;
            }
            require_once $filePath;
        }
    }
    public function __destruct()
    {
        self::$existsConfigFile=false;
        self::$existsTemplateFile=false;
    }
}