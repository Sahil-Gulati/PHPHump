# Hump Attribute #
Attributes which plays a very important role in `HTML` these can also be sent via PHP an array of key and value pairs, where keys will be the attribute name and values will be attribute values


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
Create a PHP file with name `hump_attribute.php`

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


Create an HTML file with name `hump_attribute.hump.php`
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

Output:

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
