<?php

/**
 * @author Sahil Gulati <sahil.gulati1991@outlook.com>
 * @desc
 */
namespace PHPHump\Exception;
class Attribute
{
    protected static $configVarStype="'background-color:#ededed;;border-radius:5px;border:1px dotted grey;padding:2px;cursor:pointer'";
    protected static $functions=array(
        0 => 'getIfError',
        1 => 'getLoopError',
        2 => 'getWhileCounterError',
        3 => 'getWhileVariableError',
        4 => 'getAssignError',
        5 => 'getRequireError'
    );


    public static function getMessage($errorCode,$variableName="")
    {
        switch ($errorCode)
        {
            case 0:
                return "Invalid if attribute `$variableName`!";
            case 1:
                return "Invalid loop attribute `$variableName`!";
            case 2:
                return "Invalid while counter attribute `$variableName`!";
            case 3:
                return "Invalid while attribute `$variableName`!";
            case 4:
                return "Invalid assign attribute key can't be empty!";
            case 5:
                return "File attribute can't be empty!";
        }
    }
    public static function getExtendedMessage()
    {
        $arguments=func_get_args();
        $functionName=  self::$functions[$arguments[0]];
        return forward_static_call_array(array(__CLASS__,$functionName), $arguments);
    }
    
    private static function getIfError()
    {
        $variableName=func_get_args()[1];
        $string="<h1 style='color:#c44b4b;font-size:20px;margin-bottom:5px;'>PHPHump Exception!</h1>";
        $string.="<p style='color:#6d5c5c;font-family:monospace;font-size:16px;margin-bottom:1px;font-weight:bolder'>Invalid if attribute!</p>";
        $string.="<p style='color:#6d5c5c;font-family:monospace;font-size:12px;margin-bottom:8px;margin-top:1px;font-weight:bolder'>Attribute value: $variableName</p><br>";
        $string.="<p style='color:#6d5c5c;font-family:monospace;font-size:12px;margin-bottom:1px;margin-top:1px;font-weight:bolder'>You can't prevent Hump syntax validation error by config.</p>";
        $string.="<p style='color:#6d5c5c;font-family:monospace;font-size:12px;margin-bottom:1px;margin-top:5px;font-weight:bolder'>A valid <span style=".self::$configVarStype.">Hump-If</span> syntax can have two formats:</p>";
        $string.="<p style='color:#6d5c5c;font-family:monospace;font-size:12px;margin-bottom:1px;margin-top:5px;font-weight:bolder'><u>1</u>. <i>variableName<i></p>";
        $string.="<p style='color:#6d5c5c;font-family:monospace;font-size:12px;margin-bottom:1px;margin-top:5px;font-weight:bolder'><u>2</u>. <i>variableName->indexA->indexB<i></p>";
        $string.="<p style='color:#6d5c5c;font-family:monospace;font-size:12px;margin-bottom:1px;margin-top:5px;font-weight:bolder'></p>";
        return $string;
    }
    
    private static function getLoopError()
    {
        $variableName=func_get_args()[1];
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
    private static function getWhileCounterError()
    {
        $variableName=func_get_args()[1];
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
    private static function getWhileVariableError()
    {
        $string="<h1 style='color:#c44b4b;font-size:20px;margin-bottom:5px;'>PHPHump Exception!</h1>";
        $string.="<p style='color:#6d5c5c;font-family:monospace;font-size:16px;margin-bottom:1px;font-weight:bolder'>Invalid while attribute!</p>";
        $string.="<p style='color:#6d5c5c;font-family:monospace;font-size:12px;margin-bottom:1px;margin-top:1px;font-weight:bolder'>You can't prevent Hump syntax validation error by config.</p>";
        $string.="<p style='color:#6d5c5c;font-family:monospace;font-size:12px;margin-bottom:1px;margin-top:5px;font-weight:bolder'>A valid Hump-while <span style=".self::$configVarStype.">variable</span> can only be integer</p>";
        return $string;
    }
    private static function getAssignError()
    {
        $string="<h1 style='color:#c44b4b;font-size:20px;margin-bottom:5px;'>PHPHump Exception!</h1>";
        $string.="<p style='color:#6d5c5c;font-family:monospace;font-size:16px;margin-bottom:1px;font-weight:bolder'>Invalid assign attribute!</p>";
        $string.="<p style='color:#6d5c5c;font-family:monospace;font-size:12px;margin-bottom:8px;margin-top:1px;font-weight:bolder'>Key can't be empty.</p>";
        $string.="<p style='color:#6d5c5c;font-family:monospace;font-size:12px;margin-bottom:1px;margin-top:5px;font-weight:bolder'>A valid Hump-assign <span style=".self::$configVarStype.">key</span> can't be empty.</p>";
        $string.="<p style='color:#6d5c5c;font-family:monospace;font-size:12px;margin-bottom:1px;margin-top:1px;font-weight:bolder'>You can't prevent Hump syntax validation error by config.</p>";
        $string.="<p style='color:#6d5c5c;font-family:monospace;font-size:12px;margin-bottom:1px;margin-top:5px;font-weight:bolder'><span style=".self::$configVarStype.">Note:</span> It can support dynamic values.</p>";
        return $string;
    }
    private static function getRequireError()
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
