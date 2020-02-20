<?php
namespace Adoms\src\lib;
session_start();

require 'vendor/autoload.php';

//Background
$tro = new Map();
$tro->add("font-size","125%");
$tro->add("position","fixed");
$tro->add("background-color","red");
$tro->add("width", "85%");
$tro->add("margin-top","1in");
$tro->add("margin-left","0.55in");
$tro->add("margin-bottom","0.25in");
$tro->add("height","6in");
$tro->add("z-index","-2");
//Header
$tru = new Map();
$tru->add("position","fixed");
$tru->add("z-index","2");
$tru->add("font-size","175%");
$tru->add("text-align","center");
$tru->add("background-color","black");
$tru->add("color","white");
$tru->add("width","98%");
$tru->add("margin-top","-15px");
$tru->add("margin-left","-15px");
$tru->add("border-bottom","10px dashed red");
//Body
$tri = new Map();
$tri->add("font-size","125%");
$tri->add("color","#eeeeee");
$tri->add("margin-top","-15px");
$tri->add("text-decoration","none");
$tri->add("background-color","black");
//Table th
$try = new Map();
$try->add("font-size","125%");
$try->add("color","#eeeeee");
$try->add("padding","20");
$try->add("text-decoration","none");
$try->add("background-color","red");
//Table td
$trd = new Map();
$trd->add("font-size","125%");
$trd->add("color","#eeeeee");
$trd->add("padding","20");
$trd->add("border","2px");
$trd->add("border-color","red");
$trd->add("text-decoration","underline");
$trd->add("background-color","black");
//Rounded Boxes (scrolls)
$tred = new Map();
$tred->add("background-color","gray");
$tred->add("border-radius","10px");
$tred->add("margin-left","0.35in");
$tred->add("margin-right","0.35in");
$tred->add("padding","0.25in");
$tred->add("font-size","90%");
$tred->add("color","black");
$tred->add("height","175");
$tred->add("overflow-y","auto");
$tred->add("overflow-x","hidden");
$tred->add("word-wrap","word-break");
$tred->add("position","relative");
//Rounded Boxes (auto)
$tre = new Map();
$tre->add("background-color","gray");
$tre->add("border-radius","10px");
$tre->add("margin-left","0.35in");
$tre->add("margin-right","0.35in");
$tre->add("padding","0.25in");
$tre->add("font-size","90%");
$tre->add("color","black");
$tre->add("height","auto");
$tre->add("overflow-y","auto");
$tre->add("overflow-x","hidden");
$tre->add("word-wrap","word-break");
//$tre->add("position","relative");
// Tree displays
$tree = new Map();
$tree->add("font-style","bold");
//$tree->add("position", "relative");
$tree->add("background-color","#cccccc");
$tree->add("margin-left","-0.35in");
$tree->add("margin-right","0.35in");
$tree->add("padding-top","0.15in");
$tree->add("padding-left","0.15in");
$tree->add("overflow-y","auto");
$tree->add("overflow-x","hidden");
$tree->add("height","200");
$tree->add("width","600");
//$tree->add("background","-webkit-linear-gradient(left, #cccccc, #000000)");
$tree->add("color","green");
//Floating text
$trey = new Map();
$trey->add("font-style","bold");
$trey->add("padding-top","0.15in");
$trey->add("padding-left","0.15in");
//Columns
$tra = new Map();
$tra->add("word-wrap","break-word");
$tra->add("column-count","2");
$tra->add("column-gap","1em");
$tra->add("column-rule","10px dashed black");
$r = new css("swatch.css", 0);

$r->mCSS->add("body", $tri);
$r->mCSS->add("th", $try);
$r->mCSS->add("td", $trd);
$r->mCSS->add("#bigcols", $tra);
$r->mCSS->add("#hed", $tru);
$r->mCSS->add(".cols", $tre);
$r->mCSS->add("p > div", $tree);
$r->mCSS->add("#bg", $tro);
$r->mCSS->add(".tree", $tree);
$r->mCSS->add(".box", $trey);
$r->mCSS->add("#sbox",$tred);

