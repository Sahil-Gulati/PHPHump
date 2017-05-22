<?php

/**
 * @author Sahil Gulati <sahil.gulati1991@outlook.com>
 * @desc
 */
namespace PHPHump\Exception;
class Attribute extends \Exception
{
    protected static $configVarStype="'background-color:#ededed;;border-radius:5px;border:1px dotted grey;padding:2px;cursor:pointer'";
    
    public function __construct($errorCode,$variableName="")
    {
        switch ($errorCode)
        {
            case 1:
                parent::__construct($this->getLoopError($variableName));
                break;
            case 2:
                parent::__construct($this->getWhileCounterError($variableName));
                break;
            case 3:
                parent::__construct($this->getWhileVariableError($variableName));
                break;
            case 4:
                parent::__construct($this->getAssignError($variableName));
                break;
            case 5:
                parent::__construct($this->getRequireError($variableName));
                break;
        }
    }
    
    public function getLoopError($variableName)
    {
        $string="<h1 style='color:#c44b4b;font-size:20px;margin-bottom:5px;'>PHPHump Exception!</h1>";
        $string.="<p style='color:#6d5c5c;font-family:monospace;font-size:16px;margin-bottom:1px;font-weight:bolder'>Invalid loop attribute!</p>";
        $string.="<p style='color:#6d5c5c;font-family:monospace;font-size:12px;margin-bottom:8px;margin-top:1px;font-weight:bolder'>Attribute value: $variableName</p>";
        $string.="<p style='color:#6d5c5c;font-family:monospace;font-size:12px;margin-bottom:1px;margin-top:1px;font-weight:bolder'>You can't prevent Hump syntax validation error by config.</p>";
        $string.="<p style='color:#6d5c5c;font-family:monospace;font-size:12px;margin-bottom:1px;margin-top:5px;font-weight:bolder'>A valid <span style=".self::$configVarStype.">Hump-Loop</span> syntax can have two formats:</p>";
        $string.="<p style='color:#6d5c5c;font-family:monospace;font-size:12px;margin-bottom:1px;margin-top:5px;font-weight:bolder'><u>1</u>. <i>variableName as valueVariableName<i></p>";
        $string.="<p style='color:#6d5c5c;font-family:monospace;font-size:12px;margin-bottom:1px;margin-top:5px;font-weight:bolder'><u>2</u>. <i>variableName as keyVariableName -> valueVariableName<i></p>";
        $string.="<p style='color:#6d5c5c;font-family:monospace;font-size:12px;margin-bottom:1px;margin-top:5px;font-weight:bolder'></p>";
        return $string;
    }
    public function getWhileCounterError($variableName)
    {
        $string="<h1 style='color:#c44b4b;font-size:20px;margin-bottom:5px;'>PHPHump Exception!</h1>";
        $string.="<p style='color:#6d5c5c;font-family:monospace;font-size:16px;margin-bottom:1px;font-weight:bolder'>Invalid while counter attribute!</p>";
        $string.="<p style='color:#6d5c5c;font-family:monospace;font-size:12px;margin-bottom:8px;margin-top:1px;font-weight:bolder'>Attribute value: $variableName</p>";
        $string.="<p style='color:#6d5c5c;font-family:monospace;font-size:12px;margin-bottom:1px;margin-top:1px;font-weight:bolder'>You can't prevent Hump syntax validation error by config.</p>";
        $string.="<p style='color:#6d5c5c;font-family:monospace;font-size:12px;margin-bottom:1px;margin-top:5px;font-weight:bolder'>A valid Hump-while <span style=".self::$configVarStype.">counter</span> can have two values:</p>";
        $string.="<p style='color:#6d5c5c;font-family:monospace;font-size:12px;margin-bottom:1px;margin-top:5px;font-weight:bolder'><u>1</u>. <i>incr</i></p>";
        $string.="<p style='color:#6d5c5c;font-family:monospace;font-size:12px;margin-bottom:1px;margin-top:5px;font-weight:bolder'><u>2</u>. <i>decr</i></p>";
        $string.="<p style='color:#6d5c5c;font-family:monospace;font-size:12px;margin-bottom:1px;margin-top:5px;font-weight:bolder'></p>";
        return $string;
    }
    public function getWhileVariableError($variableName)
    {
        $string="<h1 style='color:#c44b4b;font-size:20px;margin-bottom:5px;'>PHPHump Exception!</h1>";
        $string.="<p style='color:#6d5c5c;font-family:monospace;font-size:16px;margin-bottom:1px;font-weight:bolder'>Invalid while attribute!</p>";
        $string.="<p style='color:#6d5c5c;font-family:monospace;font-size:12px;margin-bottom:1px;margin-top:1px;font-weight:bolder'>You can't prevent Hump syntax validation error by config.</p>";
        $string.="<p style='color:#6d5c5c;font-family:monospace;font-size:12px;margin-bottom:1px;margin-top:5px;font-weight:bolder'>A valid Hump-while <span style=".self::$configVarStype.">variable</span> can only be integer</p>";
        return $string;
    }
    public function getAssignError($variableName)
    {
        $string="<h1 style='color:#c44b4b;font-size:20px;margin-bottom:5px;'>PHPHump Exception!</h1>";
        $string.="<p style='color:#6d5c5c;font-family:monospace;font-size:16px;margin-bottom:1px;font-weight:bolder'>Invalid assign attribute!</p>";
        $string.="<p style='color:#6d5c5c;font-family:monospace;font-size:12px;margin-bottom:8px;margin-top:1px;font-weight:bolder'>Key can't be empty.</p>";
        $string.="<p style='color:#6d5c5c;font-family:monospace;font-size:12px;margin-bottom:1px;margin-top:5px;font-weight:bolder'>A valid Hump-assign <span style=".self::$configVarStype.">key</span> can't be empty.</p>";
        $string.="<p style='color:#6d5c5c;font-family:monospace;font-size:12px;margin-bottom:1px;margin-top:1px;font-weight:bolder'>You can't prevent Hump syntax validation error by config.</p>";
        $string.="<p style='color:#6d5c5c;font-family:monospace;font-size:12px;margin-bottom:1px;margin-top:5px;font-weight:bolder'><span style=".self::$configVarStype.">Note:</span> It can support dynamic values.</p>";
        return $string;
    }
    public function getRequireError($variableName)
    {
        $string="<h1 style='color:#c44b4b;font-size:20px;margin-bottom:5px;'>PHPHump Exception!</h1>";
        $string.="<p style='color:#6d5c5c;font-family:monospace;font-size:16px;margin-bottom:1px;font-weight:bolder'>Invalid file attribute!</p>";
        $string.="<p style='color:#6d5c5c;font-family:monospace;font-size:12px;margin-bottom:8px;margin-top:1px;font-weight:bolder'>File attribute can't be empty.</p>";
        $string.="<p style='color:#6d5c5c;font-family:monospace;font-size:12px;margin-bottom:1px;margin-top:5px;font-weight:bolder'>A valid HumpRequire tag's <span style=".self::$configVarStype.">file</span> attribute can't be empty.</p>";
        $string.="<p style='color:#6d5c5c;font-family:monospace;font-size:12px;margin-bottom:1px;margin-top:1px;font-weight:bolder'>You can't prevent Hump syntax validation error by config.</p>";
        $string.="<p style='color:#6d5c5c;font-family:monospace;font-size:12px;margin-bottom:1px;margin-top:5px;font-weight:bolder'><span style=".self::$configVarStype.">Note:</span> It can support dynamic values.</p>";
        return $string;
    }
}
