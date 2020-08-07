<?php //declare (strict_types = 1);

namespace Adoms\src\lib;

require "vendor/autoload.php";

session_start();
file_put_contents("example.txt",":):):):)");
?>
<script src="./adoms/src/routes/pipes.js"></script>
<span id="hed" style="width:100%"><br>
Adoms::Helium v4.0.0 - <a href="http://www.github.com/swatchphp">GitHub</a> +
<a id="wiki-link" method="GET" insert="red" ajax="example.txt">Wiki</a> +
<i id="donate" redirect="follow" method="POST" goto="https://www.paypal.com/cgi-bin/webscr"> Donate + </i>
<input type="hidden" pipe="donate" class="data-pipe" name="cmd" value="_s-xclick" />
<input type="hidden" pipe="donate" class="data-pipe" name="hosted_button_id" value="TMZJ4ZGG84ACL" />
<input type="hidden" pipe="donate" class="data-pipe" name="source" value="url" />
<a id="thing" display="red">Contact</a> +
<a pipe="wiki-link" class="data-pipe" name="ops" value="hey" href="mailto:inland14@live.com">Bug Report</a>
    
 <b id="red"></b>
</span>
<button id="donate" redirect="follow" method="POST" goto="https://www.paypal.com/cgi-bin/webscr">Submit</button>
</p>

<?php

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
