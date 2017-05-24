# Hump Assign #
Sometimes we dynamically want to assign values rather than on PHP.


## Syntax ##
```HTML
<humpAssign key="name" value="value"></humpAssign> <!--- both can be static -->
<humpAssign key="#[name]#" value="value"></humpAssign> <!--- key can be dynamic -->
<humpAssign key="name" value="#[value]#"></humpAssign> <!--- value can be dynamic -->
<humpAssign key="#[name]#" value="#[value]#"></humpAssign> <!-- both can be dynamic -->
```

### Required parameters  ###
> key is required as string

> value is required as string


## Example: ##
Create a PHP file with name `hump_assign.php`

```php
<?php
ini_set('display_errors', 1);
require_once 'vendor/autoload.php';  
try
{
    $humpObject= new PHPHump\Hump("/var/www/html/PHP/PHPHump/Examples/hump_assign.hump.php");
    
    $humpObject->title="Hump Assign Tutorial";
    
    echo $humpObject->execute();   
} 
catch (Exception $ex) 
{
    echo $ex->getMessage();;
}
?>
```


Create an HTML file with name `hump_assign.hump.php`
```HTML
<html>
    <head>
        <title>#[title]#</title>
    </head>
    <body>
        <humpAssign key="name" value="value"></humpAssign>
        <humpAssign key="value" value="john"></humpAssign>
        <div>
            #[#[name]#]#
        </div>
    </body>
</html>
```

Output

```HTML
<html>
    <head>
        <title>Hump Assign Tutorial</title>
    </head>
    <body>
        <div>
            john
        </div>
    </body>
</html>
```
