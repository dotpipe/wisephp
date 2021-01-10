<?php

namespace src\lib;

require_once __DIR__ . '../../../../vendor/autoload.php';
class XML extends Common
{
    
    /**
     * @method __construct
     * @param none
     * 
     * call with just the first parameter, the filename
     *  
     */
    public function newObj($r, $e = "Any")
    {
        switch ($r) {
            case 'Vector':
                return new Vector($e);
            case 'Map':
                return new Map();
            case 'mMap':
                return new mMap();
            case 'Queue':
                return new Queue();
            case 'Dequeue':
                return new Queue();
            case 'Set':
                return new Set();
            case 'mSet':
                return new mSet($e);
            case 'Matrix':
                return new Matrix($e);
            case 'rwStream':
                return new rwStream();
            case 'writeStream':
                return new writeStream($e);
            case 'readStream':
                return new readStream($e);
            case 'CSS':
                return new css();
            case 'API':
                return new api("");
            default:
                return null;
        }
    }

    /**
     * @method xmlIn
     * @param string
     *
     */
    public function xmlIn($fname)
    {
        if ($fname == "" || strlen($fname) == 0) {
            return 0;
        }
        $xmlObj = array();
        $dom = new \DomDocument();
        try {
            $dom->load($fname);
        } catch (\Exception $e) {
            return;
        }
        $obj = $dom->getElementsByTagname("Object");
        foreach ($obj as $h) {
            $j = $h->childNodes;
            $ty = $j;
            foreach ($ty as $type) {
                if ($type->nodeName == "ObjectType" && ($type->nodeValue == 'dat'
                    || $type->nodeValue == 'Queues' || $type->nodeValue == 'Dequeues')) {
                    $s = new Set();
                    $m2 = $type->nextSibling;
                    $p = 1;
                    //$m0 = $m2->parentNode;
                    $m1 = $m2->childNodes;
                    foreach ($m1 as $svr) {
                        if ($svr->nodeName == 'Set' || $svr->nodeName == 'Dequeue' || $svr->nodeName == 'Queue') {
                            continue;
                        } elseif ($svr->nodeName == 'data') {
                            $o = $svr->childNodes;
                        }
                        foreach ($o as $serv) {
                            if ($serv->nodeName == 'dat') {
                                $s->add($serv->nodeValue);
                            }
                        }
                    }
                    return $s;
                }
                if ($type->nodeName == "ObjectType" && $type->nodeValue == 'mMap') {
                    $newmMap = new mMap();
                    $new = new Map();
                    // "Map"
                    $m2 = $type->nextSibling;
                    $p = 1;
                    $m1 = null;
                    $m3 = $m2->parentNode;
                    $m = $m3->childNodes;
                    foreach ($m as $mm) {
                        if ($mm->nodeValue == 'mMap') {
                            continue;
                        }
                        if ($mm->nodeName == 'Map');
                        $m1 = $mm->childNodes;
                        //$m = $mm->childNodes;
                        $mName = "";
                        $op = 0;
                        $j = 0;
                        foreach ($m1 as $tre) {
                            if ($tre->nodeName == "Name") {
                                $mName = $tre->nodeValue;
                                continue;
                                //$tre = $tre->nextSibling;
                            }
                            if ($tre->nodeName == "Pairs") {
                                $r = $tre->childNodes;
                                foreach ($r as $pair) {
                                    $go = $pair->childNodes;
                                    $value = null;
                                    $key = "";
                                    $i = 0;
                                    foreach ($go as $dat) {
                                        if ($i%2 == 0) {
                                            $key = $dat->nodeValue;
                                        } else {
                                            $value = $dat->nodeValue;
                                            $new->add($key, $value);
                                        }
                                        $i++;
                                    }
                                }
                                $newmMap->newMap($mName, $new);
                                $mName = "";
                                $b = $tre->nextSibling;
                            }
                        }
                    }
                    return $newmMap;
                }
                if ($type->nodeName == "ObjectType" && $type->nodeValue == 'Maps') {
                    $M1 = new Map();
                    $t = $type->nextSibling;
                    $a = $t->childNodes;
                    $go = null;
                    foreach ($a as $d) {
                        $i = 0;
                        $qwerty = $d->childNodes;
                        $phd = "";
                        foreach ($qwerty as $tr) {
                            if ($i%2 == 0) {
                                $phd = $tr->nodeValue;
                            } else {
                                $M1->add($phd, $tr->nodeValue);
                            }
                            $i++;
                        }
                    }
                    return $M1;
                }
                if ($type->nodeName == "ObjectType" && $type->nodeValue == 'mSet') {
                    $t = $type->nextSibling;
                    $mS = new mSet($t->nodeValue);
                    $s = $this->newObj($t->nodeValue, "mSet");
                    $g = $t->parentNode;
                    $go = $g->childNodes;
                    foreach ($go as $svr) {
                        $o = null;
                        $s->clear();
                        if ($svr->nodeValue == 'mSet') {
                            continue;
                        }
                        if ($svr->nodeValue == 'Set') {
                            continue;
                        }
                        if ($svr->nodeName == 'Set') {
                            $o = $svr->childNodes;
                        }
                        foreach ($o as $serv) {
                            if ($serv->nodeName == 'dat') {
                                $s->add($serv->nodeValue);
                            }
                        }
                        $mS->addSet($s);
                    }
                    return $mS;
                }
                if ($type->nodeName == "ObjectType" && $type->nodeValue == 'Vectors') {
                    $t = $type->nextSibling;
                    $s = $this->newObj("Vector", $t->nodeValue);
                    $go = $t->nextSibling;
                    $g = $go->childNodes;
                    foreach ($g as $svr) {
                        $o = null;
                        if ($svr->nodeName == 'data') {
                            $o = $svr->childNodes;
                        } else {
                            continue;
                        }
                        foreach ($o as $serv) {
                            $p = $serv->childNodes;
                            foreach ($p as $rod) {
                                $s->push($rod->nodeValue);
                            }
                        }
                    }
                    return $s;
                }
                if ($type->nodeName == "ObjectType" && $type->nodeValue == 'Matrices') {
                    $t = $type->nextSibling;
                    $mS = null;
                    if ($t->nodeName == "Variety") {
                        $mS = new Matrix($t->nodeValue);
                    }
                    $t = $t->nextSibling;
                    $varname = null;
                    $s = null;
                    $o = null;
                    $g = null;
                    $e = null;
                    $d = array();
                    if ($t->nodeName == "Matrices") {
                        $g = $t->childNodes;
                    }
                    foreach ($g as $star) {
                        $f = null;
                        if ($star->nodeName == "Mx") {
                            $f = $star->childNodes;
                        }
                        foreach ($f as $st) {
                            if ($st->nodeName == "data") {
                                $o = $st->childNodes;
                            } elseif ($st->nodeName == "Vector") {
                                $varname = $st->nodeValue;
                                $s = $this->newObj($varname, "Vector");
                                
                                continue;
                            }
                            $i = 0;
                            foreach ($o as $serv) {
                                $p = null;
                                if ($serv->nodeName == "dat") {
                                    $p = $serv->nodeValue;
                                }
                                if ($varname == "Vector" && $serv->nodeName == "d") {
                                    $n = new Vector("Any");
                                    $w = $serv->childNodes;
                                    foreach ($w as $vct) {
                                        $n->push($vct->nodeValue);
                                    }
                                    $s->push($n->dat);
                                } else {
                                    $s->add($p);
                                }
                            }
                        }
                        $mS->push($s);
                    }
                    return $mS;
                }
            }
        }
    }

