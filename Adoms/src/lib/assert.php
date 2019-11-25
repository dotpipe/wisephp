<html>
<head>
<title>Assertion Test Maker</title>
 <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

<script>
var undo_text = [];
var redo_text = [];
var index = 0;

function getSelectionText() {
    var text = "";
    var activeEl = document.getElementById("code"); //document.activeElement;
    var activeElTagName = activeEl ? activeEl.tagName.toLowerCase() : null;
    if (
      (activeElTagName == "textarea") || (activeElTagName == "input" &&
      /^(?:text|search|password|tel|url)$/i.test(activeEl.type)) &&
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
function surround (t) {

    if (t.id == "annotations")
    textareaClicked(t.options[t.selectedIndex].innerText);
    else
    textareaClicked(t.options[t.selectedIndex].innerText + "( );");
}
function func_change (t) {
    g = t.options[t.selectedIndex];
    f = document.getElementById("functions").getAttribute("file_type") + " ";
    m = document.getElementById("functions").getAttribute("type_name") + " ";
    scope = g.getAttribute("scope") + " ";
    func = g.getAttribute("function") + " ";
    arg = g.getAttribute("args") + " ";
    type = g.getAttribute("type") + " {\n}";
    
    var x = document.getElementById("code").value;
    console.log(x);
    var j, h = "";
    for (var i =0; i < x.length ; i++) {
        if (x[i+1] == '{') {
            j=1;
            i+=2;
        }
        if (j == 1)
            h = h + x[i];
    }
    document.getElementById("code").value = f + m + "{\n" + scope + func + arg + ":" + type + h + "\n}";
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
            document.getElementById("code").value = "public function function_name(\$arg1, \$arg2) { \n\n\n }";
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
}</style>

</head>

<body style="lightgray">
<?php
global $i;
$i = 0;
function io_x($lock_mx, &$i)
{
    $_haystack = ['\n', '\r', '\t', '{', '}', '(', ')', ' ', ';'];
    $_class = "";
    $j = $i;

    do {
        if ($i == strlen($lock_mx)) {
            break;
        }
        $_class .= $lock_mx[$i];
        if (in_array($lock_mx[$i], $_haystack)) {

            //echo $_class . "-";
            $_class = substr($lock_mx, $i, strlen($_class));
            //$i++;
            //continue;
        }
        $i++;
    } while ($i < strlen($lock_mx) && !in_array($lock_mx[$i], $_haystack));
    //echo $_class . "-".$i."@";
    return trim($_class);
}

function io_pm($lock_mx, &$i)
{
    $_haystack = ['\n', '\r', '\t', '{', ';'];
    $j = 0;
    $ol = 0;
    $pl = $i;
    $_class = "";
    do {
        if ($lock_mx[$i] == '(') {
            $ol++;
            if ($j == 0) {
                $pl = $i;
            }
            $j++;
        }
        if ($lock_mx[$i] == ')') {
            $j--;
        }
        if ($ol > 0) {
            $ol++;
            $_class .= $lock_mx[$i];
        }
        if ($j == 0 && $ol > 0) {
            break;
        }
        $i++;
    } while ($i < strlen($lock_mx));
    //echo $_class . "-".$i."@";
    return trim($_class);
}

function io__($lock_mx, &$i, $lm)
{
    $cm = $i - ($i % 500);
    $kp = $i;
    $_class = "";
    while (++$cm % 500 < 499 && $i < strlen($lock_mx) && $lm != substr($lock_mx, $i, strlen($lm))) {
        $i++;
    }
    //echo $_class . "-";
    if (substr($lock_mx, $i, strlen($lm)) == $lm) {
        return trim(substr($lock_mx, $i, strlen($lm)));
    }
    $i = $kp;
    return null;
}

function io_class(string $pluck, string $output)
{
    $mp = fopen("assert.ini", 'r');
    $lock_mx = fread($mp, filesize("assert.ini"));
    $ini_i = 0;
    fclose($mp);
    $php_errormsg=[];
    
    
    $php_exec = io__($lock_mx,$ini_i,'php_exec="');
    if ($php_exec == 'php_exec="') {
        $ini_i += 10;
        $php_exec = io_x($lock_mx,$ini_i);
        $php_exec = substr($php_exec,0,strlen($php_exec)-1);
    }
    else {
        echo 'Corrupted assert.ini';
        exit();
    }
    // Parse for errors in class
    passthru($php_exec . " \"" . $pluck . "\"", $php_errormsg);
    
    if (0 > strlen($php_errormsg)) {
        echo '<b>Error Report:</b>  ' . json_encode($php_errormsg);
    }
    
    $mp = fopen($pluck, 'r');
    $lock_mx = fread($mp, filesize($pluck));
    fclose($mp);
    $_class = [];
    $pool = 0;
    $i = 0;

    $ipl = io__($lock_mx, $i, 'namespace');

    //while ($i < strlen($lock_mx) && $pool != 3)
    $ipl = io__($lock_mx, $i, 'spl_autoload_register');

    //while ($i < strlen($lock_mx) && $pool != 3)
    $ipl = io__($lock_mx, $i, '});');

    $pool = 0;
    $ipl = "";
    $j = $i;
    $ipl = $_class['file_type'] = io__($lock_mx, $i, 'abstract class ');

    if ($ipl != 'abstract class') {
        $ipl = $_class['file_type'] = io__($lock_mx, $i, 'interface ');
    }
    if ($ipl != 'interface') {
        $ipl = $_class['file_type'] = io__($lock_mx, $i, 'class ');
        if ($ipl != 'class') {
            echo "FATAL ERROR: Must be 'abstract class', 'interface', 'class'\nExiting...";
            exit();
        }
    }

    //class
    while ($i < strlen($lock_mx) && $ipl == $_class['file_type']) {
        $ipl = $_class['type_name'] = io_x($lock_mx, $i);
    }
    $ipl = "";
    $j = $i;
    $ipl = $_class['extends'] = io__($lock_mx, $i, 'extends');
    if ($ipl == 'extends') {
        while ($i < strlen($lock_mx) && $_class['extends'] == 'extends') {
            $_class['extends'] = io_x($lock_mx, $i);
        }
    }
    $ipl = $_class['implements'] = io__($lock_mx, $i, 'implements');
    if ($ipl == 'implements') {
        while ($i < strlen($lock_mx) && $_class['implements'] == 'implements') {
            $_class['implements'] = io_x($lock_mx, $i);
        }
    }
    $ipl = io__($lock_mx, $i, ' {');

    $j = sizeof($_class);
    
    while ($i < strlen($lock_mx)) {
        extract_funct($lock_mx, $output, $_class, $i, $j);
    }
    $i = 0;
    $html = $_class['type_name'] . ": ";
    $html .= '<select id="functions" style="float:right;width:280px" file_type="' . $_class['file_type'] . '" type_name="' . $_class['type_name'] . '" onchange="func_change(this)">';
    foreach ($_class as $k => $v) {
        if (!is_numeric($k))
            continue;

        $html .= '<option ';
        foreach ($v as $f => $g) {
            $html .= $f . '="' . $g . '" ';
        }
        $html .= '>' . $v['function'] . '</option>';

    }
    return $html . "</select>";
}

function extract_funct(string $lock_mx, string $output, array &$appended_json, &$i, &$m)
{
    $json = [];
    $j = 0;
    $v = 0;
    $v = $i;
    $cmt_srch = '';
    if (($cmt_srch = io__($lock_mx, $v, '/*')) !== null) {
        $i = $v;
    }
    if (($cmt_srch = io__($lock_mx, $v, '*/')) !== null) {
        $i = $v;
    }
    if (($cmt_srch = io__($lock_mx, $v, '//')) !== null) {
        $i = $v;
        io__($lock_mx, $v, '\r\n');
    }
    while ($i < strlen($lock_mx)) {

        $ipl = io_x($lock_mx, $i);
        switch ($ipl) {
            case 'public':
                $json['scope'] = 'public';
                break;
            case 'private':
                $json['scope'] = 'private';
                break;
            case 'function':
                $json['function'] = io_x($lock_mx, $i);
                $json['args'] = io_pm($lock_mx, $i);
                if ($i < strlen($lock_mx) && (strlen($json['args']) == 0 || $json['args'][strlen($json['args']) - 1] != ')')) {
                    $json['args'] .= ' ' . io_pm($lock_mx, $i);
                }
                $ccc = 0;
                $i++;
                if ($ccc = strpos($lock_mx, ':', $i)) {
                    $ccc++;
                    $json['type'] = "";
                    while ($lock_mx[$ccc + 1] != '{') {
                        $json['type'] .= trim($lock_mx[$ccc]);
                        $ccc++;
                    }
                    $i = $ccc;
                }
                break;
            case '{':
                $j++;
                break;
            case '}':
                $j--;
                if ($j == 0) {
                    $json = array_unique($json);
                    $appended_json[] = $json;
                    $m++;
                    return;
                }
                break;
        }
    }
    return null;
}
$html = "";
if (isset($_GET['x']) && isset($_GET['io1']) && isset($_GET['io2']) && $_GET['x'] == '1') {
    $html = io_class($_GET['io1'], $_GET['io2']);
}
?>
<div class="jumbotron">
    <h3>Assertion Code Manipulator</h3>
</div>
<center>
    <input type="text" id="sel" style="height:0px;visibility:hidden"></input>
    <div id="clip" style="visibility:hidden">
        <p class="alert alert-success" role="alert">
            <strong>Success!</strong> The text was copied to the clipboard
        </p>
    </div>
    <textarea id="code"><?php echo "public function function_name(\$arg1, \$arg2) { \n\n\n }"; ?></textarea><hr>
        <block style="display:inline-grid;grid-template-rows:50px 50px 50x;grid-template-columns:500px 10px 150px 10px 150px 10px 150px;grid-column-start:1;grid-column-end:7;">
            <p class="btn btn-primary">Functions from <?php echo $html; ?></p>
            <p>&nbsp;</p>
            <p class="btn btn-primary" id="parentheses">()</p>
            <p>&nbsp;</p>
            <p class="btn btn-primary" id="square">[]</p>
            <p>&nbsp;</p>
            <p class="btn btn-primary" id="curly">{}</p>
            <p class="btn btn-primary">Assertions: <?php include_once "assertions.php"; ?></p>
            <p>&nbsp;</p>
            <p class="btn btn-primary" id="single"> ' ' </p>
            <p>&nbsp;</p>
            <p class="btn btn-primary" id="double"> " " </p>
            <p>&nbsp;</p>
            <p class="btn btn-primary" id="undo">Undo</p>
            <p class="btn btn-primary">Annotations: <?php include_once "annotations.php"; ?></p>
            <p>&nbsp;</p>
            <p class="btn btn-primary" id="clear">Start Over</p>
            <p>&nbsp;</p>
            <p class="btn btn-primary" id="copy">Copy Text</p>
            <p>&nbsp;</p>
            <p class="btn btn-primary" id="redo">Redo</p>
        </block>
</center>