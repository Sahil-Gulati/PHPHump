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