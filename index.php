<?php //declare (strict_types = 1);

namespace Adoms\src\lib;

require "vendor/autoload.php";

session_start();
file_put_contents("example.txt",":):):):)");
?>
<style>
div {
    border-top-left-radius: 30px; 
    background-color:lightslategray;
}
p {
    background-color: midnightblue;
    color:silver;
    margin:0px;
    border-bottom-left-radius: 5px;
    border-top-left-radius: 5px;
    text-align:justify;
}
#carousel, table {

    border-radius: 30px;
    width:900px;
    margin-left:auto;
    margin-right:auto;
    overflow: clip;
    overflow-x: clip;
}
#carousel-house
{
    border-radius: 30px;
    overflow: clip;
    overflow-x: clip;
    width:400px;
    display:table;
    z-index:5;
    max-height: 100px;
}
#carousel-button-left {
    z-index: 4;
    display:none;
    position: fixed;
    left:10px;
    top:45px;
}
#carousel-button-right {
    z-index: 4;
    display:none;
    position: fixed;
    left:770px;
    top:45px;
}
#carousel-window {
    overflow-wrap:break-word;
    overflow-x: scroll;
    display:table-row;
    height:150px;
    border-top-left-radius: 5px;
    border-top-right-radius: 5px;
    border-bottom-left-radius: 5px;
    border-bottom-right-radius: 5px;
}
::-webkit-scrollbar {
    width: 0px;  /* Remove scrollbar space */
    background: transparent;  /* Optional: just make scrollbar invisible */
}
.carousel-cell {
    border-top-left-radius: 20px;
    border-top-right-radius: 20px;
    border-bottom-left-radius: 20px;
    border-bottom-right-radius: 20px;
    overflow: hidden hidden;
    text-align:justify;
    max-height:50%;
    min-width:150px;
    max-width: 150px;
    z-index: 3;
}
ul {
    border-bottom: 1px solid black;
    border-radius: 38%;
    margin-left: -3px;
}
blinkbox {
    background-color: navy;
    border-radius: 5px;
    text-align:justify;
    height:50px;
    width:300px;
    position:absolute;
    top:100;
}
</style>
<html>
<head>
<script src="./adoms/src/routes/pipes.js"></script>
<script src="./adoms/src/plugins/carousel.js"></script>
<script src="./adoms/src/plugins/notified.js"></script>
<script src="./adoms/src/plugins/filler.js"></script>
</head>
https://www.paypal.com/biz/fund?id=NYFAJYS9VXD42
<body>
<span id="hed" style="text-align:right;width:100%"><br>
Adoms::Helium v4.1.3 - <a href="http://www.github.com/wise-penny/adoms">GitHub</a> + 
<i id="donate" follow="https://www.paypal.com/biz/fund"> Donate </i> + 
<input type="hidden" pipe="donate" class="data-pipe" name="id" value="NYFAJYS9VXD42" />
<a id="thing" display="red">Contact</a> + 
<a pipe="wiki-link" class="data-pipe" name="ops" value="hey" href="mailto:inland14@live.com">Bug Report</a> + 
Visitors Since 8/14/2020: <b class="content-fill" inject="./adoms/src/plugins/counter/counter.php"></b></span>
<script>filler();</script>
<div id="carousel" style="height:150;background-color:silver;color:black;z-index:5;overflow-y:hidden">
</div>
<blinkbox id="notify" notify-ms="5000" file-order="example.txt, composer.json" ajax="example.txt"></blinkbox>

