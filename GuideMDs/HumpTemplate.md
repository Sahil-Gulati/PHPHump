# Hump Template #
Templating which is our main goal, but sometimes we want to include template from other files, to separate HTML content Modules in a different files.


## Syntax ##
```HTML
<humpTemplate file="/path/to/templates.html" name="my-template1" analyze="Y">
    <div>
                  <!--- Anything written inside humpTemplate tags will be trucated and replaced with template data -->
                  <!--- If analyze is set to "Y" then each tag will be checked for further content replacement and gathering nested templates  -->
    </div>
</humpTemplate>
```

### Required parameters  ###
> file is required as string

> name is required as string

> analyze is optional can be Y or N


## Example: ##
Create a PHP file with name `hump_assign.php`

```php
<?php
ini_set('display_errors', 1);
require_once 'vendor/autoload.php';  
try
{
    $humpObject = new PHPHump\Hump("/var/www/html/PHP/PHPHump/src/PHPHump/Examples/hump_template_hump.php");
    $humpObject->title = "Hump Template Tutorial"
    
    echo $humpObject->execute();   
} 
catch (Exception $ex) 
{
    echo $ex->getMessage();;
}
?>
```

Create a new PHP file with filename `Templates.php` this will hold your all the templates

```HTML
<div hump-template-name="my-template1">
    <span>
        I am in template 1
        <humpTemplate file="/var/www/html/PHP/PHPHump/Examples/Templates.php" name="my-template2" analyze="Y">
            
        </humpTemplate>
    </span>
</div>

<p hump-template-name="my-template2">
    <span>
        I am in template 2
        <humpTemplate file="/var/www/html/PHP/PHPHump/Examples/Templates.php" name="my-template3">
            
        </humpTemplate>
    </span>
</p>

<div hump-template-name="my-template3">
    <span>
        I am in template 3
    </span>
</div>
```

Create an HTML file with name `hump_template.hump.php`
```HTML
<html>
    <head>
        <title>
            #[title]#
        </title>
    </head>
    <body>
    <humpTemplate file="/var/www/html/PHP/PHPHump/Examples/Templates.php" name="my-template1" analyze="Y">
        <div>
           <!-- This div will be discarded and removed -->
        </div>
    </humpTemplate>
    <span>
        Hi i am in span
    </span>
    </body>
</html>
```

Output

```HTML
<html>
    <head>
        <title>
            Hump Template Tutorial
        </title>
    </head>
    <body>
        <div >
            <span>
                I am in template 1
                <p >
                    <span>
                        I am in template 2
                        <div >
                            <span>
                                I am in template 3
                            </span>
                        </div>
                    </span>
                </p>
            </span>
        </div>

        <span>
            Hi i am in span
        </span>
    </body>
</html>
```
