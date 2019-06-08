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
['click', 'touch', 'tap'].forEach(function(e) {
	window.addEventListener(e, function(ev) {
		var elem = document.getElementById(ev.target.id);
		if (elem == null)
			return;
		console.log(elem.id);
		if (elem.id == "copy") {
			var copyText = document.getElementById("code");
			copyText.select();
			document.execCommand("copy");
			document.getElementById("clip").style.visibility = "visible";

		}
		else
			document.getElementById("clip").style.visibility = "hidden";
		if (redo_text[redo_text.length-1] != document.getElementById("code").value)
			redo_text.push(document.getElementById("code").value);
		if (elem.id == "isstr")
			textareaClicked("is_string(",")");
		else if (elem.id == "isbool")
			textareaClicked("is_bool(",")");
		else if (elem.id == "isarr")
			textareaClicked("is_array(",")");
		else if (elem.id == "isobj")
			textareaClicked("is_object(",")");
		else if (elem.id == "isint")
			textareaClicked("is_int(",")");
		else if (elem.id == "isnum")
			textareaClicked("is_numeric(",")");
		else if (elem.id == "isres")
			textareaClicked("is_resource(",")");
		else if (elem.id == "isscl")
			textareaClicked("is_scalar(",")");
		else if (elem.id == "isfunc")
			textareaClicked("function_exists(",")");
		else if (elem.id == "ismeth")
			textareaClicked("method_exists(",")");
		else if (elem.id == "isnull")
			textareaClicked("is_null(",")");
		else if (elem.id == "isdbl")
			textareaClicked("is_float(",")");
		else if (elem.id == "iscall")
			textareaClicked("is_callable(",")");
		else if (elem.id == "getcls")
			textareaClicked("get_class(",")");
		else if (elem.id == "parentheses")
			textareaClicked("(",")");
		else if (elem.id == "square")
			textareaClicked("[", "]");
		else if (elem.id == "single")
			textareaClicked("'", "'");
		else if (elem.id == "double")
			textareaClicked("\"", "\"");
		else if (elem.id == "curly")
			textareaClicked("{ "," }");
		else if (elem.id == "and")
			textareaClicked("&& ");
		else if (elem.id == "or")
			textareaClicked(" || ");
		else if (elem.id == "neg")
			textareaClicked("!");
		else if (elem.id == "xor")
			textareaClicked("^");
		else if (elem.id == "semic")
			textareaClicked(";");
		else if (elem.id == "jq")
			textareaClicked("$");
		else if (elem.id == "pointer")
			textareaClicked("->");
		else if (elem.id == "lt")
			textareaClicked(" < ");
		else if (elem.id == "gt")
			textareaClicked(" > ");
		else if (elem.id == "settype")
			textareaClicked("settype(",")");
		else if (elem.id == "dot")
			textareaClicked(".");
		else if (elem.id == "hash")
			textareaClicked("#");
		else if (elem.id == "mod")
			textareaClicked("%");
		else if (elem.id == "plus")
			textareaClicked(" + ");
		else if (elem.id == "minus")
			textareaClicked(" - ");
		else if (elem.id == "multiply")
			textareaClicked(" * ");
		else if (elem.id == "instof")
			textareaClicked(" instanceof ");
		else if (elem.id == "divide")
			textareaClicked(" / ");
		else if (elem.id == "assertstr")
			textareaClicked("assert('", "');");
		else if (elem.id == "assertbool")
			textareaClicked("assert(", ");");
		else if (elem.id == "redo" && undo_text.length > 0) {
			if (redo_text[redo_text.length-1] == "undefined")
				redo_text.pop();
			console.log(undo_text);
			redo_text.push(document.getElementById("code").value);
			undo_text.pop();
			document.getElementById("code").value = undo_text[undo_text.length-1];
			if (redo_text[0] == "")
				redo_text.shift();
		}
		else if (elem.id == "undo" && redo_text.length > 0) {
			console.log(redo_text);
			undo_text.push(document.getElementById("code").value);
			redo_text.pop();
			document.getElementById("code").value = redo_text[redo_text.length-1];
			if (undo_text[0] == "")
				undo_text.shift();
		}
		else if (elem.id == "clear" || document.getElementById("code").value == "undefined") {
			document.getElementById("code").value = "public function function_name(\$arg1, \$arg2) { \n\n\n }";
		}
		index = 1;
		var ty = 0;
		if (undo_text[undo_text.length-1] != document.getElementById("code").value)
			undo_text.push(document.getElementById("code").value);
		while (index < undo_text.length) {
			var search_term = undo_text[undo_text.length-index]
			for (var i=undo_text.length-index-1 ; i>=0; i--) {
				if (undo_text[i] === search_term) {
					undo_text.splice(i, 1);
				}
			}
			index++;
		}
		index = 1;
		while (index < redo_text.length) {
			var search_term = redo_text[redo_text.length-index]
			for (var i=redo_text.length-index-1 ; i>=0; i--) {
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
	var beforeSelection = document.getElementById("code").value.slice(0,posS);
	var Selection = document.getElementById("code").value.slice(posS,posE);
	var afterSelection = document.getElementById("code").value.slice(posE);
	console.log(posS + " " + posE);
	if (str2 == "" || str2 == undefined) {
		var newHTML = beforeSelection + str1 + afterSelection;
		document.getElementById("code").value = newHTML;
	}
	else if (str2 !== undefined && Selection !== undefined && Selection !== "") {
		var newHTML = beforeSelection + str1 + Selection + str2 + afterSelection;
		document.getElementById("code").value = newHTML;
	}
	else if (Selection === "undefined" || Selection === "") {
		var newHTML = beforeSelection + str1 + str2 + afterSelection;
		document.getElementById("code").value = newHTML;
	}
		
	document.getElementById("code").setSelectionRange(beforeSelection.length+str1.length+Selection.length,beforeSelection.length+str1.length+Selection.length);
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
}
td {
	text-align:center;
}
</style>

</head>

<body bgcolor="lightgray">

<div class="jumbotron">
	<h3>Assertion Code Manipulator</h3>
</div>
<center>
	<div id="clip" style="visibility:hidden">
		<p class="alert alert-success" role="alert">
			<strong>Success!</strong> The text was copied to the clipboard
		</p>
	</div>
	<textarea id="code"><?php echo "public function function_name(\$arg1, \$arg2) { \n\n\n }"; ?></textarea><hr>
	<table class="table-responsive" position="fixed" style="width:100%">
		<tr>
			<td class="well">
			<div class="btn-group">
				<p class="btn btn-primary" id="isstr">String</p>
				<p class="btn btn-primary" id="isbool">Boolean</p>
				<p class="btn btn-primary" id="isdbl">Float/Double</p>
				<p class="btn btn-primary" id="isint">Integer</p>
				<p class="btn btn-primary" id="isarr">Array</p>
				<p class="btn btn-primary" id="isobj">Object</p>
				<p class="btn btn-primary" id="instof">instanceof</p>
				<p class="btn btn-primary" id="isnull">NULL</p>
				<p class="btn btn-primary" id="isres">Resource</p>
				<p class="btn btn-primary" id="iscall">Callable</p>
				<p class="btn btn-primary" id="isnum">Numeric</p>
				<p class="btn btn-primary" id="isscl">Scalar</p>
			</div>
			<div class="btn-group">
				<p class="btn btn-primary" id="isfunc">Function Exists</p>
				<p class="btn btn-primary" id="ismeth">Method Exists</p>
				<p class="btn btn-primary" id="settype">Set Type</p>
				<p class="btn btn-primary" id="parentheses">()</p>
				<p class="btn btn-primary" id="square">[]</p>
				<p class="btn btn-primary" id="curly">{}</p>
				<p class="btn btn-primary" id="and">&&</p>
				<p class="btn btn-primary" id="or">||</p>
				<p class="btn btn-primary" id="xor">^</p>
				<p class="btn btn-primary" id="neg"> ! </p>
				<p class="btn btn-primary" id="lt">&lt;</p>
				<p class="btn btn-primary" id="gt">&gt;</p>
 				<p class="btn btn-primary" id="single"> ' ' </p>
				<p class="btn btn-primary" id="double"> " " </p>
				<p class="btn btn-primary" id="dot"> . </p>
				<p class="btn btn-primary" id="hash"> # </p>
				<p class="btn btn-primary" id="jq"> $ </p>
				<p class="btn btn-primary" id="mod"> % </p>
				<p class="btn btn-primary" id="plus"> + </p>
				<p class="btn btn-primary" id="minus"> - </p>
				<p class="btn btn-primary" id="multiply"> * </p>
				<p class="btn btn-primary" id="divide"> / </p>
				<p class="btn btn-primary" id="semic"> ; </p>
				<p class="btn btn-primary" id="pointer"> -> </p>
			</div>
			<div class="btn-group">
				<p class="btn btn-primary" id="assertstr">Assert: String</p>
				<p class="btn btn-primary" id="assertbool">Assert: Boolean</p>
				<p class="btn btn-primary" id="undo">Undo</p>
				<p class="btn btn-primary" id="redo">Redo</p>
				<p class="btn btn-primary" id="copy">Copy Text</p>
				<p class="btn btn-primary" id="clear">Start Over</p>
			</div>
			</td>
		</tr>
	</table>
</center>