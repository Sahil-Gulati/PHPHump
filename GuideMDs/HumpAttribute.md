# Hump Attribute #
Attributes which plays a very important role in `HTML` tags. These attributes can also be sent via PHP, as an array of key and value pairs, where keys will be the attribute name and values will be attribute values.


## Syntax ##
```HTML
<div hump-attribute="someArrayOfAttrbutes">  <!--- hump-attribute value can be static -->
    <!-- Content goes here -->
</div> 
<div hump-attribute="#[someVariable]#">  <!--- hump-attribute value can be dynamic -->
    <!-- Content goes here -->
</div>
```




## Example: ##
**1.** Create a PHP file with name `hump_attribute.php`

```php
<?php
ini_set('display_errors', 1);
require_once 'vendor/autoload.php';  
try
{
    $obj = new PHPHump\Hump("/var/www/html/PHP/PHPHump/src/PHPHump/Examples/hump_attribute.hump.php");
    
    $obj->title = "Hump Attribute Tutorial";
    $obj->someAttributeArray = array("class"=>"my-class","id"=>"my-div","style"=>"color:green;font-size:20px;"); 
    
    echo $obj->execute();
} 
catch (Exception $ex) 
{
    echo $ex->getMessage();;
}
?>
```


**2.** Create an HTML file with name `hump_attribute.hump.php`
```HTML
<html>
    <head>
        <title>#[title]#</title>
    </head>
    <body>
      <div hump-attribute="someAttributeArray">
          Simple div
      </div>
  </body>
</html>
```

**Output:**

```HTML
<html>
    <head>
        <title>Hump Attribute Tutorial</title>
    </head>
    <body>
      <div class="my-class" id="my-div" style="color:green;font-size:20px;">
         Simple div
      </div>
  </body>
</html>
```
> You can also see:

[**Hump If**](https://github.com/Sahil-Gulati/PHPHump/blob/master/GuideMDs/HumpIf.md)<br/>
[**Hump Loop**](https://github.com/Sahil-Gulati/PHPHump/blob/master/GuideMDs/HumpLoop.md)<br/>
[**Hump While**](https://github.com/Sahil-Gulati/PHPHump/blob/master/GuideMDs/HumpWhile.md)
