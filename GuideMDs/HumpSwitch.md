# Hump Switch #
Sometimes, it is more important to switch on dynamic HTML content on the basis of variable likewise the switch used in PHP.


## Syntax ##
```HTML
<humpSwitch switch-over="someVariable">
    <humpCase case="x">
         <!--- Some Content Here, This will execute when variable `someVariable` as value x -->
    </humpCase>

    <humpCase case="y">
         <!--- Some Content Here, This will execute when variable `someVariable` as value y -->
    </humpCase>
        
    <humpDefault>
         <!--- Some Content Here, This will execute when variable `someVariable` as value is other than x and y -->
    </humpDefault>
</humpSwitch>
```


## Example: ##
Create a PHP file with name `hump_switch.php`

```php
<?php
ini_set('display_errors', 1);
require_once 'vendor/autoload.php';  
try
{
    $obj = new PHPHump\Hump("/var/www/html/PHP/PHPHump/src/PHPHump/Examples/hump_switch.hump.php");

    $obj->title = "Hump Switch Tutorial";
    $obj->someVariable = "x";

    echo $obj->execute();  
} 
catch (Exception $ex) 
{
    echo $ex->getMessage();;
}
?>
```


Create an HTML file with name `hump_switch.hump.php`
```HTML
<html>
    <head>
        <title>#[title]#</title>
    </head>
    <body>
    <humpSwitch switch-over="someVariable" hump-if="someVariable">
        <humpCase case="x">
            <div>
                I am new here with value #[someVariable]#
            </div>
        </humpCase>

        <humpCase case="y">
            <div>
                I am new here with value #[someVariable]#
            </div>
        </humpCase>
        <humpDefault>
            <div>
                I am new here with value #[someVariable]#
            </div>
        </humpDefault>
    </humpSwitch>
    <div>Simple div</div>
</body>
</html>
```

Output

```HTML
<html>
    <head>
        <title>Hump Switch Tutorial</title>
    </head>
    <body>
        <div>
            I am new here with value x
        </div>
        <div>Simple div for</div>
    </body>
</html>
```
