# PHPHump #

This framework is designed and authored, with an aim to separate `PHP` and `HTML`. Usually it is a messy task to understand PHP and HTML in combined state. This framework allows you to have a clean environment, while working on code base whether it is production and staging. It support no. of features like dynamic templating, dynamic assigning, variable definition, html switching etc.


## Installation
`composer require sahil-gulati/phphump`

**OR**

```javascript
{
    "require":{
        "sahil-gulati/phphump": "1.0.0"
    }
}
```
`composer install`


# Traditional way #

```HTML

<html>
  <head>
    <title>My Page</title>
  </head>
  <body>
    <div>
    <?php 
    foreach($someVariable as $value)
    {
      echo "<p class='someClass'> $value </p>";
    }
    ?>
    </div>
  </body>
  </html>
```

# Hump style #

```HTML
<html>
  <head>
    <title>My Page</title>
  </head>
  <body>
    <div>
    <p class='someClass' hump-loop="someVariable as value"> 
      #[value]# 
    </p>
    </div>
  </body>
  </html>
```
## Modules  ##

**1. Attributes**
    
   1. [***Hump-Loop***](https://github.com/Sahil-Gulati/PHPHump/blob/master/GuideMDs/HumpLoop.md)
   2. [***Hump-If***](https://github.com/Sahil-Gulati/PHPHump/blob/master/GuideMDs/HumpIf.md)
   3. [***Hump-Attribute***](https://github.com/Sahil-Gulati/PHPHump/blob/master/GuideMDs/HumpAttribute.md)
   4. [***Hump-While***](https://github.com/Sahil-Gulati/PHPHump/blob/master/GuideMDs/HumpWhile.md)

**2. Tags**

   1. [***HumpAssign***](https://github.com/Sahil-Gulati/PHPHump/blob/master/GuideMDs/HumpAssign.md)
   2. [***HumpTemplate***](https://github.com/Sahil-Gulati/PHPHump/blob/master/GuideMDs/HumpTemplate.md)
   3. [***HumpRequire***](https://github.com/Sahil-Gulati/PHPHump/blob/master/GuideMDs/HumpRequire.md)
   4. [***HumpSwitch***](https://github.com/Sahil-Gulati/PHPHump/blob/master/GuideMDs/HumpSwitch.md)