<table width="width:100%;height:101%;margin-right:10;z-index:3;background-color:lightgray"><tr>
    <td style="vertical-align:super;width:200;">
    <div style="vertical-align:super;height:850;border-right:3px solid silver;border-radius:10px;width:200">
        <br>
        <p>&nbsp;Class Includes</p>
        <hr style="background-color:black" width="10%">
        <p insert="methods" method="GET" id="api" ajax='classlist.php?class=api'>&nbsp;API</p>
        <p insert="methods" method="GET" id="css" ajax='classlist.php?class=css'>&nbsp;CSS</p>
        <p insert="methods" method="GET" id="dequeue" ajax='classlist.php?class=Dequeue'>&nbsp;Dequeue</p>
        <p insert="methods" method="GET" id="map" ajax='classlist.php?class=Map'>&nbsp;Map</p>
        <div style="border-left:1px dashed black;margin-left:10;text-align:center;width:120">
            <ul insert="methods" method="GET" id="mmap" ajax='classlist.php?class=mMap'>mMap</ul>
            <ul insert="methods" method="GET" id="navmap" ajax='classlist.php?class=NavigableMap'>NavigableMap</ul>
            <ul insert="methods" method="GET" id="smap" ajax='classlist.php?class=SortedMap'>SortedMap</ul>
        </div>
        <p insert="methods" method="GET" id="matrix" ajax='classlist.php?class=Matrix'>&nbsp;Matrix</p>
        <p insert="methods" method="GET" id="queue" ajax='classlist.php?class=Queue'>&nbsp;Queue</p>
        <p insert="methods" method="GET" id="set" ajax='classlist.php?class=Set'>&nbsp;Set</p>
        <div style="border-left:1px dashed black;margin-left:10;text-align:center;width:120">
            <ul insert="methods" method="GET" id="mset" ajax='classlist.php?class=mSet'>mSet</ul>
            <ul insert="methods" method="GET" id="navset" ajax='classlist.php?class=NavigableSet'>NavigableSet</ul>
            <ul insert="methods" method="GET" id="sset" ajax='classlist.php?class=SortedSet'>SortedSet</ul>
        </div>
        <p insert="methods" method="GET" id="stack" ajax='classlist.php?class=Stack'>&nbsp;Stack</p>
        <p insert="methods" method="GET" id="streams" ajax='classlist.php?class=Streams'>&nbsp;Streams</p>
        <div style="border-left:1px dashed black;margin-left:10;text-align:center;width:120">
            <ul insert="methods" method="GET" id="read" ajax='classlist.php?class=ReadStream'>Read</ul>
            <ul insert="methods" method="GET" id="write" ajax='classlist.php?class=WriteStream'>Write</ul>
            <ul insert="methods" method="GET" id="rwstream" ajax='classlist.php?class=RWStream'>Read/Write</ul>
        </div>
        <p insert="methods" method="GET" id="thread" ajax='classlist.php?class=Thread'>&nbsp;Threads</p>
        <p insert="methods" method="GET" id="xml" ajax='classlist.php?class=XML'>&nbsp;XML</p>
        <br>
        &nbsp;
    </div>
    </td>
    <td style="vertical-align:super;width:300">
    <section style="display:table;text-align:justify;width:500;">
        <block id="methods" style="display:table-row;text-align:justify">&nbsp;</block>
    </section>
    </td>
    <td style="vertical-align:super;width:200;">
    <div style="border-right:3px solid silver;height:850;vertical-align:super;border-radius:10px;width:200">
         <br>
        <p>&nbsp;Class Includes</p>
        <hr style="background-color:black" width="10%">
        <p insert="methods" method="GET" id="PASM" ajax='classlist.php?class=PASM'>&nbsp;PASM</p>
        <p insert="methods" method="GET" id="oauth2">&nbsp;OAuth2</p>
        <div style="border-left:1px dashed black;margin-left:10;text-align:center;width:120">
            <ul insert="methods" method="GET" id="oauth2owner" ajax='classlist.php?class=OAuth2Owner'>OAuth2Owner</ul>
            <ul insert="methods" method="GET" id="userclass" ajax='classlist.php?class=UserClass'>UserClass</ul>
            <ul insert="methods" method="GET" id="usercontrol" ajax='classlist.php?class=UserController'>UserController</ul>
            <ul insert="methods" method="GET" id="pageviews" ajax='classlist.php?class=CRUD'>CRUD</ul>
        </div>
        <p insert="methods" method="GET" id="ditto">&nbsp;Ditto</p>
        <?= str_repeat("&nbsp;", 5); ?> Unit Test Creator
        <p insert="methods" method="GET" id="wireframe">&nbsp;Wireframe</p>
        <div style="border-left:1px dashed black;margin-left:10;text-align:center;width:120">
            <ul insert="methods" method="GET" id="pagecon" ajax='classlist.php?class=PageControllers'>PageControllers</ul>
            <ul insert="methods" method="GET" id="pageerr" ajax='classlist.php?class=PageErrors'>PageErrors</ul>
            <ul insert="methods" method="GET" id="pagesmods" ajax='classlist.php?class=PageModels'>PageModels</ul>
            <ul insert="methods" method="GET" id="pageviews" ajax='classlist.php?class=PageViews'>PageViews</ul>
        </div>
        <p insert="methods" method="GET" id="router">&nbsp;CookieCheck</p>
            <?= str_repeat("&nbsp;", 5); ?> Javascript
        <p insert="methods" method="GET" id="routes" ajax='classlist.php?class=ChatBox'>&nbsp;ChatBox</p>
        <p insert="methods" method="GET" id="keys" ajax='classlist.php?class=Keywords'>&nbsp;Keywords</p>
        <p insert="methods" method="GET" id="trees" ajax='classlist.php?class=Trees'>&nbsp;Trees</p>
        <p insert="methods" method="GET" id="vector" ajax='classlist.php?class=Vectors'>&nbsp;Vector</p>
            <?= str_repeat("&nbsp;", 5); ?> Inherits all others
        <br>&nbsp;
    </div>
    </td>
