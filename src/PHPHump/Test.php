<?php
ini_set('display_errors', 1);
require_once '/var/www/html/PHP/PHPHump/Hump.php';
try
{
    $obj = new PHPHump\Hump("/var/www/html/PHP/PHPHump/Examples/HumpWhile.php");
    $obj->title = "Hump While Tutorial";

    $obj->variableName = 5;
    $obj->someValue = range(0, 9);
    echo $obj->execute();
} catch (Exception $ex)
{
    echo $ex->getMessage();
    ;
}