echo "<html><head>";
echo $r->convert($r->mCSS);
//$r->write();
echo "<script src=\"Adoms/src/routes/pipes.js\"></script>";
echo "<title>Swatch Test Page</title></head><body>";
echo "<style>@import url(\"swatch.css\");</style>";
echo "<span id=\"hed\" style=\"background-color:black;width:100%\"><br>";
echo "Adoms::Helium v1.8.2 - <a href=\"http://www.github.com/swatchphp\">GitHub</a> + ";
echo "<a id=\"wiki-link\" method=\"GET\" out-pipe='red' thru-pipe=\"tests\\" . md5('inland14') . "\">Wiki</a> + ";
echo "<a id=\"donate\" redirect=\"follow\" method=\"POST\" to-pipe=\"https://www.paypal.com/cgi-bin/webscr\"> Donate + </a>"; //?cmd=_s-xclick&hosted_button_id=TMZJ4ZGG84ACL\">Donate</a> + ";
echo "<input type=\"hidden\" pipe=\"donate\" class=\"data-pipe\" name=\"cmd\" value=\"_s-xclick\" />";
echo "<input type=\"hidden\" pipe=\"donate\" class=\"data-pipe\" name=\"hosted_button_id\" value=\"TMZJ4ZGG84ACL\" />";
echo "<input type=\"hidden\" pipe=\"donate\" class=\"data-pipe\" name=\"source\" value=\"url\" />";
echo "<a pipe=\"wiki-link\" class=\"data-pipe\" name=\"me\" value=\"mailto:inland14@live.com\">Contact</a> + ";
echo "<a pipe=\"wiki-link\" class=\"data-pipe\" name=\"ops\" value=\"hey\" href=\"mailto:inland14@live.com\">Bug Report</a>";
echo " <b id='red'></b>";
echo "</span>";
echo "<div id=\"bg\">&nbsp</div>";
echo "<br><br><br><br><div id=\"bigcols\">";
echo "<p class=\"cols\">";
echo "Use the objects in this package to engage Javascript with the created JSONs. Pass them back and forth at will. ";
echo "This should become your goto web language as you experiment and become more free to do what you really want to... ";
echo "Just send me $1 or more a month, that\"s all I ask. If you like this product, please help me to continue my work. ";
echo "Thank you, and Good Night!";
echo "<button id=\"donate\" redirect=\"follow\" method=\"POST\" to-pipe=\"https://www.paypal.com/cgi-bin/webscr\" value=\"Submit\">Submit</button>";
echo "</p>";


$t = new writeStream();
$rrr =  new readStream();
echo "<p class=\"cols\">I'm making a file called " . md5("inland14") . " and it will contain the ";
echo "first Map() I make in here. It has 5 key/value pairs.";

$m = new Map();
for ($i = 0 ; $i < 5 ; $i++) {
    $n = "m$i";
    $m->add($n, ":)");
}
$v2 = md5("inland14");
$t->changeDir("tests");
$t->touch("tests/$v2");
$t->addStrm("$v2",1);
$x = 0;
$t->setIndex(0);
$nm = [];
$t->buf = json_encode($m->dat);
$t->writeBuf();
while (!$m->isEmpty()) {
    $n = "m$x";
    $nm = array_merge($nm, array($n => $m->get($n)));
    $m->remove($n);
    $x++;
} 
$rrr->changeDir("tests");
$rrr->addStrm("$v2");
$rrr->Iter();
$rrr->buffSize = 0;
$rbuf = $rrr->readBuf();
$tt = new api();
$tvv = ($rbuf);
$xx = $tt->json2map($tvv);
echo " Here's the object back from the file, after running thru ->json2map()";
echo json_encode($xx);
echo "</p>";

echo "<p class=\"cols\">";
$s = new Vector("Set");
$ccc = new Set();
$r = 0;
$q = new Set();

do {
    $s->push($ccc);
} while ($r++ < 4);

$i = 0;
// As far as I know, This framework's
// vector iterators are completely restricted
// to using do-while & for loops
$yo = 5;
$r = 0;
$s->setIndex(0);
$s->sync();
do {
    $q->add(++$yo);
    $ccc->add($r++);
    $s->vect = $ccc;
    echo json_encode($ccc);
} while ($s->Iter());
//Don"t forget to sync your Maps and Vectors!!
$s->vect = $q;
$s->sync();
echo json_encode($ccc);
echo "<br>Line 224 <b>I incremented each of these once (But I'm using a Reverse Iterator)</b><br>";
$i = $s->size()-1;

do {
    echo $s->vect->dat[$i]++ . "<br>";
    $i--;
} while ($s->revIter());
if (strlen(json_encode($s)) < 250)
    echo "</p><p class=\"cols\">";
