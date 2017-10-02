<?php
namespace PHPHump\Modules\Tags;
/**
 * @author Sahil Gulati <sahil.gulati1991@outlook.com>
 * @desc
 */
class HumpTemplate extends HumpAssign
{
    public function templatize($tagsArray)
    {
        $filePath=  parent::modify(parent::getAttribute(parent::getElement($tagsArray),"file"));
        $templateName=parent::modify(parent::getAttribute(parent::getElement($tagsArray),"name"));
        $toAnalyze=parent::modify(parent::getAttribute(parent::getElement($tagsArray),"analyze"));
        if(!empty($templateName))
        {
            $tagsArray=  parent::unsetFirstElement($tagsArray);
            $moduleTagsArray=$this->getTemplate($filePath,$templateName);
            if($toAnalyze==='Y')
            {
                $this->__prepare($moduleTagsArray);
            }
            else
            {
                $this->htmlHumpString=$this->htmlHumpString.implode("", $moduleTagsArray);
            }
            $tagsArray=  parent::unsetInnerHtml($tagsArray);
            return $tagsArray;
        }
        else
        {
            throw new \PHPHump\Exception\Exception(\PHPHump\Constants\Exception::ATTRIBUTE,7,"");
        }
    }
    public function getTemplate($filePath,$templateName)
    {
        if(\PHPHump\Workers\Ops::fileExists($filePath))
        {
            $fileContent=\PHPHump\Workers\Ops::getFileContent($filePath);
            \PHPHump\Workers\Ops::validateHtml($fileContent);
            $tagsArray= \PHPHump\Html\Handler\Ops::extractTags($fileContent);
            $modules=parent::extractModules($tagsArray);
            foreach ($modules as $key => $module)
            {
                $moduleTagsArray=parent::extractTags($module);
                foreach($moduleTagsArray as $tag)
                {
                    $name=parent::getAttribute($tag, "hump-template-name");
                    if($name==$templateName)
                    {
                        $moduleTagsArray=  parent::unsetFirstElement($moduleTagsArray);
                        $moduleTagsArray = parent::unsetLastElement($moduleTagsArray);
                        return $moduleTagsArray;
                    }
                    break;
                }
            }
            throw new \PHPHump\Exception\Exception(\PHPHump\Constants\Exception::ATTRIBUTE,7,$templateName);
        }
        else
        {
            throw new \PHPHump\Exception\Exception(\PHPHump\Constants\Exception::FILE,404,$filePath);
        }
    }
}
