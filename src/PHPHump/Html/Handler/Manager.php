<?php
namespace PHPHump\Html\Handler;
/**
 * @author Sahil Gulati <sahil.gulati1991@outlook.com>
 */

class Manager extends Coordinator
{
    public function __construct($htmlString="",\PHPHump\Hump $humpObject)
    {
        parent::__construct($htmlString,$humpObject);
    }
    public function prepare()
    {
        return $this->__prepare(parent::extractTags(parent::$htmlString));
    }
}