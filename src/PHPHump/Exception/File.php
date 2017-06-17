<?php

namespace PHPHump\Exception;
/**
 * @author Sahil Gulati <sahil.gulati1991@outlook.com>
 * @desc
 */
class File
{
    private static $fileErrorCodes=array(
        404,
        500
    );
    
    private static function getExtendedMessage($code,$filePath="")
    {
        if(in_array($code, self::$fileErrorCodes))
        {
            switch ($code)
            {
                case 404:
                    $string="<h1 style='color:#c44b4b;font-size:20px;margin-bottom:5px;'>PHPHump Exception!</h1>";
                    $string.="<p style='color:#6d5c5c;font-family:monospace;font-size:16px;margin-bottom:1px;font-weight:bolder'>404 File not found!</p>";
                    $string.="<p style='color:#6d5c5c;font-family:monospace;font-size:12px;margin-bottom:1px;margin-top:1px;font-weight:bolder'>File: $filePath</p>";
                    $string.="<p style='color:#6d5c5c;font-family:monospace;font-size:12px;margin-bottom:1px;margin-top:1px;font-weight:bolder'>You must provide a valid template file.</p>";
                    return $string;

            }
        }
    }
    
}
