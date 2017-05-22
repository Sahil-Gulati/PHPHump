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