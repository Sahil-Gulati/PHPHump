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
        $filePath=parent::getAttribute(parent::getElement($tagsArray),"file");
        $templateName=parent::getAttribute(parent::getElement($tagsArray),"name");
        $toAnalyze=parent::getAttribute(parent::getElement($tagsArray),"analyze");
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
            throw new \Exception("Empty name in humpTemplate");
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
                        $firstTag=  parent::getElement($moduleTagsArray);
                        $moduleTagsArray=  parent::unsetFirstElement($moduleTagsArray);
                        $firstTag=  parent::trimAttribute($firstTag, "hump-template-name");
                        return array_merge(array($firstTag),$moduleTagsArray);
                    }
                    break;
                }
            }
        }
    }
}