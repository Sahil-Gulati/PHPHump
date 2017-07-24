# Hump If #
There can be number of things, when you want to execute HTML content on the basis of some condition. It can be either positive or negative condition.


## Syntax ##
```html
<div hump-if="variableName">   <!--- check for isset likewise in php -->
    <!--- content goes here -->
</div>
<div hump-if="not(variableName)"> <!--- check for !isset likewise in php -->
    <!--- content goes here -->
</div>
<div hump-if="variableName->someArrayIndex->nestedIndex"> <!--- check for isset($variableName['someArrayIndex']['nestedIndex']) likewise in php -->
    <!--- content goes here -->
</div>
<div hump-if="not(variableName->someArrayIndex->nestedIndex)"> <!--- check for !isset($variableName['someArrayIndex']['nestedIndex']) likewise in php -->
    <!--- content goes here -->
</div>
```

## Example: ##
Create a PHP file with name `hump_loop.php`

```php

<?php
ini_set('display_errors', 1);
require_once 'vendor/autoload.php';  
try
{
    $humpObject= new PHPHump\Hump("/var/www/html/PHP/PHPHump/Examples/hump_if.hump.php");
    
    $humpObject->title="Hump If Tutorial";
    $humpObject->testingVar=  "some value";
    $humpObject->array=  array(
                            "name"=>array(
                                "value"=>"John"
                            )
                        );
    $humpObject->John = 27;
    
    echo $humpObject->execute();
    
} 
catch (Exception $ex) 
{
    echo $ex->getMessage();;
}

?>
```


Create an HTML file with name `hump_if.hump.php`
```HTML
<html>
    <head>
        <title>#[title]#</title>
    </head>
    <body>

        <div hump-if="testingVar">This div will appear when testingVar is defined.</div>
        
        <div hump-if="not(newVariable)">This div will appear as newVariable is not defined.</div>
        
        <div hump-if="not(name->x->y)">
            Checking for nested not(name->x->y)
        </div>
        
        <div hump-if="#[array->name->value]#">
            A new complexed variable #[#[array->name->value]#]#
        </div>
    </body>
</html>
```

Output

```HTML
<html>
    <head>
        <title>Hump If Tutorial</title>
    </head>
    <body>
        <div>This div will appear when testingVar is defined.</div>

        <div>This div will appear as newVariable is not defined.</div>

        <div>
            Checking for nested not(name->x->y)
        </div>
        <div>
            A new complexed variable 27
        </div>
    </body>
</html>
```
