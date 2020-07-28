<html>
<head>
<title>Runt - Build v1.0</title>
 <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <!--<script src="..\..\Adoms\src\routes\pipes.js"></script> -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

<script>
var undo_text = [];
var redo_text = [];
var index = 0; 

function getTests(e,y) {
    if (e.keyCode == 13) {
        console.log(y.value);
        window.location = "assert.php?ioload=" + y + "&x=1";
    }
}

function getCode(e,y) {
    window.location = "assert.php?iosave=" + document.getElementById("iosave").value + "&x=1&codes=" + document.getElementById("code").value;
}

function getSelectionText() {
    var text = "";
    var activeEl = document.getElementById("code"); //document.activeElement;
    var activeElTagName = activeEl ? activeEl.tagName.toLowerCase() : null;
    if (
      (activeElTagName == "textarea") || (activeElTagName == "input" &&
      /^(?:text|search|password|tel|url)$/i._class(activeEl.type)) &&
      (typeof activeEl.selectionStart == "number")
    ) {
        text = activeEl.value.slice(activeEl.selectionStart, activeEl.selectionEnd);
    } else if (window.getSelection) {
        text = window.getSelection().toString();
    }
    return text;
}

var textSel = "";
document.onmouseup = document.onkeyup = document.onselectionchange = function() {
  document.getElementById("sel").value = getSelectionText();
  textSel = document.getElementById("sel").value;
};
function x (t) {

    if (t.id == "annotations")
    textareaClicked(t.options[t.selectedIndex].innerText);
    else
    textareaClicked(t.options[t.selectedIndex].innerText + "( );");
}
function tab(t,v) {
    
    if (t.keyCode == 9) {
        t.preventDefault();
        textareaClicked("\t", "9");
        v.focus();
    }
}
function func_find(find)
{
    document.getElementById("code").focus();
    var t = document.getElementById("code").value.indexOf(find[find.selectedIndex].getAttribute("function"));
    if (t == -1)
    {
        func_change(find[find.selectedIndex]);
        getLineNumber();
        return;
    }
    document.getElementById("code").setSelectionRange(
        t,
        t//+find[find.selectedIndex].getAttribute("function").length 
    );
    document.getElementById("code").focus();
    getLineNumber();
}

function getLineNumber() {

    lineNumber = document.getElementById("code").value.substr(0, document.getElementById("code").selectionStart).split("\n").length;

    document.getElementById("code").scroll(0,20*(lineNumber-2));      
}


