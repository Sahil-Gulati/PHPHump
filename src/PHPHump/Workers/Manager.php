<?php
namespace PHPHump\Workers;
/**
 * This class's job is to distribute job among workers
 * @author Sahil Gulati <sahil.gulati1991@outlook.com>
 * @desc
 */
class Manager extends Coordinator
{
    public function __construct($templateFilePath,$configFilePath="",$htmlSourceString="")
    {
        if(!empty($htmlSourceString))
        {
            $this->__initiate("", "",$htmlSourceString);
            $this->validate();
        }
        else
        {
            $this->__initiate($templateFilePath, $configFilePath);
            $this->lookupFiles();
            $this->getFilesContent();
            $this->validate();
        }
    }
    
    private function lookupFiles()
    {
        $this->lookForFile(\PHPHump\Constants\File::CONFIG_FILE_PATH, \PHPHump\Constants\File::CONFIG_FILE_TYPE);
        $this->lookForFile($this->configFilePath, \PHPHump\Constants\File::CONFIG_FILE_TYPE);
        $this->lookForFile($this->templateFilePath, \PHPHump\Constants\File::TEMPLATE_FILE_TYPE);
    }
    
    private function getFilesContent()
    {
        $this->getContent($this->configFilePath,\PHPHump\Constants\File::CONFIG_FILE_TYPE);
        $this->getContent($this->templateFilePath, \PHPHump\Constants\File::TEMPLATE_FILE_TYPE);
    }
    
    private function validate()
    {
        $this->validateContent(\PHPHump\Constants\File::CONFIG_FILE_TYPE);
        $this->validateContent(\PHPHump\Constants\File::TEMPLATE_FILE_TYPE);
    }
    public function execute()
    {
        return $this->__execute(\PHPHump\Constants\File::TEMPLATE_FILE_TYPE);
    }
    
}
