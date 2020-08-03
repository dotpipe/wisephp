<?php

namespace Adoms\src\lib;

require_once '\Adoms\src\lib\NavigableSet.php';

 class NavigableSetTest extends NavigableSet {

	public function testCheckForFunctiondestroy() 
	{
		$obj = new NavigableSet();
		$testReturn = $obj->destroy();
	}
	public function testCheckForFunctionceiling() 
	{
		$obj = new NavigableSet();
		$testReturn = $obj->ceiling();
	}
	public function testCheckForFunctionfloor() 
	{
		$obj = new NavigableSet();
		$testReturn = $obj->floor();
	}
	public function testCheckForFunctionpollFirst() 
	{
		$obj = new NavigableSet();
		$testReturn = $obj->pollFirst();
	}
	public function testCheckForFunctionpollLast() 
	{
		$obj = new NavigableSet();
		$testReturn = $obj->pollLast();
	}
	public function testCheckForFunctionheadSet() 
	{
		$obj = new NavigableSet();
		$testReturn = $obj->headSet();
	}
	public function testCheckForFunctionfirst() 
	{
		$obj = new NavigableSet();
		$testReturn = $obj->first();
	}
	public function testCheckForFunctionlast() 
	{
		$obj = new NavigableSet();
		$testReturn = $obj->last();
	}
	public function testCheckForFunctionsubSet() 
	{
		$obj = new NavigableSet();
		$testReturn = $obj->subSet();
	}
	public function testCheckForFunctionsave() 
	{
		$obj = new NavigableSet();
		$testReturn = $obj->save();
	}
	public function testCheckForFunctionloadJSON() 
	{
		$obj = new NavigableSet();
		$testReturn = $obj->loadJSON();
	}
	public function testCheckForFunctionsize() 
	{
		$obj = new NavigableSet();
		$testReturn = $obj->size();
	}
	public function testCheckForFunctionaddAll() 
	{
		$obj = new NavigableSet();
		$testReturn = $obj->addAll();
	}
	public function testCheckForFunctionclear() 
	{
		$obj = new NavigableSet();
		$testReturn = $obj->clear();
	}
	public function testCheckForFunctionadd() 
	{
		$obj = new NavigableSet();
		$testReturn = $obj->add();
	}
	public function testCheckForFunctionvalIsIn() 
	{
		$obj = new NavigableSet();
		$testReturn = $obj->valIsIn();
	}
	public function testCheckForFunctioncompare() 
	{
		$obj = new NavigableSet();
		$testReturn = $obj->compare();
	}
	public function testCheckForFunctionget() 
	{
		$obj = new NavigableSet();
		$testReturn = $obj->get();
	}
	public function testCheckForFunctionexists() 
	{
		$obj = new NavigableSet();
		$testReturn = $obj->exists();
	}
	public function testCheckForFunctionremIndex() 
	{
		$obj = new NavigableSet();
		$testReturn = $obj->remIndex();
	}
	public function testCheckForFunctionremValue() 
	{
		$obj = new NavigableSet();
		$testReturn = $obj->remValue();
	}
	public function testCheckForFunctioncurrent() 
	{
		$obj = new NavigableSet();
		$testReturn = $obj->current();
	}
	public function testCheckForFunctiongetIndex() 
	{
		$obj = new NavigableSet();
		$testReturn = $obj->getIndex();
	}
	public function testCheckForFunctionsetIndex() 
	{
		$obj = new NavigableSet();
		$testReturn = $obj->setIndex();
	}
	public function testCheckForFunctionIter() 
	{
		$obj = new NavigableSet();
		$testReturn = $obj->Iter();
	}
	public function testCheckForFunctionrevIter() 
	{
		$obj = new NavigableSet();
		$testReturn = $obj->revIter();
	}
	public function testCheckForFunctionCycle() 
	{
		$obj = new NavigableSet();
		$testReturn = $obj->Cycle();
	}
	public function testCheckForFunctionrevCycle() 
	{
		$obj = new NavigableSet();
		$testReturn = $obj->revCycle();
	}
	public function testCheckForFunctionsync() 
	{
		$obj = new NavigableSet();
		$testReturn = $obj->sync();
	}
}
?>