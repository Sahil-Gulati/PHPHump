<?php
namespace PHPHump\Html\Validator;
/**
 * @author Sahil Gulati <sahil.gulati1991@outlook.com>
 * @desc
 */
class Manager extends Coordinator
{
    public function __construct($htmlString)
    {
        parent::__construct($htmlString);
    }
    public function validate()
    {
        $this->validateTags();
        $this->validateHtml();
    }
}