<?php
namespace Adoms\src\lib;
spl_autoload_register(function ($className)
{
	$path1 = 'Adoms/src/lib/';
	$path2 = '';
	if (file_exists($path1.$className.'.php'))
		include $path1.$className.'.php';
	else
		include $path2.$className.'.php';
});


	// $this->mmap is the set of Maps
	//This is the Map-in-Map Extension
	class mMap extends Map implements Classes {
		public $val;
		public $dat;
		// Maps array()
		public $map;
		// Index integer
		public $datCntr;
		public $reglist;
		public $regreturn;
		// Current joined map
		public $mmap;
		public $mname;
		public $pm;
		public $cnt;

		public function __construct() {
			$this->parentType = 'mMap';
			$this->rootType = 'Container';
			$this->cache = new Vector('Map');
			$this->datCntr = 0;
			$this->mname = null;
			$this->pm = -1;
			$this->cnt = -1;
			$this->typeOf = 'mMap';
		}
		/*
		*
		* public function save
		* @parameters string
		*
		*/
		public function save(string $json_name): bool {
			$fp = fopen("$json_name", "w");
			fwrite($fp, serialize($this));
			fclose($fp);
			return 1;
		}

		/*
		*
		* public function loadJSON
		* @parameters string
		*
		*/
		public function loadJSON(string $json_name): bool {
			if (file_exists("$json_name") && filesize("$json_name") > 0)
				$fp = fopen("$json_name", "r");
			else
				return 0;
			$json_context = fread($fp, filesize("$json_name"));
			$old = unserialize($json_context);
			$b = $old;
			foreach ($b as $key => $val) {
				$this->$key = $b->$key; //addModelData($old->view, array($key, $val));
			}
			return 1;
		}
		/*
		*
		* public function destroy
		* @parameters none
		*
		*/
		public function destroy(): bool {
			$this->datCntr = null;
			$this->cache = null;
			$this->typeOf = null;
			$this->parentType = null;
			$this->rootType = null; 
			$this->dat = null;
			$this->mmap = null;
			$this->pm = -1;
			$this->mmap = null;
			$this->mname = null;
			return 1;
		}
		/*
		*
		* public function size
		* @parameters none
		*
		*/
		public function size(): int {
			$j = 0;
			return sizeof($this->dat);
		}
		/*
		*
		* public function getMap
		* @parameters string
		*
		*/
		// Return Map fitting $regex
		public function getMap(string $regex): array {
			$reglist = array();
			$tmp = $this->dat;
			reset($tmp);
			$i = 0;
			while ($i < count($tmp)) {
				if (preg_match($regex, key($tmp))) {
					$reglist[] = array(key($tmp) => current($tmp));
				}
				next($tmp);
				$i++;
			}
			return $reglist;
		}
		/*
		*
		* public function newMap
		* @parameters string, mixed
		*
		*/
		// Add Map
		public function newMap(string $key, $r): bool {
			$t = [];
			if ($this->dat == null) {
				$this->dat = [];
				$this->dat = array($key => $r);
				return 1;
			}
			foreach ($this->dat as $x=>$y) {
				$t = array_merge($this->dat, array($x => $y));
			}
			$t = array_merge($t, array($key => $r));
			$this->dat = $t;
			return 1;
		}
		/*
		*
		* public function hasNext
		* @parameters none
		*
		*/
		// Return true if next Map exists
		public function hasNext(): bool {
			if ($this->size() == 0) {
				if ($this->strict == 1) throw new IndexException('Empty Map');
				return 0;
			}
			if ($this->datCntr + 1 < $this->size())
				return 1;
			return 0;
		}
		/*
		*
		* public function nextMap
		* @parameters none
		*
		*/
		// Iterate once forward through Maps
		public function next(): bool {
			$this->Iter();
			return 0;
		}
		/*
		*
		* public function findKey
		* @parameters string
		*
		*/
		// Return Key
		public function findKey(string $regex): array {
			$reglist = array();
			$x = getIndex();
			$this->setIndex(0);
			do {
				$t = $this->mmap;
				$reglist[] = $t->findKey($regex);
				
			} while ($this->Iter());
			$regreturn = $reglist;
			$this->setIndex($x);
			if (sizeof($reglist) == 0)
				return 0;
			return $regreturn;
		}
		/*
		*
		* public function Iter
		* @parameters none
		*
		*/
		public function Iter(): bool {
			if ($this->datCntr >= 0 && $this->datCntr < count($this->dat)) {
				if (is_array($this->mmap) && $this->mname != null)
					$this->add($this->mname, $this->mmap);
				next($this->dat);
				$this->datCntr++;
				$this->sync();
				return 1;
			}
			return 0;
		}
		/*
		*
		* public function revIter
		* @parameters none
		*
		*/
		public function revIter(): bool {
			if ($this->datCntr - 1 >= 0 && $this->datCntr < count($this->dat)) {
				if (is_array($this->mmap) && $this->mname != null)
					$this->add($this->mname, $this->mmap);
				prev($this->dat);
				$this->datCntr--;
				$this->sync();
				return 1;
			}
			return 0;
		}
		/*
		*
		* public function Cycle
		* @parameters none
		*
		*/
		// Turns to next Map entry, or starts over
		public function Cycle(): bool {
			if ($this->datCntr >= 0 && $this->datCntr < count($this->dat)) {
				if (is_object($this->mmap) && $this->mname != null)
					$this->add($this->mname, $this->mmap);
				next($this->dat);
				$this->datCntr++;
				$this->sync();
				return 1;
			}
			else {
				$this->add($this->mname, $this->mmap);
				reset($this->dat);
			}
			return 0;
		}
		/*
		*
		* public function revCycle
		* @parameters none
		*
		*/
		public function revCycle(): bool {
			if ($this->datCntr > 0 && $this->datCntr < count($this->dat)) {
				if (is_array($this->mmap) && $this->mname != null)
					$this->add($this->mname, $this->mmap);
				prev($this->dat);
				$this->datCntr--;
				$this->sync();
				return 1;
			}
			else {
				$this->add($this->mname, $this->mmap);
				end($this->dat);
			}
			return 0;
		}
		/*
		*
		* public function setIndex
		* @parameters int
		*
		*/
		// Sets and Joins Map Index
		public function setIndex(int $indx): bool {
			if ($this->size() == 0) {
				if ($this->strict == 1) throw new IndexException('Empty Map');
				return 0;
			}
			$i = 0;
			reset($this->dat);
			$this->datCntr = 0;
			if (count($this->dat) <= $indx) {
				end($this->dat);
				$this->datCntr = count($this->dat)-1;
				$this->sync();
			}
			else {
				while ($this->datCntr < count($this->dat) && $indx >= $i) {
					$this->Iter();
					$i++;
				}
			}
			return 1;
		}
		/*
		*
		* public function getIndex
		* @parameters none
		*
		*/
		// Returns Map Index
		public function getIndex(): int {
			if ($this->size() > $this->datCntr)
				return $this->datCntr;
			else if ($this->size() <= $this->datCntr) {
				$this->datCntr = 0;
				return $this->datCntr;
			}
			return -1;
		}
		/*
		*
		* public function clear
		* @parameters none
		*
		*/
		// Clears all Map entries
		public function clear(): bool {
			$this->mmap = array();
			return 1;
		}
		/*
		*
		* public function keyIsIn
		* @parameters string
		*
		*/
		// Returns true if Key is in Map
		public function keyIsIn(string $k): int {
			if (count($this->dat) == 0) {
				if ($this->strict == 1) throw new IndexException('Empty Map');
				return 0;
			}
			$tmp = $this->dat;
			reset($tmp);
			$i = 0;
			while ($i < count($this->dat)) {
				if (key($tmp) == $k)
					return $i;
				$i++;
			}
			return -1;
		}
		/*
		*
		* public function equals
		* @parameters Map
		*
		*/
		// Compare Map to $r and Return false is not equal
		public function equals(Map $r): bool {
			if ($r->typeOf != 'Map') {
				throw new Type_Error('Mismatched Types');
				return 0;
			}
			if ($r->size() != $this->size())
				return 0;
			for ($i = 0; $i < $this->size(); $i++) {
				if (!($this->keyIsIn($r[$i])))
					return 0;
			}
			return 1;
		}
		/*
		*
		* public function get
		* @parameters string
		*
		*/
		//  Return Value at Key $k
		public function get(string $k) {
			if ($this->size() == 0) {
				if ($this->strict == 1) throw new IndexException('Empty Map');
				return 0;
			}
			$x = $this->getIndex();
			do {
				if (key($this->dat) == $k)
					return current($this->dat);
			} while ($this->Iter());
			$this->setIndex($x);
			return 0;
		}
		/*
		*
		* public function isEmpty
		* @parameters none
		*
		*/
		// Checks for Empty map
		public function isEmpty(): bool {
			if (count($this->dat) == 0)
				return 1;
			else
				return 0;
		}
		/*
		*
		* public function addAll
		* @parameters string
		*
		*/
		// Add Map of $r dats to current map
		public function addAll(mMap $r): bool {
			if ('NavigableMap' != $r->typeOf && 'SortedMap' != $r->typeOf && 'Map' != $r->typeOf) {
				throw new Type_Error('Mismatched Types');
				return 0;
			}
			do {
				$this->add($r->mname, $r->mmap);
			} while ($r->Iter());
			return 1;
		}
		/*
		*
		* public function remove
		* @parameters string
		*
		*/
		// Remove Key of $k
		public function remove(string $k): bool {
			if ($this->size() == 0) {
				if ($this->strict == 1) throw new IndexException('Empty Map');
				return 0;
			}
			$keys = array_keys($this->dat);
			if (\in_array($k,$keys))
				unset($this->dat["$k"]);
			else
				return 0;
			return 1;
		}
		/*
		*
		* public function replace
		* @parameters string, string
		*
		*/
		// Replace Key of $k with Value of $v
		public function replaceMap(string $k, Map $v): bool {
			if ($this->typeOf != $v->typeOf)
				return 0;
			do {
				if ($this->mname == $k) {
					$this->mmap = $v;
					return 1;
				}
			} while($this->Iter());
			return 1;
		}
		/*
		*
		* public function sync
		* @parameters none
		*
		*/
		public function sync(): bool {
			$this->mmap = current($this->dat);
			$this->mname = key($this->dat);
			$this->pm = $this->datCntr;
			return 1;
		}
	}