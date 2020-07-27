<?php declare (strict_types = 1);
namespace Adoms\src\lib;
use PHPUnit\Framework\TestCase;

class MapTest extends TestCase {

    
    public $m;

    function __construct() {
        $this->m = new Map();
    }
    public function testReplace (string $k, $v) {
        $bool = $this->m->replace("there","here");
        $this->assertIsBool($bool);
    }
    public function testRemoveDat ($k, $v) {
        $bool = $this->m->removedat("there","here");
        $this->assertIsBool($bool);
    }
    public function testFindKey (string $regex) {
        $arr = $this->m->findKey("/ere/");
        $this->assertIsArray($arr);
    }
    public function testRemove (string $k) {
        $bool = $this->m->remove("there");
        $this->assertIsBool($bool);
    }
    public function testMergeAll (array $r) {
        $temp = $this->m->dat;
        $bool = $this->m->mergeAll($temp);
        $this->assertIsBool($bool);
    }
    public function testGet (string $k) {
        $bool = $this->m->get("there");
        $this->assertIsBool($bool);
    }
    public function testKeyIsIn (string $k) {
        $bool = $this->m->keyIsIn("there");
        $this->assertIsBool($bool);
    }

    public function testAt (int $indx) {
        $arr = $this->m->at(0);
        $this->assertIsBool($arr);
        $this->assertIsArray($arr);
    }
    public function testClear () {
        $bool = $this->m->clear();
        $this->assertIsBool($bool);
    }
    public function TestAdd (string $key, $val) {
        $bool = $this->m->add("there","here");
        $this->assertIsBool($bool);
    } 
}
$m = new MapTest();