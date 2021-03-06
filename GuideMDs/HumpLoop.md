# Hump Loop #

Usually iteratation can be proved to be a messy task while dealing with HTML tags. Here we have a much cleaner and easier way of using foreach loop. All it needs is just basic understand of foreach.


## Loop Syntax ##

```HTML
<div hump-loop="variableName as value"> <!--- this div will also be repeated-->
        <!--- content goes here -->
</div> 
<div hump-loop="variableName as key -> value"> <!--- this div will also be repeated-->
        <!--- content goes here -->
</div>  
```


## Example: ##
**1.** Create a PHP file with name `hump_loop.php`

```php

<?php
ini_set('display_errors', 1);
require_once 'vendor/autoload.php';  
try
{
    $humpObject= new PHPHump\Hump("/var/www/html/PHP/PHPHump/Examples/hump_loop.hump.php");
    
    $humpObject->title="Hump Loop Tutorial";
    $humpObject->variableName=  range(0, 4);
    
    echo $humpObject->execute();
    
} 
catch (Exception $ex) 
{
    echo $ex->getMessage();;
}

?>
```


**2.** Create an HTML file with name `hump_loop.hump.php`
```HTML
<html>
    <head>
        <title>#[title]#</title>
    </head>
    <body>
        <div hump-if="variableName" hump-loop="variableName as key -> value">
            Key is #[key]# and value is #[value]#
        </div>
    </body>
</html>
```

**Output:**

```HTML
<html>
    <head>
        <title>Hump Loop Tutorial</title>
    </head>
    <body>
        <div>
            Key is 0 and value is 0
        </div>
        <div>
            Key is 1 and value is 1
        </div>
        <div>
            Key is 2 and value is 2
        </div>
        <div>
            Key is 3 and value is 3
        </div>
        <div>
            Key is 4 and value is 4
        </div>
    </body>
</html>
```
> You can also see:

[**Hump If**](https://github.com/Sahil-Gulati/PHPHump/blob/master/GuideMDs/HumpIf.md)<br/>
[**Hump Attribute**](https://github.com/Sahil-Gulati/PHPHump/blob/master/GuideMDs/HumpAttribute.md)<br/>
[**Hump While**](https://github.com/Sahil-Gulati/PHPHump/blob/master/GuideMDs/HumpWhile.md)
 
