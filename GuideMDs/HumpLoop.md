# Hump Loop #

Usually we iterate over data content and HTML content within the forloop by echoing out. Here we are skipping that tradition way of wrapping your content with HTML tags.


## Loop Syntax ##

```HTML
1. hump-loop="variableName as value"
2. hump-loop="variableName as key -> value"
```


## Example: ##
Create a PHP file with name `hump_loop.php`

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


Create an HTML file with name `hump_loop.hump.php`
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

Output

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
