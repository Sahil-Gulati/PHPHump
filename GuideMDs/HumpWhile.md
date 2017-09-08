# Hump While #
Sometimes its just required to iterate over HTML tags any no. of times, which we made quite easy with this attribute, where you will pass parameters and rest `HUMP` will take care of it.


## Syntax ##
```HTML
<div hump-while="variableName" counter-type="decr"> <!--- this div will also be repeated-->
        <!--- content goes here -->
</div> 
<div hump-while="variableName" counter-type="incr"> <!--- this div will also be repeated-->
        <!--- content goes here -->
</div>
```

### Required parameters  ###
> **Attribute:** *hump-while* is required as string

> **Attribute:** *counter-type* is required as string(decr/incr)


## Example: ##
**1.** Create a PHP file with name `hump_while.php`

```php
<?php
ini_set('display_errors', 1);
require_once 'vendor/autoload.php';  
try
{

    $obj = new PHPHump\Hump("/var/www/html/PHP/PHPHump/Examples/hump_while.hump.php");
    $obj->title = "Hump While Tutorial";

    $obj->variableName = 5;
    $obj->someValue = range(0, 9);
    echo $obj->execute();  
    
} 
catch (Exception $ex) 
{
    echo $ex->getMessage();;
}
?>
```


**2.** Create an HTML file with name `hump_while.hump.php`
```HTML
<html>
    <head>
        <title>#[title]#</title>
    </head>
    <body>
        <div hump-while="variableName" counter-type="decr">
            <span>#[someValue]#</span>
        </div>
    </body>
</html>
```

**Output:**

```HTML
<html>
    <head>
        <title>Hump While Tutorial</title>
    </head>
    <body>
        <div>
            <span>[0,1,2,3,4,5,6,7,8,9]</span>
        </div>
        <div>
            <span>[0,1,2,3,4,5,6,7,8,9]</span>
        </div>
        <div>
            <span>[0,1,2,3,4,5,6,7,8,9]</span>
        </div>
        <div>
            <span>[0,1,2,3,4,5,6,7,8,9]</span>
        </div>
        <div>
            <span>[0,1,2,3,4,5,6,7,8,9]</span>
        </div>
    </body>
</html>
```
> You can also see:

[**Hump If**](https://github.com/Sahil-Gulati/PHPHump/blob/master/GuideMDs/HumpIf.md)<br/>
[**Hump Loop**](https://github.com/Sahil-Gulati/PHPHump/blob/master/GuideMDs/HumpLoop.md)<br/>
[**Hump Attribute**](https://github.com/Sahil-Gulati/PHPHump/blob/master/GuideMDs/HumpAttribute.md)<br/>
