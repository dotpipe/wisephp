<?php declare (strict_types = 1);
namespace Adoms\src\lib;


class api
{
    public $regex_mapper;
    public $apiMap;
    public $indent;

    public function __construct()
    {
        $this->apiMap = new Vector("Any");
        $this->regex_mapper = "/[nul\,]{4,5}|[\[\{]|[\]\}][\,]{0,1}|[\,0-9_]{1,}[,$]{0,1}|[\,]{0,1}[\"']{0,1}[!#@?\,\\/%A-z0-9\s\._:]+[\"']{0,1}[:\,$]{0,1}/";
        $this->indent = "<img src=\".\\src\\icons\\code.gif\">";
    }

    public function setIndent(string $ind): bool
    {
        $this->indent = $ind;
        return 1;
    }

    public function receive($m): mMap
    {
        // If you don't have one, but need an example,
        // uncomment this line and run it
        //$s = "[ 'oids': [ 'aoi,sd': \"asoda\", 'askd': 9_312, 'ajds': [ 'cucre': [ 'asoidj': \"asdj\", 'aei': [ 'askd': \"adk\" ] ], 'ccsio': [ 'oidfa': \"adfd\" ], 'asdjnae': \"cnaa\", 'asidj': \"sdasa\" ] ] ]";
        $s = $m;
        if (is_array($m) || is_object($m))
            $s = json_encode($m);
        preg_match_all($this->regex_mapper, $s, $tok);

        $lvl = 0;
        $tmp = $tok[0];
        $output = "";
        for ($i = 0 ; $i < sizeof($tmp) ; $i++) {
            $temp = $tmp[$i];
            $oper = 0;
            if (preg_match("/[\]\}]/", $temp)) {
                $oper = 1;
            }
            if (preg_match("/[\[\{]/", $temp)) {
                $this->apiMap->push(array($temp));
            }
            else if ($i + 1 < sizeof($tmp) && preg_match("/[\"'][!#@?\,\\/%\-A-z0-9\s\._:]+[\"'][:$]/", $temp)) {
                $i++;
                preg_match("/[!#@?\,\\/%\-A-z0-9\s\._]+/", $temp, $t);
                if ($tmp[$i] == '[' || $tmp[$i] == '{') {
                    $this->apiMap->push(array($t[0],$tmp[$i]));
                }
                else if (!preg_match("/[!#@?\\/%\-A-z\s_]+/", $tmp[$i])
                    && preg_match("/[0-9\.]+/", $tmp[$i], $tp))
                    $this->apiMap->push(array($t[0],$tp[0]));
                else if (preg_match_all("/[nul\,]{4,5}/", $tmp[$i], $nul))
                    $this->apiMap->push(array($t[0],$nul[0][0]));
                else {
                    preg_match("/[!#@?\,\\/%\-A-z0-9\s\._:]+/", $tmp[$i], $mp);
                    $this->apiMap->push(array($t[0],$mp[0]));
                }
            }
            else if (preg_match("/[\"'][!#@?\,\\/%\-A-z0-9\s\._:]+[\"'][\,$]{0,1}/", $temp)) {
                preg_match("/[!#@?\,\\/%\-A-z0-9\s\._:]+/", $temp, $n);
                $this->apiMap->push(array($n[0]));
            }
            else if (preg_match_all("/[\]\}][\,$]{0,1}/", $temp)) {
                $this->apiMap->push(array($temp));
            }
        }
        return $this->apiMap;
    }

    public function json2map($m): Map
    {
        $map = new Map();
        foreach ($m as $x=>$y) {
            $map->add($x, $y);
        }
        return $map;
    }

