<?php declare (strict_types = 1);
namespace Adoms\src\lib;



class Trees {

    public $tree;
    public $regex_mapper;
    public $indent;
    public $apiMap;

    public function __construct() {
        $this->tree = new Vector("Any");
        $this->regex_mapper = "/[\[\{]|[\]\}]|[\"'][^']+[\"'][\,$]{0}|[['\"<]{2}[^>]+[>\"']{2}[^<'\"]+[\"'<]{2}[^>\"']+[>'\"]{2}[\,$]{0,1}]+/";
        $this->indent = "<img src=\".\\src\\icons\\docs.gif\">";
        $this->apiMap = new Map();
    }

    /**
     * public function linkTree
     * @parameters mixed
     *
     */
    public function linkTree($m) {
        $s = $m;
        if (is_array($m))
            $s = json_encode($m);
        preg_match_all($this->regex_mapper, $s, $tok);

        $lvl = 0;
        $tmp = $tok[0];
        $output = "";
        for ($i = 0 ; $i < count($tmp) ; $i++) {
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
                $this->apiMap->add("m $i", $temp);
                $output = $output . $temp . '<br>';
                $output = $output . '<br>';
            }
            else if ($i + 1 < count($tmp) && preg_match("/[\"'][<>!#@?\,\\/%\-A-z0-9\s\._:]+[\"'][:$]/", $temp)) {
                $i++;
                preg_match("/[<>!#@?\,\\/%\-A-z0-9\s\._]+/", $temp, $t);
                if ($tmp[$i] == '[' || $tmp[$i] == '{') {
                    $this->apiMap->push(array($t[0],$tmp[$i]));
                    $lvl++;
                }
                else if (!preg_match("/[<>!#@?\\/%\-A-z\s_]+/", $tmp[$i])
                    && preg_match("/[0-9\.]+/", $tmp[$i], $tp))
                    $this->apiMap->add($t[0],$tp[0]);
                else if (preg_match_all("/[nul\,]{4,5}/", $tmp[$i], $nul))
                    $this->apiMap->add($t[0],$nul[0][0]);
                else {
                    preg_match("/[<>!#@?\,\\/%\-A-z0-9\s\._:]+/", $tmp[$i], $mp);
                    $this->apiMap->add($t[0],$mp[0]);
                }
                $output = $output . $temp;
                if ($tmp[$i] != '[' && $tmp[$i] != '{')
                    $output = $output . ' ' . $tmp[$i];
                $output = $output . '<br>';
            }
            else if (preg_match("/[\"'][<>!#@?\,\\/%\-A-z0-9\s\._:]+[\"'][\,$]{0,1}/", $temp)) {
                preg_match("/[<>!#@?\,\\/%\-A-z0-9\s\._:]+/", $temp, $n);
                $this->apiMap->add("m $i", $n[0]);
                $output = $output . $temp . '<br>';
            }
            else if (preg_match_all("/[\]\}][\,$]{0,1}/", $temp)) {
                $this->apiMap->add("m $i", $temp);
            }
        }
        return $output;
    }

    /**
     * public function create
     * @parameters mixed
     *
     */
    public function create($va = 0) {
        $outstring = "";
        $lvl = 0;
    //    if (!is_array($va) || "Any" != $va->childType)
            $va = $this->apiMap;
        for ($i = 0 ; $i < $va->size() ; $i++) {
            $temp = $va->at($i);
            $checkBracket = $va->at($i+1);
            if (count($temp) == 2 && !preg_match("/[<>!#@?\\/%\-A-z\s_]+/", $temp[1])
                && preg_match("/[0-9\.]+/", $temp[1], $tp)
                 && count($checkBracket) == 1)
                $outstring = $outstring . "\"" . $temp[0] . "\":" . $tp[0];
            else if (count($temp) == 2 && !preg_match("/[<>!#@?\\/%\-A-z\s_]+/", $temp[1])
                && preg_match("/[0-9\.]+/", $temp[1], $tp))
                $outstring = $outstring . "\"" . $temp[0] . "\":" . $tp[0] . ",";
            else if (count($temp) == 2 && preg_match("/[\[\{]/", $temp[1]))
                $outstring = $outstring . "\"" . $temp[0] . "\":" . $temp[1];
            else if (count($temp) == 2 && preg_match("/[nul\,]{4,5}/", $temp[1], $nul))
                $outstring = $outstring . "\"" . $temp[0] . "\":" . $temp[1];
            else if (count($temp) == 2 && count($checkBracket) == 1 && preg_match("/[\}\]]/", $checkBracket[0]))
                $outstring = $outstring . "\"" . $temp[0] . "\":\"". $temp[1] . "\"";
            else if (count($temp) == 2 && count($checkBracket) == 1 && !preg_match("/[\}\]]/", $checkBracket[0]))
                $outstring = $outstring . "\"" . $temp[0] . "\":\"". $temp[1] . "\",";
            else if (count($temp) == 2)
                $outstring = $outstring . "\"" . $temp[0] . "\":\"". $temp[1] . "\",";
            else if (count($temp) == 1 && is_array($temp) && preg_match("/[\{\[]/", json_encode($temp), $ty))
                $outstring = $outstring . $ty[0];
            else if (count($temp) == 1 && is_array($temp) && preg_match("/[\}\]]/", json_encode($temp), $ty))
                $outstring = $outstring . $ty[0];
            else if (count($temp) == 1 && preg_match("/[\{\[]/", $temp[0], $ty))
                $outstring = $outstring . $ty[0];
            else if (count($temp) == 1 && preg_match("/[\}\]]/", $temp[0], $ty))
                $outstring = $outstring . $ty[0];
            else if (count($temp) == 1 && count($checkBracket) == 1 && !preg_match("/[\}\]]/", $checkBracket[0]))
                $outstring = $outstring . "\"" . $temp[0] . "\",";
            else if (count($temp) == 1)
                $outstring = $outstring . "\"" . $temp[0] . "\"";
        }
        return $outstring;
    }

    /**
     * public function mockTree
     * @parameters mixed
     *
     */
    public function mockTree($m) {
        $s = $m;
        if (is_array($m))
            $s = json_encode($m);
        preg_match_all($this->regex_mapper, $s, $tok);
        $output = "";
        $lvl = 0;
        $tmp = $tok[0];
        for ($i = 0 ; $i < count($tmp) ; $i++) {
            //$temp = $tmp[$i];
            if ($i >= count($tmp)) break;
            while ($i < count($tmp) && preg_match("/[\]\}]/", $tmp[$i])) {
                $i++;
                $lvl--;
                if ($i == count($tmp)) break;
            }
            for ($j = 0 ; $j < $lvl ; $j++) {
                $output = $output . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                if ($j + 1 == $lvl)
                    $output = $output . $this->indent;
            }
            while ($i < count($tmp) && preg_match("/[\[\{]/", $tmp[$i])) {
                $lvl++;
                $i++;
                $output = $output . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                if ($i == count($tmp)) break;
            }
            if ($i < count($tmp) && preg_match("/['][^']+['][\,$]{0,1}|[\"][^\"]+[\"][\,$]{0,1}|[\"'][^']+[\"'$]/", $tmp[$i])) {
                preg_match("/[^']+/", $tmp[$i], $n);
                $output = $output . $n[0] . '<br>';
            }
        }
        return $output;
    }
}
