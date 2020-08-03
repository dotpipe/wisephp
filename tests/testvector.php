<?php

namespace Adoms\src\lib;

require_once '\Adoms\src\lib\Vector.php';

 class VectorTest extends Vector {

	public function testCheckForFunctiondestroy() 
	{
		$obj = new Vector();
		$testReturn = $obj->destroy();
	}
	public function testCheckForFunctionconv2vector() 
	{
		$obj = new Vector();
		$testReturn = $obj->conv2vector();
	}
	public function testCheckForFunctionclear() 
	{
		$obj = new Vector();
		$testReturn = $obj->clear();
	}
	public function testCheckForFunctionpush() 
	{
		$obj = new Vector();
		$testReturn = $obj->push();
	}
	public function testCheckForFunctionpop() 
	{
		$obj = new Vector();
		$testReturn = $obj->pop();
	}
	public function testCheckForFunctionadd() 
	{
		$obj = new Vector();
		$testReturn = $obj->add();
	}
	public function testCheckForFunctionat() 
	{
		$obj = new Vector();
		$testReturn = $obj->at();
	}
	public function testCheckForFunctioninsVect() 
	{
		$obj = new Vector();
		$testReturn = $obj->insVect();
	}
	public function testCheckForFunctionremVect() 
	{
		$obj = new Vector();
		$testReturn = $obj->remVect();
	}
	public function testCheckForFunctionsave() 
	{
		$obj = new Vector();
		$testReturn = $obj->save();
	}
	public function testCheckForFunctionsize() 
	{
		$obj = new Vector();
		$testReturn = $obj->size();
	}
	public function testCheckForFunctionloadJSON() 
	{
		$obj = new Vector();
		$testReturn = $obj->loadJSON();
	}
	public function testCheckForFunctioncurrent() 
	{
		$obj = new Vector();
		$testReturn = $obj->current();
	}
	public function testCheckForFunctiongetIndex() 
	{
		$obj = new Vector();
		$testReturn = $obj->getIndex();
	}
	public function testCheckForFunctionsetIndex() 
	{
		$obj = new Vector();
		$testReturn = $obj->setIndex();
	}
	public function testCheckForFunctionIter() 
	{
		$obj = new Vector();
		$testReturn = $obj->Iter();
	}
	public function testCheckForFunctionrevIter() 
	{
		$obj = new Vector();
		$testReturn = $obj->revIter();
	}
	public function testCheckForFunctionCycle() 
	{
		$obj = new Vector();
		$testReturn = $obj->Cycle();
	}
	public function testCheckForFunctionrevCycle() 
	{
		$obj = new Vector();
		$testReturn = $obj->revCycle();
	}
	public function testCheckForFunctionsync() 
	{
		$obj = new Vector();
		$testReturn = $obj->sync();
	}
}
?>