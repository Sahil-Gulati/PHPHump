<?php
namespace PHPHump\Exception;
/**
 * @author Sahil Gulati <sahil.gulati1991@outlook.com>
 */
class Variable extends \Exception
{
    protected static $configVarStype="'background-color:#ededed;;border-radius:5px;border:1px dotted grey;padding:2px;cursor:pointer'";
    private $exceptionString="";
    public function __construct($variableName,$isNested=false)
    {
        $this->getExtendedMessage($variableName, $isNested);
        parent::__construct($this->exceptionString);
    }
    public function getExtendedMessage($variableName,$isNested=false)
    {
        if($isNested==false)
        {
            $this->exceptionString="Undefined variable `$variableName`!";
            $string="<h1 style='color:#c44b4b;font-size:20px;margin-bottom:5px;'>PHPHump Exception!</h1>";
            $string.="<p style='color:#6d5c5c;font-family:monospace;font-size:16px;margin-bottom:1px;font-weight:bolder'>Undefined variable!</p>";
            $string.="<p style='color:#6d5c5c;font-family:monospace;font-size:12px;margin-bottom:8px;margin-top:1px;font-weight:bolder'>Variable name: $variableName</p>";
            $string.="<p style='color:#6d5c5c;font-family:monospace;font-size:12px;margin-bottom:1px;margin-top:1px;font-weight:bolder'>To prevent viewing such exception set <span style=".self::$configVarStype."'>debug_errors</span> to false in config.</p>";
            $string.="<p style='color:#6d5c5c;font-family:monospace;font-size:12px;margin-bottom:1px;margin-top:5px;font-weight:bolder'>Note: Setting error status to false may lead to corruption of data.</p>";
            return $string;
        }
        else
        {
            $this->exceptionString="Undefined index `$variableName`!";
            $string="<h1 style='color:#c44b4b;font-size:20px;margin-bottom:5px;'>PHPHump Exception!</h1>";
            $string.="<p style='color:#6d5c5c;font-family:monospace;font-size:16px;margin-bottom:1px;font-weight:bolder'>Undefined index!</p>";
            $string.="<p style='color:#6d5c5c;font-family:monospace;font-size:12px;margin-bottom:8px;margin-top:1px;font-weight:bolder'>Variable name: $variableName</p>";
            $string.="<p style='color:#6d5c5c;font-family:monospace;font-size:12px;margin-bottom:1px;margin-top:1px;font-weight:bolder'>To prevent viewing such exception set <span style=".self::$configVarStype.">debug_errors</span> to false in config.</p>";
            $string.="<p style='color:#6d5c5c;font-family:monospace;font-size:12px;margin-bottom:1px;margin-top:5px;font-weight:bolder'>Note: Setting error status to false may lead to corruption of data.</p>";
            return $string;
        }
    }
    public static function isThrowable($variableName,$isNested)
    {
        if(\PHPHump\Reader\Config::$errorStatus===true)
        {
            throw new \PHPHump\Exception\Variable($variableName,$isNested);
        }
        return false;
    }
}