function surround (t) {

    if (t.id == "annotations")
    textareaClicked(t.options[t.selectedIndex].innerText);
    else
    textareaClicked(t.options[t.selectedIndex].innerText + "( );");
}
function func_change (t) {
    
    g = t;
    f = document.getElementById("functions").getAttribute("file_type") + " ";
    m = document.getElementById("functions").getAttribute("type_name") + " ";
    //scope = g.getAttribute("scope") + " ";
    func = g.getAttribute("function") + " ";
    //arg = g.getAttribute("args") + " ";
    //type = g.getAttribute("type") + " {\n}";

    var x = document.getElementById("code").value;
    console.log(x);
    var j = 0, h = "";
    for (var i =0; i < x.length ; i++) {
        if (j == 0 && x[i+1] == '{') {
            j=1;
            i+=1;
        }
        if (j == 1)
            h = h + x[i]; 
    }
    document.getElementById("code").value = "\<\?php\n" + f + m + "{\n" + "\tpublic function test" + func + "() \n\t{\n\t}" + h.substr(1,h.length-6) + "\n}\n?>";
    console.log(h);
}
['click', 'touch', 'tap'].forEach(function(e) {
    window.addEventListener(e, function(ev) {
        var elem = document.getElementById(ev.target.id);
        if (elem == null)
            return;
        console.log(elem.id);
        var elemselect = "";
        if (elem.id == "copy") {
            var copyText = document.getElementById("sel");
            copyText.select();
            document.execCommand("copy");
            document.getElementById("clip").style.visibility = "visible";

        } else
            document.getElementById("clip").style.visibility = "hidden";
        if (redo_text[redo_text.length - 1] != document.getElementById("code").value)
            redo_text.push(document.getElementById("code").value);
        else if (elem.id == "parentheses")
            textareaClicked("(" + textSel +")");
        else if (elem.id == "square")
            textareaClicked("[" + textSel +"]");
        else if (elem.id == "single")
            textareaClicked("'" + textSel +"'");
        else if (elem.id == "double")
            textareaClicked("\"" + textSel +"\"");
        else if (elem.id == "curly")
            textareaClicked("{ " + textSel +" }");
        else if (elem.id == "redo" && undo_text.length > 0) {
            if (redo_text[redo_text.length - 1] == "undefined")
                redo_text.pop();
            console.log(undo_text);
            redo_text.push(document.getElementById("code").value);
            undo_text.pop();
            document.getElementById("code").value = undo_text[undo_text.length - 1];
            if (redo_text[0] == "")
                redo_text.shift();
        } else if (elem.id == "undo" && redo_text.length > 0) {
            console.log(redo_text);
            undo_text.push(document.getElementById("code").value);
            redo_text.pop();
            document.getElementById("code").value = redo_text[redo_text.length - 1];
            if (undo_text[0] == "")
                undo_text.shift();
        } else if (elem.id == "clear" || document.getElementById("code").value == "undefined") {
            document.getElementById("code").value = "\<\?php";
        }
        index = 1;
        var ty = 0;
        if (undo_text[undo_text.length - 1] != document.getElementById("code").value)
            undo_text.push(document.getElementById("code").value);
        while (index < undo_text.length) {
            var search_term = undo_text[undo_text.length - index]
            for (var i = undo_text.length - index - 1; i >= 0; i--) {
                if (undo_text[i] === search_term) {
                    undo_text.splice(i, 1);
                }
            }
            index++;
        }
        index = 1;
        while (index < redo_text.length) {
            var search_term = redo_text[redo_text.length - index]
            for (var i = redo_text.length - index - 1; i >= 0; i--) {
                if (redo_text[i] === search_term) {
                    redo_text.splice(i, 1);
                }
            }
            index++;
        }
        if (document.getElementById("code").value == "undefined")
            document.getElementById("code").value = "";
    }, false);
});
var posS;
var posE;
textareaClicked = function(str1, str2) {
    posS = document.getElementById("code").selectionStart;
    posE = document.getElementById("code").selectionEnd;
    var beforeSelection = document.getElementById("code").value.slice(0, posS);
    var Selection = document.getElementById("code").value.slice(posS, posE);
    var afterSelection = document.getElementById("code").value.slice(posE);
    console.log(posS + " " + posE);
    if (str2 == "" || str2 == undefined) {
        var newHTML = beforeSelection + str1 + afterSelection;
        document.getElementById("code").value = newHTML;
    } else if (str1 === "\t" && str2 === "9") {
        var newHTML = beforeSelection + "\t" + afterSelection;
        document.getElementById("code").value = newHTML;
        document.querySelector("textarea").focus();
        //return;
    } else if (str2 !== undefined && Selection !== undefined && Selection !== "") {
        var newHTML = beforeSelection + str1 + Selection + str2 + afterSelection;
        document.getElementById("code").value = newHTML;
    } else if (Selection === "undefined" || Selection === "") {
        var newHTML = beforeSelection + str1 + str2 + afterSelection;
        document.getElementById("code").value = newHTML;
    }


    document.getElementById("code").setSelectionRange(beforeSelection.length + str1.length + Selection.length, beforeSelection.length + str1.length + Selection.length);
    document.getElementById("code").focus();
};
function moveSelectedTrends() {
    let arry = document.getElementById('functions').options;
    
    for (var i = 0; i < arry.length; i++) {
        console.log(arry[i].getAttribute("function"));
        func_change(arry[i]);
    }
}
</script>
<style>
.p {
    font-size:18;
    padding:5;
    margin:5;
    border-radius:25px 25px 25px 25px;
    text-align:center;
}
input {
    width:100;
}
textarea {
    width:75%;
    height:150;
    border-radius: 5px 5px 5px 5px;
    line-height: 20px;
}</style>

</head>

