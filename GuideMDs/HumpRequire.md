# Hump Require #
This is something which is dependent on PHP but can be used with in the hump templating


## Syntax ##
```HTML
<humpRequire file="#[requirePath]#"></humpRequire>
```

### Required parameters  ###
> file is required as string which will be valid filename


## Example: ##
Create a PHP file with name `hump_require.php`

```php
<?php
ini_set('display_errors', 1);
require_once 'vendor/autoload.php';  
try
{
    $humpObject= new PHPHump\Hump("/var/www/html/PHP/PHPHump/Examples/hump_require.hump.php");
    
    $humpObject->title="Hump Require Tutorial";
    $humpObject->requirePath="/var/www/html/PHP/PHPHump/Examples/HumpRequire.phps";
    
    echo $humpObject->execute();
} 
catch (Exception $ex) 
{
    echo $ex->getMessage();;
}
?>
```
Create a PHP file with name `hump_require.php` which we will be going to require

```php
<?php

$this->name="sahil";
$this->value="xxxx";
```



Create an HTML file with name `hump_require.hump.php`
```HTML
<html>
    <head>
        <title>#[title]#</title>
    </head>
    <body>
        <humpRequire file="#[requirePath]#"></humpRequire>
        <div>#[name]#</div>
        <div>#[value]#</div>
    </body>
</html>
```

Output

```HTML
<html>
    <head>
        <title>Hump Require Tutorial</title>
    </head>
    <body>
        <div>john</div>
        <div>xxxx</div>
    </body>
</html>
```