</tr>
</table>
<?php

$map = new SortedMap();
$map->add("hey","world!");
$map->add("they","wont!");
$map->lastKey();

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
//$t->changeDir("tests/g/h/j");
$t->addStrm($v2);
$x = 0;

\ob_flush();
$t->buf = json_encode($m->dat);

$t->buffSize = 0;
$t->writeBuf();

//$rrr->changeDir("tests/g/h/j");
$rrr->addStrm($v2);
$rrr->buffSize = 0;
$rrr->readBuf();
$tt = new api();

$tvv = ($rrr->buffData);
echo "*" . ($rrr->buffData);

$xx = $tt->json2map($tvv);
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
//$s->setIndex(0);
//$s->sync();
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
echo "<br>Line 210 <b>I incremented each of these once (But I'm using a Reverse Iterator)</b><br>";
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
echo "<b class=\"box\">This is the pointed to Vector held in ->pt<br></b>" . json_encode($s->vect) . "<br>";
$vs = new mSet("Set");
$vs->addSet($ccc);
$vs->addSet($ccc);
//$ccc->add(6);
$vs->addSet($ccc);
//Notice that only 1 exists after trying 3 times.
// No joke! Multi-Sets are here!
$sss = $vs->setExists($ccc);
echo json_encode($vs);
if (strlen(json_encode($sss)) + strlen(json_encode($vs)) < 250)
    echo "</p><p class=\"cols\">";
else
    echo "</p><p id=\"sbox\">";
echo "<b class=\"box\">Inserted Set is in MultiSet: " . json_encode($sss) . "!</b><br>";
echo "<br><b>What? Oh my god.. MultiSets!</b><br>";
echo "<br><br>" . json_encode($vs) . "<br><br>";

if (strlen(json_encode($vs)) < 250)
    echo "</p><p class=\"cols\">";
else
    echo "</p><p id=\"sbox\">";

$s->clear();
$ms = new Map();
$ms->add("yay", "me!");
$ms->add("yay1", "me!");
$ms->setIndex(0);
// This is a writeable iterator!!
do {
    echo "<b>This is ->pt at Index:</b>" . json_encode($ms->pt) . "<br>";
    $ms->replace("yay", "Value");
    $ms->add("yay","no");
} while ($ms->Iter());
if (strlen(json_encode($ms)) < 250)
    echo "</p><p class=\"cols\">";
else
    echo "</p><p id=\"sbox\">";
