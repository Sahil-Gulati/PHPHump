<html>
    <head>
        <title>#[title]#</title>
    </head>
    <body>
        
    <humpSwitch switch-over="testingVar" hump-if="testingVar">
    
        <humpCase case="new">
            <div>
                I am new here
            </div>
        </humpCase>
        
        <humpCase case="new1">
            <div>
                I am new1 here
            </div>
        </humpCase>
        <humpDefault>
            <div>
                #[testingVar]#
            </div>
        </humpDefault>
            
    </humpSwitch>
    <div>Simple div for testing</div>
    
    </body>
</html>