    /**
     * @method xmlOut
     * @param mixed, DOM, int, mixed
     *
     */
    public function xmlOut($obj, $dom, bool $bool = false, $trm = null)
    {
        $tier = null;
        $type = null;
        $var = null;
        if ($bool == 0) {
            $var = $dom->createElement("Object");
            $var = $dom->appendChild($var);
            $type = $dom->createElement("ObjectType");
            $type = $var->appendChild($type);
        } else {
            $var = $dom->firstChild;
        }
        $root = null;
        $robj = "";
        if (is_object($obj)) {
            $robj = $obj->parentType;
        } else {
            $robj = "String";
        }
        switch ($robj) {
            case 'mMap':
                $root = $dom->createTextNode("mMap");
                $tmp = $dom->createElement('Names');
                break;
            case 'Map':
                $root = $dom->createTextNode("Maps");
                break;
            case 'mSet':
                $root = $dom->createTextNode("mSet");
                $tier = $dom->createElement("SubType");
                break;
            case 'Set':
                $root = $dom->createTextNode("dat");
                break;
            case 'Vector':
                $root = $dom->createTextNode("Vectors");
                $tier = $dom->createElement("SubType");
                break;
            case 'Matrix':
                $root = $dom->createTextNode("Matrices");
                break;
            case 'Queue':
                $root = $dom->createTextNode("Queues");
                break;
            case 'Dequeue':
                $root = $dom->createTextNode("Dequeues");
                break;
            case 'String':
                $root = $dom->createTextNode("String");
                break;
            case 'Any':
                $root = $dom->createTextNode("Any");
                break;
        }
        if ($bool == 0 && ($obj->parentType == "mMap" || $obj->parentType == "Map")) {
            $root = $type->appendChild($root);
        }
        if ($bool == 0 && $obj->parentType == "Matrix") { // No Subtypes
            $root = $type->appendChild($root);
        }
        if ($bool == 0 && $tier != null) { // Subtypes
            $root = $type->appendChild($root);
            $tier = $var->appendChild($tier);
            $lyr = $dom->createTextNode($obj->childType);
            $lyr = $tier->appendChild($lyr);
        } elseif ($type != null) {
            $root = $type->appendChild($root);
            $tier = $root;
        }
        if ($robj == 'mMap') {
            $rpv = $dom->firstChild;
            reset($obj->dat);
            for ($x = 0 ; $x < $obj->size() ; $x++) {
                $vpr = $dom->createElement("Map");
                $t = $var->appendChild($vpr);
                $tmp1 = $dom->createElement('Name');
                $tmp1 = $t->appendChild($tmp1);
                $tmp2 = $dom->createTextNode(key($obj->dat));
                $tmp2 = $tmp1->appendChild($tmp2);
                if (is_object($obj)) {
                    $dom = $this->xmlOut(current($obj->dat), $dom, 1, $vpr);
                }
                next($obj->dat);
            }
            return $dom;
        } elseif ($robj == 'Map') {
            $rpv = $dom->firstChild;
            $rt = $rpv->nextSibling;
            $pairs = $dom->createElement("Pairs");
            if ($trm != null) {
                $pairs = $trm->appendChild($pairs);
            } else {
                $pairs = $var->appendChild($pairs);
            }
            reset($obj->dat);
            for ($x = 0 ; $x < $obj->size() ; $x++) {
                $pair = $dom->createElement("Pair");
                $pair = $pairs->appendChild($pair);
                $tmp = $dom->createElement("Key");
                $tmp = $pair->appendChild($tmp);
                $tmp2 = $dom->createTextNode(key($obj->dat));
                $tmp2 = $tmp->appendChild($tmp2);
                $tmp3 = $dom->createElement("Value");
                $tmp3 = $pair->appendChild($tmp3);
                $tmp4 = $dom->createTextNode(current($obj->dat));
                $tmp4 = $tmp3->appendChild($tmp4);
                next($obj->dat);
            }
            return $dom;
        } elseif ($robj == 'Vector' || $robj == 'Vector') {
            $dom = $this->xmlOut($obj->dat, $dom, 1);
            return $dom;
        } elseif ($robj == 'Matrix' || $robj == 'Matrix') {
            $rpv = $dom->firstChild;
            $op = 0;
            for ($x = 0 ; $x < $obj->size() ; $x++) {
                if ($obj->size() > 1 && $x + 1 < $obj->size() && $obj->dat[$x] != $obj->dat[$x+1]) {
                    $op = 1;
                }
            }
            $tigers = $dom->createElement("Variety");
            $tigers = $rpv->appendChild($tigers);
            $tigs = null;
            if ($op == 1) {
                $tigs = $dom->createTextNode("Any");
            } else {
                $tigs = $dom->createTextNode($obj->childType);
            }
            $tigs = $tigers->appendChild($tigs);
            $vpr = $dom->createElement("Matrices");
            $vpr = $rpv->appendChild($vpr);
            if ($obj->dat != null) {
                foreach ($obj->dat as $vect) {
                    $rtv = $dom->createElement("Mx");
                    $rtv = $vpr->appendChild($rtv);
                    $tmp0 = $dom->createElement('Vector');
                    if ($trm != "") {
                        $tmp0 = $trm->appendChild($tmp0);
                    } else {
                        $tmp0 = $rtv->appendChild($tmp0);
                    }
                    $tmp1 = $dom->createTextNode($vect->parentType);
                    $tmp1 = $tmp0->appendChild($tmp1);
                    $tmp2 = null;
                    $op = 0;
                    if ($vect->dat != null && $vect->size() > 0) {
                        if ($op == 0) {
                            $tmp2 = $dom->createElement("data");
                        }
                        if ($trm != "") {
                            $tmp2 = $trm->appendChild($tmp2);
                        } else {
                            $tmp2 = $rtv->appendChild($tmp2);
                        }
                        $op = 1;
                    }
                    foreach ($vect->dat as $rt) {
                        if (is_object($rt)) {
                            $tmp5 = $dom->createElement("d");
                            $tmp5 = $tmp2->appendChild($tmp5);
                            foreach ($rt->dat as $ret) {
                                $tmp3 = $dom->createElement("dat");
                                $tmp3 = $tmp5->appendChild($tmp3);
                                $tmp4 = $dom->createTextNode($ret);
                                $tmp4 = $tmp3->appendChild($tmp4);
                            }
                        } else {
                            $tmp3 = $dom->createElement("dat");
                            $tmp3 = $tmp2->appendChild($tmp3);
                            $tmp4 = $dom->createTextNode($rt);
                            $tmp4 = $tmp3->appendChild($tmp4);
                        }
                    }
                }
            }
            return $dom;
        } elseif ($robj == 'mSet') {
            foreach ($obj->dat as $serv) {
                $t = $dom->createElement("Set");
                $rpv = $dom->firstChild;
                $t = $rpv->appendChild($t);
                foreach ($serv->dat as $ret) {
                    $tmp = $dom->createElement("set");
                    $tmp = $t->appendChild($tmp);
                    $tmp2 = $dom->createTextNode($ret);
                    $tmp2 = $tmp->appendChild($tmp2);
                }
            }
            return $dom;
        } elseif ($robj == 'Queue' || $robj == 'Queue' ||
             $robj == 'Dequeue' || $robj == 'Dequeue' ||
                $robj == 'Set' || $robj == 'Set') {
            $rpv = $dom->firstChild;
            $eq = $dom->createElement($robj);
            $eq = $rpv->appendChild($eq);
            $tr = $dom->createElement("data");
            $rt = $eq->appendChild($tr);
            for ($x = 0 ; $x < $obj->size() ; $x++) {
                $tmp = $dom->createElement("dat");
                $tmp = $rt->appendChild($tmp);
                $tmp2 = $dom->createTextNode($obj->dat[$x]);
                $tmp2 = $tmp->appendChild($tmp2);
            }
            return $dom;
        } elseif ($robj == 'String') {
            $rpv = $dom->firstChild;
            $eq = $dom->createElement($robj);
            $eq = $rpv->appendChild($eq);
            $cnt = 1;
            $tr = $dom->createElement("data");
            $rt = $eq->appendChild($tr);
            if (is_array($obj)) {
                $cnt = sizeof($obj);
            }
            for ($x = 0 ; $x < $cnt ; $x++) {
                $tmp = $dom->createElement("dat");
                $tmp = $rt->appendChild($tmp);
                $tmp2 = $dom->createTextNode($obj[$x]);
                $tmp2 = $tmp->appendChild($tmp2);
            }
            return $dom;
        }
    }
}
