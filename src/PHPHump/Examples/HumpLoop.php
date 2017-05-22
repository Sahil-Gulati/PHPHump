<html>
    <head>
        <title>#[title]#</title>
    </head>
    <body>
        <div hump-if="nested" hump-loop="nested as k -> val">
            #[k]#
            <span hump-loop="val as newval">
                #[newval_key]#
                <a hump-loop="newval as href" href="#[href]#">
                    #[hrefi]#
                </a>
            </span>
        </div>
    </body>
</html>