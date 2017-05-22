<!DOCTYPE html>
<html>
    <head>
        <title></title>
    </head>
    <body>
    <humpAssign key='check' value='name'></humpAssign>
    <humpAssign key='check1' value='value'></humpAssign>
    <humpAssign key='check2' value='x'></humpAssign>
    <div>#[check]#</div>
    <humpSwitch switch-over="chec">
        <humpCase case="name">
            <div>
                I am name
            </div>
        </humpCase>
        <humpCase case="name1">
            <div>
                I am name1
            </div>
        </humpCase>
    </humpSwitch>
    <div>
        <span hump-if="Sahil">#[Sahil->name->value->x]#</span>
    </div>
</body>
</html>