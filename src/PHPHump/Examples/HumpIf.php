<html>
    <head>
        <title>#[title]#</title>
    </head>
    <body>

        <div hump-if="testingVar">This div will appear when testingVar is defined</div>
        <div hump-if="new">
            <span>This div will 
                <span>appear when new is not defined</span>                    
            </span>
        </div>
        <div hump-if="not(sss)">This div will not appear</div>
        
        <div hump-if="not(name->sahil->value)">
            Checking for nested not(name->sahil->value)
        </div>
        <div hump-if="#[nested->name->value]#">
            Checking for nested #[#[nested->name->value]#]#
        </div>
    </body>
</html>