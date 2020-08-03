<?php declare (strict_types = 1);
session_start();

spl_autoload_register(function ($className) {
    foreach ([
        '/src/lib/',
        '/src/tables/'
    ] as $Path) {
        if (!file_exists($Path . $className . '.php')) {
            continue;
        }
        require_once $Path . $className . '.php';
    }
});

?>
<html>
<head>
<title>Wireframe</title>

<script src="src/routes/pipes.js"></script>
<script>
function dataNext() {
    var x = document.getElementById("s_titlewr");
    var y = document.getElementById("s_dirwr");
    document.getElementById("s_titlemd").value = x.value;
    document.getElementById("s_dirmd").value = y.value;
    document.getElementById("s_view").innerHTML = y.value;
    document.getElementById("s_title").innerHTML = x.value;
}

function next() {
    document.getElementById("createView").style.display = "none";
    document.getElementById("createData").style.display = "block";
    dataNext();
}

function back() {
    document.getElementById("createView").style.display = "block";
    document.getElementById("createData").style.display = "none";
}
</script>
<style>
body {
    background-color:gray;
}

#card1 {
    height:60%;
    display:block;
    background-color:white;
    margin-left:520px;
    margin-right:520px;
    margin-top:100px;
    margin-bottom:100px;
    border-radius:15px;
    text-align:center;
    box-shadow: 5px 4px 8px 4px rgba(0,0,0,0.2);
    transition: 0.3s;
}
tr {
    margin-left:65px;
    margin-right:20px;
    margin-top:20px;
    margin-bottom:20px;
}
div, p {
    border-radius:15px;
    margin-left:40px;
    margin-right:10px;
    margin-top:10px;
    margin-bottom:10px;
}
</style>
</head>

<body>

<table id="card1">
    <tr>
        <td style="padding:25px;text-align:center;"><h1>Wireframe Development Wizard</h1></td>
    </tr>
    <tr>
        <td><hr width="75%"></td>
    </tr>
    <tr id="createView" style="display:block">
        <td style="height:50%;width:300px;border:1px solid black">
            <table align="center">
                <tr>
                    <td style="text-align:right">    Site Title: </td><td><input id="s_titlewr" class="data-pipe" pipe="submit1" type="text" name="s_titlewr" placeholder="Site Title"></td>
                </tr>
                <tr>
                    <td style="text-align:center" colspan="2"><hr width="0%"></td>
                </tr>
                <tr>
                    <td style="text-align:right">    View Name: </td><td><input id="s_dirwr" class="data-pipe" pipe="submit1" type="text" placeholder="index" name="s_directory"></td>
                </tr>
                <tr>
                    <td style="text-align:right">    View Page: </td><td><input class="data-pipe" pipe="submit1" placeholder="index.php" type="text" name="s_name"></td>
                </tr>
                <tr>
                    <td style="text-align:center" colspan="2">    <hr width="0%"></td>
                </tr>
                <tr>
                    <td colspan="2" id="submit1" thru-pipe="http://localhost/warim/creator/make_controller.php" style="border-radius:15px;border:3px solid red;height:30px;width:100%;cursor:pointer;padding:5px;text-align:center">Create View</td>
                </tr>
                <tr>
                    <td colspan="2" onclick="javascript:next()" style="width:100%;border-radius:15px;cursor:pointer;padding:5px;border:3px solid red;text-align:center">Next</td>
                </tr>
            </table>


        </td>
    </tr>
    <tr id="createData" style="display:none">
        <td style="height:50%;width:300px;border:1px solid black">
            <table align="center">
                <tr>
                    <td style="vertical-align:center;text-align:right;">
                    <input type="hidden" id="s_dirmd" class="data-pipe" pipe="submit2" name="s_dirmd">
                    <input type="hidden" id="s_titlemd" class="data-pipe" pipe="submit2" name="s_titlemd">
                    Site Title: </td><td style="vertical-align:center;text-align:center;"><p id="s_title"></p></td>
                </tr>
                    <td style="vertical-align:center;text-align:right;">
                    View Name: </td><td style="vertical-align:center;text-align:center;"><p id="s_view"></p></td>
                </tr>
                <tr>
                    <td style="text-align:center" colspan="2">    <hr width="0%"></td>
                </tr>
                <tr>
                    <td style="text-align:right">    Variable: </td><td><input id="d_name" class="data-pipe" pipe="submit2" type="text" placeholder="Variable Name" name="m_name"></td>
                </tr>
                <tr>
                    <td style="text-align:right">    Value: </td><td><input id="d_val" class="data-pipe" pipe="submit2" placeholder="Init Value" type="text" name="m_val"></td>
                </tr>
                <tr>
                    <td style="text-align:right">    Label: </td><td><input id="d_label" class="data-pipe" pipe="submit2" placeholder="Label" type="text" name="m_label"></td>
                </tr>
                <tr>
                    <td style="text-align:right">    Regex: </td><td><input id="d_reg" value="/.*/" class="data-pipe" pipe="submit2" type="text" placeholder="Regular Expression" name="m_regex"></td>
                </tr>
                <tr>
                    <td style="text-align:right">    Error: </td><td><input id="d_err" class="data-pipe" pipe="submit2" placeholder="Error Message" type="text" name="m_err"></td>
                </tr>
                <tr>
                    <td style="text-align:center" colspan="2">    <hr width="0%"></td>
                </tr>
                <tr>
                    <td colspan="2" id="submit2" thru-pipe="http://localhost/warim/creator/make_controller.php" style="border-radius:15px;border:3px solid red;height:30px;width:100%;cursor:pointer;padding:5px;text-align:center">Create Model Data</td>
                </tr>
                <tr>
                    <td colspan="2" style="border-radius:15px;border:3px solid red;height:30px;width:100%;cursor:pointer;padding:5px;text-align:center" onclick="javascript:back()">Back</td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
</html>