<body>
<?php
// Discover methods and ClassName of file
function io_get($pluck)
{
    if (!file_exists($pluck))
        return;
    $classes = get_declared_classes();
    include $pluck;
    $diff = array_diff(get_declared_classes(), $classes);
    $class = reset($diff);

    $_class = get_class_methods($class);

    $html = $class . ": ";
    $html .= '<select id="functions" style="float:right;width:280px" file_type="class" type_name="' . $class . '" onchange="func_find(this)">\r\n';
    foreach ($_class as $key => $value) {
        $html .= '<option ';
        $html .= 'function="CheckForFunction' . ucfirst($value) . '">';
        $html .= $value . '</option>';
    }
    return $html . "</select>";

}
$html = "";
if (isset($_GET['x']) && isset($_GET['ioload']) && $_GET['x'] == '1') {
    $html = io_get($_GET['ioload']);
}
if (isset($_GET['x']) && isset($_GET['iosave']) && $_GET['x'] == '1') {
    echo "<script>window.location = \"" . (__DIR__ . "\save.php?x=1&iosave=" . $_GET['iosave'] . "&dataToSave=" . $_GET['codes']) ."\";</script>";
}
?>
<div class="jumbotron" style="padding-top:40px;vertical-align:center;border:1px solid black;border-top:1px solid darkgray;cell-spacing:0px;background-color:darkgray;border-radius:0px 0px 25px 25px;height:100px !important;">
    <h3>Runt Class Unit Test Manipulator v1.0</h3>
</div>
<hr style="background-color:darkgray;width:96.5%;height:1px;margin-left:25px;float:left;margin-top:-25px">
<div class="jumbotron" style="padding:1px;vertical-align:top;margin-top:-15px;margin-left:25px;width:96.5%;border-radius:0px 0px 25px 25px;height:50px !important;">
    <form action="assert.php" method="GET">
    <block style="display:inline-grid;grid-row-start:1;grid-row-end:1;grid-template-columns:450px 400px 450px;grid-column-start:1;grid-column-end:3;">
    <quote><label style="margin-top:-5px;margin-left:35px;">> Input File (inc. relative path): <input onsubmit="getTests(event,this.value)" type="text" name="ioload" style="height:20px;width:150px"/></label></quote>
    <quote><hr style="margin-top:9px;background-color:darkgray;width:100%"><input type="hidden" name="x" value="1"/></quote>
    <span>
    </form>
    <form action="save.php" method="GET">
    <label style="float:right;margin-top:-5px;margin-right:35px;">> Output File (inc. relative path): <input name="iosave" type="text"/><button >Save</button></label>
    </span>
    </block>
</div>
<center>
    <div id="clip" style="visibility:hidden">
        <p class="alert alert-success" role="alert">
            <strong>Success!</strong> The text was copied to the clipboard
        </p>
    </div>
    <textarea id="code" onkeydown="tab(event,this)" name="dataToSave"><?php echo "<?php"; ?></textarea><hr style="width:800">
    </form>
        <block style="display:inline-grid;grid-template-rows:50px 50px 50x;grid-template-columns:500px 10px 150px 10px 150px 10px 150px;grid-column-start:1;grid-column-end:7;">
            <p class="btn btn-primary">&nbsp;<?php echo $html; ?></p>
            <p>&nbsp;</p>
            <p class="btn btn-primary" id="parentheses">( )</p>
            <p>&nbsp;</p>
            <p class="btn btn-primary" id="square">[ ]</p>
            <p>&nbsp;</p>
            <p class="btn btn-primary" id="curly">{ }</p>
            <p class="btn btn-primary">Assertions: <?php require_once("assertions.html");?></p>
            <p>&nbsp;</p>
            <p class="btn btn-primary" id="single"> ' ' </p>
            <p>&nbsp;</p>
            <p class="btn btn-primary" id="double"> " " </p>
            <p>&nbsp;</p>
            <p class="btn btn-primary" id="undo">Undo</p>
            <p class="btn btn-primary">Annotations: <?php require_once("annotations.html");?></p>
            <p>&nbsp;</p>
            <p class="btn btn-primary" id="clear">Start Over</p>
            <p>&nbsp;</p>
            <p class="btn btn-primary" id="copy">Copy Text</p>
            <p>&nbsp;</p>
            <p class="btn btn-primary" id="redo">Redo</p>
        </block>
</center>

<input type="text" id="sel" style="height:0px;visibility:hidden"></input>
<p class="btn btn-primary" onclick="javascript:moveSelectedTrends()"> All Functions </p>