    public function display($m): string
    {
        // If you don't have one, but need an example,
        // uncomment this line and run it
        //$s = "[ 'oids': [ 'aoi,sd': \"asoda\", 'askd': 9_312, 'ajds': [ 'cucre': [ 'asoidj': \"asdj\", 'aei': [ 'askd': \"adk\" ] ], 'ccsio': [ 'oidfa': \"adfd\" ], 'asdjnae': \"cnaa\", 'asidj': \"sdasa\" ] ] ]";
        $s = $m;
        if (is_array($m) || is_object($m))
            $s = json_encode($m);
        preg_match_all($this->regex_mapper, $s, $tok);

        $lvl = 0;
        $tmp = $tok[0];
        $output = "";
        for ($i = 0 ; $i < sizeof($tmp) ; $i++) {
            $temp = $tmp[$i];
            $oper = 0;
            if (preg_match("/[\]\}]/", $temp)) {
                $lvl--;
                $oper = 1;
            }
            for ($j = 0 ; $j < $lvl ; $j++) {
                if ($oper == 1) {
                    $oper = 0;
                    break;
                }
                if ($j + 1 < $lvl)
                    $output = $output . "&nbsp;&nbsp;&nbsp&nbsp;&nbsp;";
                else
                    $output = $output . $this->indent;
            }
            if (preg_match("/[\[\{]/", $temp)) {
                $lvl++;
                $output = $output . '<br>';
            }
            else if ($i + 1 < sizeof($tmp) && preg_match("/[\"'][!#@?\,\\/%\-A-z0-9\s\._:]+[\"'][:$]/", $temp)) {
                $i++;
                preg_match("/[!#@?\,\\/%\-A-z0-9\s\._]+/", $temp, $t);
                if ($tmp[$i] == '[' || $tmp[$i] == '{') {
                    $lvl++;
                }
                $output = $output . $temp;
                if ($tmp[$i] != '[' && $tmp[$i] != '{')
                    $output = $output . ' ' . $tmp[$i];
                $output = $output . '<br>';
            }
            else if (preg_match("/[\"'][!#@?\,\\/%\-A-z0-9\s\._:]+[\"'][\,$]{0,1}/", $temp)) {
                $output = $output . $temp . '<br>';
            }
        }
        return $output;
    }

    public function clear(): void
    {
        $this->apiMap = new Vector("Any");
    }

    // Insert Vector("Any") with simple array(a,b) pairs
    // and to end sections use array("]")
    public function convert($va = 0): string
    {
        $outstring = "";
        $lvl = 0;
        if (!is_array($va) || "Any" != $va->childType)
            $va = $this->apiMap;
        for ($i = 0 ; $i < $va->size() ; $i++) {
            $temp = $va->at($i);
            $checkBracket = $va->at($i+1);

            if (sizeof($temp) == 2 && !preg_match("/[!#@?\\/%\-A-z\s_]+/", $temp[1])
                && preg_match("/[0-9\.]+/", $temp[1], $tp)
                 && sizeof($checkBracket) == 1)
                $outstring = $outstring . "\"" . $temp[0] . "\":" . $tp[0];
            else if (sizeof($temp) == 2 && !preg_match("/[!#@?\\/%\-A-z\s_]+/", $temp[1])
                && preg_match("/[0-9\.]+/", $temp[1], $tp))
                $outstring = $outstring . "\"" . $temp[0] . "\":" . $tp[0] . ",";
            else if (sizeof($temp) == 2 && preg_match("/[\[\{]/", $temp[1]))
                $outstring = $outstring . "\"" . $temp[0] . "\":" . $temp[1];
            else if (sizeof($temp) == 2 && preg_match("/[nul\,]{4,5}/", $temp[1], $nul))
                $outstring = $outstring . "\"" . $temp[0] . "\":" . $temp[1];
            else if (sizeof($temp) == 2 && sizeof($checkBracket) == 1 && preg_match("/[\}\]]/", $checkBracket[0]))
                $outstring = $outstring . "\"" . $temp[0] . "\":\"". $temp[1] . "\"";
            else if (sizeof($temp) == 2 && sizeof($checkBracket) == 1 && !preg_match("/[\}\]]/", $checkBracket[0]))
                $outstring = $outstring . "\"" . $temp[0] . "\":\"". $temp[1] . "\",";
            else if (sizeof($temp) == 2)
                $outstring = $outstring . "\"" . $temp[0] . "\":\"". $temp[1] . "\",";
            else if (sizeof($temp) == 1 && preg_match("/[\{\[]/", $temp[0], $ty))
                $outstring = $outstring . $ty[0];
            else if (sizeof($temp) == 1 && preg_match("/[\}\]]/", $temp[0], $ty))
                $outstring = $outstring . $temp[0];
            else if (sizeof($temp) == 1 && sizeof($checkBracket) == 1 && !preg_match("/[\}\]]/", $checkBracket[0]))
                $outstring = $outstring . "\"" . $temp[0] . "\",";
            else if (sizeof($temp) == 1)
                $outstring = $outstring . "\"" . $temp[0] . "\"";
        }
        return $outstring;
    }
}
