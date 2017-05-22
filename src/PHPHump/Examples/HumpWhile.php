<html>
    <head>
        <title>#[title]#</title>
    </head>
    <body>
        <div hump-while="variableName" counter-type="decr">
            <span>#[someValue]#</span>
        </div>
        <humpSwitch switch-over="variableName">
            <humpCase case="4">
                <span>Hi i am #[variableName]#</span>
            </humpCase>
            <humpDefault>
                <span>In default, Hi i am #[variableName]#</span>
            </humpDefault>
        </humpSwitch>
    </body>
</html>