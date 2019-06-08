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


	// Pointer in this is $this->mx
	class Matrix implements Classes {
		public $parentType;
		public $childType;
		// Pointer to current Index
		public $mx;
		// $mx[$datCntr] (The index pointed to)
		private $datCnt = 0;
		public $dat = array();
		public $pv;

		public function __construct($type, $child = "String") {
			$this->rootType = 'Container';
			$this->parentType = 'Matrix';

			if ($type == 'Dequeue') {
				$this->dat[] = new Dequeue();
				$this->childType = 'Dequeue';
				$this->parentType = 'Matrix';
			}
			else if ($type == 'Queue') {
				$this->dat[] = new Queue();
				$this->childType = 'Queue';
				$this->parentType = 'Matrix';
			}
			else if ($type == 'Set') {
				$this->dat[] = new Set();
				$this->childType = 'Set';
				$this->parentType = 'Matrix';
			}
			else if ($type == 'SortedSet') {
				$this->dat[] = new SortedSet();
				$this->childType = 'SortedSet';
				$this->parentType = 'Matrix';
			}
			else if ($type == 'NavigableSet') {
				$this->dat[] = new NavigableSet();
				$this->childType = 'NavigableSet';
				$this->parentType = 'Matrix';
			}
			else if ($type == 'Map') {
				$this->dat[] = new Map();
				$this->childType = 'Map';
				$this->parentType = 'Matrix';
			}
			else if ($type == 'SortedMap') {
				$this->dat[] = new SortedMap();
				$this->childType = 'SortedMap';
				$this->parentType = 'Matrix';
			}
			else if ($type == 'NavigableMap') {
				$this->dat[] = new Navigablemap();
				$this->childType = 'NavigableMap';
				$this->parentType = 'Matrix';
			}
			else if ($type == 'mMap') {
				$this->dat[] = new mMap();
				$this->childType = 'mMap';
				$this->parentType = 'Matrix';
			}
			else if ($type == 'Stack') {
				$this->dat[] = new Stack();
				$this->childType = 'Stack';
				$this->parentType = 'Matrix';
			}
			else if ($type == 'Thread') {
				$this->dat[] = new Thread();
				$this->childType = 'Thread';
				$this->parentType = 'Matrix';
			}
			else if ($type == 'Any') {
				$this->childType = 'Any';
				$this->parentType = 'Matrix';
			}
			else if ($type == 'Array') {
				$this->childType = 'Array';
				$this->parentType = 'Matrix';
			}
			else if ($type == 'String') {
				$this->childType = 'String';
				$this->parentType = 'Matrix';
			}
			else if ($type == 'Vector') {
				$this->dat[] = new Vector($child);
				$this->childType = $child;
				$this->parentType = 'Vector';
			}
			else {
				throw new Type_Error('Invalid Type');
				return 0;
			}
			$this->typeOf = $type;
			$this->dat = array();
			return 1;
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
		* public function table
		* @parameters string, array, string
		*
		*/
		public function table(string $classId = "", array $tdId, string $thId = ""): string
		{
			$cid = "";
			$h = 0;
			$g = 0;
			if (strlen($thId) > 0)
				$g += 2;
			if ($classId == "")
				$h = 0;
			else if (strlen($classId) > 0 && ($classId[0] == "\"" || $classId[0] == "\'"))
				$h = 2;
			else if (strlen($classId) > 0 && ($classId[0] == "." || $classId[0] == "#"))
				$h = 1;
			else if (strlen($classId) > 0)
				return $html = "Class or Id Unidentified";
			if ($h > 0)
				for ($i = $h; $i < strlen($classId)-($h-1); $i++)
					$cid .= $classId[$i];
			$html = "";
			if ($classId == "")
				$html = '<table>';
			else if ($classId[0] == "#" || $classId[1] == "#")
				$html = '<table id=' . $cid .'>'; //$classId.substr(2,strlen($classId)-) . '\">';
			else if ($classId[0] == "." || $classId[0] == ".")
				$html = '<table class=' . $cid .'>'; //$classId.substr(2,strlen($classId)-2) . '\">';
			$table = $this->dat;
			foreach ($table as $xm) {
				if ($xm == null)
					return 'NULL ENTRIES IN MATRIX';
				if ($xm->parentType == "Matrix" || $xm->childType == 'Map' || $xm->childType == 'mMap'
					 || $xm->childType == 'SortedMap' || $xm->childType == 'NavigableMap')
					return 'MATRIX & MAP TYPES ARE ILLEGAL IN SYNTAX';
			}
			$table = $this->mx;
			if (is_object($table))
				$table = $table->dat;
			$html .= '<tr>';
			$w = 0;
			if (is_object($table) || is_array($table))
				$w = sizeof($table);
			for ($i = 0; $i < $w; $i++) {
				$y = '';
				$k = 0;
				$y = $table[$i];
				if (is_object($y))
					$y = $y->dat[$i];
				if (is_object($y)) {
					foreach ($y->dat as $mm) {
						$m .= $mm;
						if ($k + 1 < $y->size()) $m .= ', ';
						$k++;
					}
				}
				else if (is_array($y)) {
					foreach ($y as $mm) {
						$m .= $mm;
						if ($k + 1 < sizeof($y)) $m .= ', ';
						$k++;
					}
				}
				else	$m = $y;
				if ($g == 2 || $g == 3)
					$html .= "<th id=" . $thId . ">" . $m . "</th>";
				else
					$html .= "<th>" . $m . "</th>";
			}
			$html .= '</tr>';
			$mcnt = array();
			$tab = array();
			for ($i = 1; $i < sizeof($this->dat); $i++)
				$tab[] = $this->dat[$i];
			$e = 0;
			for ($i = 0; $i < sizeof($tab); $i++) {
				if ($g == 1 || $g == 3)
					$html .= '<tr style=' . $tdId[$i%sizeof($tdId)] . '>';
				else
					$html .= '<tr>';
				$ta = $tab[$i];
				if (is_object($ta))
					$ta = $ta->dat;
				else if (!is_array($ta) && $i + 1 == sizeof($tab)) {
					$html .= '<td style="' . $tdId[$i%sizeof($tdId)] . '">' . $ta . '</td></tr>';
					break;
				}
				else if (!is_array($ta)) {
					$html .= '<td style="' . $tdId[$i%sizeof($tdId)] . '">' . $ta . '</td></tr>';
				}
				if (is_array($ta)) {
					foreach ($ta as $y) {
						$k = 0;
						if (is_array($y)) {
							$m = '';
							foreach($y as $mm) {
								$m .= $mm;
								if ($k + 1 < sizeof($y)) $m .= ', ';
								$k++;
							}
							$html .= '<td>' . $m . '</td>';
						}
						else if (is_object($y)) {
							$m = '';
							foreach($y->dat as $mm) {
								$m .= $mm;
								if ($k + 1 < $y->size()) $m .= ', ';
								$k++;
							}
						}
						else {
							if (sizeof($tdId) > 0)
								$html .= '<td style="' . $tdId[$i%sizeof($tdId)] . '">' . $y . '</td>';
							else
								$html .= '<td>' . $y . '</td>';
						}
					}
					$html .= '</tr>';
					$e++;
				}
			}
			$html .= '</table>';
			return $html;
		}

		/*
		*
		* public function rem
		* @parameters int
		*
		*/
		// Remove $r from Matrix
		public function rem(int $r): bool {
			if ($this->size() == 1) {
				$this->dat = null;
				$this->setIndex($this->getIndex());
				return 1;
			}
			if ($this->size() == 0 || $this->size() <= $r || $r < 0) {
				if ($this->strict == 1) throw new IndexException('Empty Matrix Array');
				return 0;
			}
			$temporneous = array();

			for ($i = 0; $i < $this->size(); $i++) {
				if ($i != $r)
					$temporneous[] = $this->dat[$i];
			}
			$this->setIndex($this->getIndex());
			return $this->dat = $temporneous;
		}

		/*
		*
		* public function hasNext
		* @parameters none
		*
		*/
		// Returns true if Matrix has next Element
		public function hasNext(): bool {
			if ($this->size() == 0) {
				if ($this->strict == 1) throw new IndexException('Empty Matrix Array');
				return 0;
			}
			if ($this->getIndex()+1 < $this->size())
				return 1;
			return 0;
		}

		/*
		*
		* public function next
		* @parameters none
		*
		*/
		// Iterate once forward through Vector
		public function next(): bool {
			if ($this->hasNext() == 1) {
				$this->cntIncr();
				$this->join();
				return 1;
			}
			else if ($this->size() == 1) {
				$this->setIndex(0);
				$this->join();
				return 0;
			}
			else if ($this->size() == 0) {
				if ($this->strict == 1) throw new IndexException('Empty Matrix Array');
				$this->setIndex(0);
				$this->mx = null;
				return 0;
			}
		}

		/*
		*
		* public function Iter
		* @parameters none
		*
		*/
		// Iterate Forward through Vector
		public function Iter(): bool {
			if ($this->size() == 0) {
				if ($this->strict == 1) throw new IndexException('Empty Matrix Array');
				return 0;
			}
			if ($this->hasNext() == 1) {
				$this->next();
				$this->join();
				return 1;
			}
			else {
				$this->join();
				return 0;
			}
			return 1;
		}

		/*
		*
		* public function Cycle
		* @parameters none
		*
		*/
		// Cycle Forward through Vector
		public function Cycle(): bool {
			if ($this->size() == 0) {
				if ($this->strict == 1) throw new IndexException('Empty Matrix Array');
				return 0;
			}
			if ($this->hasNext() == 1) {
				$this->next();
				$this->join();
				return 1;
			}
			else {
				$this->setIndex(0);
				$this->join(0);
				return 0;
			}
			return 1;
		}

		/*
		*
		* public function revIter
		* @parameters none
		*
		*/
		// Iterate Forward through Vector
		public function revIter(): bool {
			if ($this->size() == 0) {
				if ($this->strict == 1) throw new IndexException('Empty Matrix Array');
				return 0;
			}
			if ($this->hasPrev() == 1) {
				$this->prev();
				$this->join();
				return 1;
			}
			else {
				$this->join();
				return 0;
			}
			return 1;
		}

		/*
		*
		* public function revCycle
		* @parameters none
		*
		*/
		public function revCycle(): bool {
			if ($this->size() == 0) {
				if ($this->strict == 1) throw new IndexException('Empty Matrix Array');
				return 0;
			}
			if ($this->hasPrev() == 1) {
				$this->prev();
				$this->join();
				return 1;
			}
			else {
				$this->setIndex($this->size()-1);
				$this->join();
				return 0;
			}
			return 1;
		}

		/*
		*
		* public function hasPrev
		* @parameters none
		*
		*/
		// Return true if Previous Vector exists
		public function hasPrev(): bool {
			if ($this->size() == 0) {
				if ($this->strict == 1) throw new IndexException('Empty Matrix Array');
				return 0;
			}
			if ($this->getIndex() - 1 > 0)
				return 1;
			return 0;
		}

		/*
		*
		* public function prev8
		* @parameters none
		*
		*/
		// Iterate to Previous Vector if $bool = 1;
		// Setup $cntDecr (index) for Prev. Vector if $bool = 0;
		public function prev(): bool {
			if ($this->hasPrev() == 1) {
				$this->cntDecr();
				$this->join();
				return 1;
			}
			else if ($this->size() == 1) {
				$this->setIndex(0);
				$this->join();
				return 0;
			}
			else if ($this->size() == 0) {
				if ($this->strict == 1) throw new IndexException('Empty Matrix Array');
				$this->setIndex(0);
				$this->mx = null;
				return 0;
			}
		}

		/*
		*
		* public function current8
		* @parameters none
		*
		*/
		// Retrieve current Index of Vector Pointer
		public function current(): int {
			return $this->getIndex();
		}

		/*
		*
		* public function cntIncr
		* @parameters none
		*
		*/
		// Increment datCntr (index)
		private function cntIncr(): int {
			$this->sync();
			next($this->dat);
			return ++$this->datCnt;
		}

		/*
		*
		* public function cntDecr
		* @parameters none
		*
		*/
		// Decrement datCntr (index)
		private function cntDecr(): int {
			$this->sync();
			prev($this->dat);
			return --$this->datCnt;
		}

		/*
		*
		* public function getIndex
		* @parameters none
		*
		*/
		// Get Index
		public function getIndex(): int {
			return $this->datCnt;
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
				if ($this->strict == 1) throw new IndexException('Empty Matrix');
				return 0;
			}
			if ($this->sIndex($indx)) {
				$this->join();
				return 1;
			}
			return 0;
		}

		/*
		*
		* public function destroy
		* @parameters none
		*
		*/
		public function destroy(): bool {
			$this->vectorTemp = null;
			$this->parentType = null;
			$this->childType = null;
			$this->dat = null;
			return 1;
		}

		/*
		*
		* public function clear
		* @parameters none
		*
		*/
		public function clear(): bool {
			$this->dat = array();
			return 1;
		}

		/*
		*
		* public function size
		* @parameters none
		*
		*/
		// Report Size of Container
		public function size(): int {
			if (sizeof($this->dat) >= 0)
				return sizeof($this->dat);
			else return 0;
		}

		/*
		*
		* public function push
		* @parameters mixed
		*
		*/
		// Add Vector with $r and Join if $bool == 1
		public function push($r): bool {
			if ($this->childType == 'String' && !is_object($r))
				$this->dat[] = $r;
			else if ($this->childType == 'Any' || $this->childType == $r->childType
				|| ($this->childType == 'Array' && is_array($r)))
				$this->dat[] = $r;
			else {
				throw new Type_Error('Invalid Type');
				return 0;
			}
			if ($this->size() == 1)
				$this->Iter();
			return 1;
		}

		/*
		*
		* public function pop
		* @parameters none
		*
		*/
		// Remove $r from Vector
		public function pop(): int {
			if ($this->size() == 1)
				$this->dat = null;
			if ($this->size() == 0) {
				if ($this->strict == 1) throw new IndexException('Empty Matrix Array');
				return 0;
			}
			$temporneous = array();

			for ($i = 0; $i < $this->size()-1; $i++) {
				$temporneous[] = $this->dat[$i];
			}
			$this->setIndex($this->getIndex());
			return $this->dat = $temporneous;
		}

		/*
		*
		* public function sIndex
		* @parameters int
		*
		*/
		// Set new Index
		private function sIndex(int $indx): int {
			if ($this->size() == 0 || $this->size() <= $indx) {
				$this->datCnt = -1;
				$this->mx = null;
				throw new IndexException('Invalid Index');
				return 0;
			}
			if ($indx < $this->size() && $indx >= 0) {
				reset($this->dat);
				for ($i = 0 ; $i < $indx ; $i++)
					next($this->dat);
				return $this->datCnt = $indx;
			}
		}

		/*
		*
		* public function at
		* @parameters int
		*
		*/
		// Return Vector at $indx
		public function at(int $indx) {
			if ($this->size() == 0) {
				if ($this->strict == 1) throw new IndexException('Empty Vector Array');
				return 0;
			}
			$temp = array();
			if ($indx < $this->size() && $indx >= 0) {
				$temp = $this->dat[$indx];
				return $temp;
			}
			return -1;
		}

		/*
		*
		* public function sync
		* @parameters none
		*
		*/
		public function sync(): bool {
			if ($this->pv >= 0 && $this->pv < $this->size()) {	
				if ($this->mx != null && $this->datCnt != $this->pv)
					$this->dat[$this->pv] = $this->mx;
			}
			if ($this->datCnt >= $this->size() || $this->datCnt <= 0) {
				$this->datCntr = 0;
				$this->pv = 0;
				$this->mx = array();
				return 1;
			}
			else if ($this->datCnt < $this->size() && $this->datCnt > 0) {
				$this->sIndex($this->datCnt);
				$this->mx = $this->dat[$this->datCnt];
				$this->pv = $this->datCnt;
				return 1;
			}
			return 0;
		}

		/*
		*
		* public function join
		* @parameters none
		*
		*/
		// Point Vector to getIndex()
		public function join(): bool {
			if ($this->size() == 0) {
				$this->mx = null;
				if ($this->strict == 1) throw new IndexException('Empty Matrix Array');
				return 0;
			}
			if ($this->size() == 1)
				$this->setIndex(0);
			else if ($this->getIndex() == 0 || $this->getIndex() >= $this->size())
				$this->sIndex($this->size()-1);

			$this->sync();
			return 1;
		}

		/*
		*
		* public function add
		* @parameters mixed, int, int
		*
		*/
		// $indx = row
		public function add($r, int $indx = -1, int $col = -1): bool {
			$this->sync();
			if ($indx == -1 || $indx > $this->size()-1)
				$indx = $this->size()-1;
			if ($col == -1 || $col > sizeof($this->dat))
				$col = sizeof($this->dat)-1;
			$setTemp = '';
			if ($this->size() == 0) {
				$this->dat[] = $r;
				return 1;
			}
			if ($indx < 0) {
				throw new IndexException('Invalid Index');
				return 0;
			}
			if (!is_object($r) && !is_array($r) || $r->childType == $this->typeOf) {
				$t = array();
			
				for ($x = 0 ; $x < $indx ; $x++) {
					$t[] = $this->dat[$x];
					for ($y = 0 ; $y < $col ; $y++)
						$t[$x][] = $this->dat[$x][$y];
				}
				for ($x = 0 ; $x < $col ; $x++)
					$t[$indx][$x] = $this->dat[$indx][$x];
				$t = $this->mx;
				$t[$indx][$col] = $r;
			
				for ($x = $col+1 ; $x < sizeof($this->dat[$indx]) ; $x++)
					$t[$indx][$x] = $this->dat[$indx][$x];
				for ($x = $indx + 1 ; $x < $this->size() ; $x++) {
					$t[] = $this->dat[$x];
					for ($y = 0 ; $y < sizeof($this->dat[$x]) ; $y++)
						$t[$x][] = $this->dat[$x][$y];
				}
			
				$this->dat = $t;
			}
			else return 0;
			
			return 1;
		}

		/*
		*
		* public function grow
		* @parameters int
		*
		*/
		public function grow(int $r): bool {
			if ($r < 1)
				return 0;
			for ($x = 0 ; $x < $r ; $x++)
				$this->dat[] = newObj($this->childType, 'String');
			return 1;
		}

		/*
		*
		* public function shrink
		* @parameters int
		*
		*/
		public function shrink(int $r): bool {
			if ($r < 1 || $r > $this->size())
				return 0;
			$t = array();
			for ($x = 0 ; $x < $r ; $x++)
				$this->pop();
			return 1;
		}
			
	}
?>