else
    echo "</p><p id=\"sbox\">";
echo "<b class=\"box\">Line 213 <b>This is a Vector(\"Set\")<br></b>" . json_encode($s) . " (I added another 4 here)<br>";
$s->vect->add(4);
echo json_encode($s);
if (strlen(json_encode($s->vect)) < 250)
    echo "</p><p class=\"cols\">";
else
    echo "</p><p id=\"sbox\">";
echo "<b class=\"box\">This is the pointed to Vector held in ->vect<br></b>" . json_encode($s->vect) . "<br>";
$vs = new mSet("Set");
$vs->addSet($ccc);
$vs->addSet($ccc);
$vs->addSet($ccc);
//echo "<br><b>This was retrieved from the JSON I put out.<b><br>" . json_encode($serv);
//Notice that only 1 exists after trying 3 times.
// No joke! Multi-Sets are here!
$sss = $vs->exists(4);

if (strlen(json_encode($sss)) + strlen(json_encode($vs)) < 250)
    echo "</p><p class=\"cols\">";
else
    echo "</p><p id=\"sbox\">";
echo "<b class=\"box\">I found the number 4 at index " . json_encode($sss[0]) . "!</b><br>";
echo json_encode($sss);
echo "<br><b>What? Oh my god.. MultiSets!</b><br>";
echo "<br><br>" . json_encode($vs) . "<br><br>";

$matrix = new Matrix("Any");
$matrix->push($ccc);
$matrix->push($ccc);
$matrix->push($ccc);
$matrix->push($s);
use src\lib\newObj;
$xml = new XML();
$dom1 = new \DOMDocument();
$dom1 = $xml->xmlOut($matrix,$dom1);
$dom1->save("mtx.xml");
$eeyore = $xml->xmlIn("mtx.xml");

if (strlen(json_encode($eeyore)) < 250)
    echo "</p><p class=\"cols\">";
else
    echo "</p><p id=\"sbox\">";
echo "<b id=\"test\" class=\"box\">" . "Here's a Matrix returned from an XML File" . "</b><br>";
echo json_encode($eeyore);
$dom = new \DOMDocument();
$dom = $xml->xmlOut($vs,$dom);
$dom->save("f.xml");
$serv = $xml->xmlIn("f.xml");

$s->clear();
$ms = new Map();
$ms->add("yay", "me!");
$ms->add("yay1", "me!");
$ms->setIndex(0);
// This is a writeable iterator!!
do {

    echo "<b>This is ->map at Index:</b>" . json_encode($ms->map) . "<br>";
    $ms->replace("yay", "Value");
    $ms->add("yay","no");
} while ($ms->Iter());
if (strlen(json_encode($ms)) < 250)
    echo "</p><p class=\"cols\">";
else
    echo "</p><p id=\"sbox\">";
echo "<b>This is \$ms output to a JSON:</b>";
echo "<br><br>" . json_encode($ms) . "<br>";
// Above I changed the pairs to "New/Value"
// And below I"ll show it worked during a reverse Iter
// (which is also writeable!)
// Don"t be deceived by the output, this is a bad example

echo "</p><p class=\"cols\">";
do {
    $ms->map = array("yay1", ":P");
    echo json_encode($ms->map) . "<br>";
} while ($ms->revIter());

$mm = new mMap();
$mm->newMap("MS",$ms);
$mm->newMap("M1",$ms);
$mm->newMap("M2",$ms);

$ms->replace("yay1",":P");

$mn = new Map();
$mn->add("ay", "me!");
$mn->add("ay1", "me!");

$mm->replaceMap("MS",$mn);

$mm->setIndex(0);
$mt = new Map();
$mt->add("ya", "me!");
$mt->add("ya1", "me!");

$domvar = new \DOMDocument();
$domvar = $xml->xmlOut($mm,$domvar);
$domvar->save("testing.xml");
$something = $xml->xmlIn("testing.xml");
if (strlen(json_encode($something)) < 250)
    echo "</p><p class=\"cols\">";
else
    echo "</p><p id=\"sbox\">";
echo "<b>Here's a mMap returned from a XML File!</b>";
echo json_encode($something);
$mm->setIndex(0);
echo "<b>This shows we have 3 maps in \$mm</b><br>";
do {
    echo "L";
} while ($mm->Iter());

