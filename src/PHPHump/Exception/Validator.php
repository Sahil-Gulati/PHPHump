<?php
namespace PHPHump\Exception;
/**
 * @author Sahil Gulati <sahil.gulati1991@outlook.com>
 * @desc
 */
class Validator extends \Exception
{
    private $exceptionString="";
    public function __construct($exceptionCode,\stdClass $stdClassObject)
    {
        $this->getExtendedMessage($stdClassObject);
        parent::__construct($this->exceptionString);
    }
    public function getExtendedMessage(\stdClass $stdClassObject)
    {
        switch ($stdClassObject->errorType)
        {
            case 1:
                $this->exceptionString="Errored tag `$stdClassObject->erroredTag` on line no `$stdClassObject->lineNo`!";
                $string="<h1 style='color:#c44b4b;font-size:20px;margin-bottom:5px;'>PHPHump Exception!</h1>";
                $string.="<p style='color:#6d5c5c;font-family:monospace;font-size:16px;margin-bottom:1px;font-weight:bolder'>Unexpected tag!</p>";
                $string.="<p style='color:#6d5c5c;font-family:monospace;font-size:12px;margin-bottom:1px;margin-top:1px;font-weight:bolder'>Line no: $stdClassObject->lineNo</p>";
                $string.="<p style='color:#6d5c5c;font-family:monospace;font-size:12px;margin-bottom:1px;margin-top:1px;font-weight:bolder'>Errored tag: $stdClassObject->erroredTag</p>";
                $string.="<p style='color:#6d5c5c;font-family:monospace;font-size:12px;margin-bottom:1px;margin-top:1px;font-weight:bolder'>You must provide a valid template file.</p>";
                return $string;
            break;
            case 2:
                $this->exceptionString="Expected tag `$stdClassObject->expectedTag`, Errored tag `$stdClassObject->erroredTag` on line no `$stdClassObject->lineNo`!";
                $string="<h1 style='color:#c44b4b;font-size:20px;margin-bottom:5px;'>PHPHump Exception!</h1>";
                $string.="<p style='color:#6d5c5c;font-family:monospace;font-size:16px;margin-bottom:1px;font-weight:bolder'>Tag mismatch!</p>";
                $string.="<p style='color:#6d5c5c;font-family:monospace;font-size:12px;margin-bottom:1px;margin-top:1px;font-weight:bolder'>Line no: $stdClassObject->lineNo</p>";
                $string.="<p style='color:#6d5c5c;font-family:monospace;font-size:12px;margin-bottom:1px;margin-top:1px;font-weight:bolder'>Tag no: $stdClassObject->tagNo</p>";
                $string.="<p style='color:#6d5c5c;font-family:monospace;font-size:12px;margin-bottom:1px;margin-top:1px;font-weight:bolder'>Errored tag: $stdClassObject->erroredTag</p>";
                $string.="<p style='color:#6d5c5c;font-family:monospace;font-size:12px;margin-bottom:1px;margin-top:1px;font-weight:bolder'>Expected tag: $stdClassObject->expectedTag</p>";
                $string.="<p style='color:#6d5c5c;font-family:monospace;font-size:12px;margin-bottom:1px;margin-top:1px;font-weight:bolder'>This framework follows strict validation of HTML for closing and opening tag.</p>";
                return $string;
            break;
        }   
    }
}