echo "<b>This is \$ms output to a JSON:</b>";
echo "<br><br>" . json_encode($ms) . "<br>";
// Above I changed the KV pairs to "New/Value"
// And below I"ll show it worked during a reverse Iter
// (which is also writeable!)
// Don"t be deceived by the output, this is a bad example

do {
    $ms->pt = array("yay1", ":P");
    echo json_encode($ms->pt) . "<br>";
} while ($ms->revIter());

$mm = new mMap();
$mm->newMap("MS",$ms);
$mm->newMap("M1",$ms);
$mm->newMap("M2",$ms);

$ms->replace("yay1",":P");

$mn = new Map();
$mn->add("ay", "me!");
$mn->add("ay1", "me!");

$mm->replace("MS",$mn);

$mm->setIndex(0);
$mt = new Map();
$mt->add("ya", "me!");
$mt->add("ya1", "me!");

if (strlen(json_encode($mm)) < 250)
    echo "</p><p class=\"cols\">";
else
    echo "</p><p id=\"sbox\">";
echo "<b>Here's a mMap returned from a XML File!</b>";
echo json_encode($mm);
$mm->setIndex(0);
echo "<b>This shows we have 3 maps in \$mm</b><br>";
do {
    echo "L";
} while ($mm->Iter());

$mm->setIndex($mm->size()-1);
$mm->mmap = $mt;

$temp = $mm->mapSearch("/S/");
$e = $mm->mmap->findKey("/ya/");
if (strlen(json_encode($temp)) + strlen(json_encode($mm)) < 250)
    echo "</p><p class=\"cols\">";
else
    echo "</p><p id=\"sbox\">";
echo "<b>Guess what *I* Found \$mm->mmap->findKey(\"/ya/\"); !</b><br>" . json_encode($e) . "<br><br>";
echo "<b>Did you notice that? Map don't overwrite with changes to ->pt if it ignores the rule of multiple keys :)</b><br>";
echo json_encode($mm);
echo "<br><br><b>I also found this mMap ->mname! with mapSearch(\"/S/\")</b><br>";
echo json_encode($temp);

$s = "'<a href=\"#\">testing</a>','asdj',['adk',['adfd']],'cnaa',['sdasa']";
//use Adoms\src\lib\trees;
$treevar = new Trees();
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
    echo "</p><p class=\"cols\">";
else
    echo "</p><p id=\"sbox\">";
echo "<b>Oh, like you didn't want CSS included ;)</b>";
$ts = "@import url(\"dss.css\"); #id .classname p b { property:value; property-1: value; } .classname p b { property:value; property-1: value; }";

$o = new css("readcss.css");
echo "<div class=\"tree\">";
//$eq = $o->cssMap($ts,1);
echo "</div>";
echo '<br>If you want to read it in, you can! $cssObj->freader->add($fname,1); Then readBuf() (mind your $this->delim)';
echo 'Afterward, cycle through $cssObj->cssMap($cssString,0). It\'ll turn it all into arrays for editing.';
// Now! CSS!!
//echo json_encode($eq);
//$mh = $o->convert($eq);
//echo $mh;
//$o->fwriter->add("read2.css",1);
//$o->fwriter->setIndex(0);

// Justing flipping this back into the same thing (MAGIC!)
// Create takes 0 or 1 parameter(s), it can be anything.
// If it"s not a Vector("Any"), than it uses the result of
// $this->apiRecv();
// Rip it up!! Move from object to vector
// then back again

$re = $y->display($mm);
echo "</p><br><div class=\"cols\">";

echo "<b>Tell me if this is impressive:</b><br>";
echo "<div class=\"tree\">" . $re;
echo "</div>";
echo "<b style='color:green;font-size:25'>&check;</b> <b>Check</b>";

echo "</div>";
echo "</body></html>";
?>
<script> 
makeCarousel(["example.txt", "composer.json"], "adoms/src/icons/omniscroll.png", "adoms/src/icons/omniscroll.png");
fillCarousel("example.txt, composer.json");
</script>