$mm->setIndex($mm->size()-1);
$mm->mmap = $mt;

$temp = $mm->getMap("/S/");
$e = $mm->mmap->findKey("/ya/");
if (strlen(json_encode($temp)) + strlen(json_encode($mm)) < 250)
    echo "</p><p class=\"cols\">";
else
    echo "</p><p id=\"sbox\">";
echo "<b>Guess what *I* Found \$mm->mmap->findKey(\"/ya/\"); !</b><br>" . json_encode($e) . "<br><br>";
echo "<b>Did you notice that? Maps don't overwrite with changes to ->map if it ignores the rule of multiple keys :)</b><br>";
echo json_encode($mm);
echo "<br><br><b>I also found this mMap ->mname! with getMap(\"/S/\")</b><br>";
echo json_encode($temp);


echo "</p>";

$s = "'<a href=\"#\">testing</a>','asdj',['adk',['adfd']],'cnaa',['sdasa']";
$treevar = new trees();
$g = $treevar->mockTree($s,1);
if (strlen(json_encode($g)) < 250)
    echo "</p><p class=\"cols\">";
else
    echo "</p><p id=\"sbox\">";
echo "<b>Use the trees() class to make link trees</b><br>";
echo "<b>This is a proper tree. Single quotes for values, deepen as you wish</b><br>";
echo '$s = "&lt;a href=\'#\'&gt;testing&lt;/a&gt;\',\'asdj\',[\'adk\',[\'adfd\']],\'cnaa\',[\'sdasa\']"';
echo "<br><br>" . $g . "<br>";
$sd = "[\"oids\":[\".class,#cssId\":\"a\/?@ soda\",\"ask\":\"9_3.12\",\"ajds\":[\"cucre\":[\"asoidj\":\"asdj\",\"aei\":[\"askd\":\"adk\",]],\"ccsio\":[\"oidfa\":\"adfd\",],\"asdjnae\":\"cnaa\",\"asidj\":\"sdasa\"]]]";

$y = new api();
$m = $y->display($sd);
if (strlen(json_encode($sd)) < 250)
    echo "</p><p class=\"cols\">";
else
    echo "</p><p id=\"sbox\">";
echo '<b>This is what the Vector<"Any"> looks like from $sd</b><br><br>';
echo "$sd";

// Justing flipping this back into the same thing (MAGIC!)
// Create only takes 1 parameter, it can be anything.
// If it"s not a Vector("Any"), than it uses the result of
// $this->apiRecv()
// For API Handling
// JSON from wherever
if (strlen($n) < 250)
    echo "</p><div class=\"cols\">";
else
    echo "</p><div id=\"sbox\">";
echo "<b>Oh, like you didn't want CSS included ;)</b>";
$ts = "@import url(\"dss.css\"); #id .classname p b { property:value; property-1: value; } .classname p b { property:value; property-1: value; }";

$o = new css("readcss.css", 1);
echo "<div class=\"tree\">";
$eq = $o->cssMap($ts,1);
echo "</div>";
echo '<br>If you want to read it in, you can! $cssObj->freader->add($fname,1); Then readBuf() (mind your $this->delim)';
echo 'Afterward, cycle through $cssObj->cssMap($cssString,0). It\'ll turn it all into arrays for editing.';
// Now! CSS!!
/*
$mh = $o->convert($eq);
//echo $mh;
$o->fwriter->add("read2.css",1);
$o->fwriter->setIndex(0);

// Justing flipping this back into the same thing (MAGIC!)
// Create takes 0 or 1 parameter(s), it can be anything.
// If it"s not a Vector("Any"), than it uses the result of
// $this->apiRecv();
// Rip it up!! Move from object to vector
// then back again
*/
$re = $y->display($mm);
echo "</div><br><div class=\"cols\">";

echo "<b>Tell me if this is impressive:</b><br>";
echo "<div class=\"tree\">" . $re;
echo "</div>";
echo "<b style='color:green;font-size:25'>&check;</b> <b>Check</b>";

echo "</div><br>";
echo "<div class=\"cols\"><b>Here's a neat trick! If you have a Matrix with each dimension equal in length,";
echo " then a table can be constructed. Use \$matrix->table(\"[#|.]Idclass=\"); to return the HTML";
echo $eeyore->table(".idClass", array(".idClass"));
echo "</b></div>";
echo "</body></html>";
