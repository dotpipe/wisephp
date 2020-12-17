<?php

namespace wise\src\lib;

require_once '\wise\src\lib\Matrix.php';

 class MatrixTest extends Matrix {

	public function testCheckForFunctionsave() 
	{
		$obj = new Matrix();
		$testReturn = $obj->save();
	}
	public function testCheckForFunctionloadJSON() 
	{
		$obj = new Matrix();
		$testReturn = $obj->loadJSON();
	}
	public function testCheckForFunctiontable() 
	{
		$obj = new Matrix();
		$testReturn = $obj->table();
	}
	public function testCheckForFunctionrem() 
	{
		$obj = new Matrix();
		$testReturn = $obj->rem();
	}
	public function testCheckForFunctionhasNext() 
	{
		$obj = new Matrix();
		$testReturn = $obj->hasNext();
	}
	public function testCheckForFunctionnext() 
	{
		$obj = new Matrix();
		$testReturn = $obj->next();
	}
	public function testCheckForFunctionIter() 
	{
		$obj = new Matrix();
		$testReturn = $obj->Iter();
	}
	public function testCheckForFunctionCycle() 
	{
		$obj = new Matrix();
		$testReturn = $obj->Cycle();
	}
	public function testCheckForFunctionrevIter() 
	{
		$obj = new Matrix();
		$testReturn = $obj->revIter();
	}
	public function testCheckForFunctionrevCycle() 
	{
		$obj = new Matrix();
		$testReturn = $obj->revCycle();
	}
	public function testCheckForFunctionhasPrev() 
	{
		$obj = new Matrix();
		$testReturn = $obj->hasPrev();
	}
	public function testCheckForFunctionprev() 
	{
		$obj = new Matrix();
		$testReturn = $obj->prev();
	}
	public function testCheckForFunctioncurrent() 
	{
		$obj = new Matrix();
		$testReturn = $obj->current();
	}
	public function testCheckForFunctiongetIndex() 
	{
		$obj = new Matrix();
		$testReturn = $obj->getIndex();
	}
	public function testCheckForFunctionsetIndex() 
	{
		$obj = new Matrix();
		$testReturn = $obj->setIndex();
	}
	public function testCheckForFunctiondestroy() 
	{
		$obj = new Matrix();
		$testReturn = $obj->destroy();
	}
	public function testCheckForFunctionclear() 
	{
		$obj = new Matrix();
		$testReturn = $obj->clear();
	}
	public function testCheckForFunctionsize() 
	{
		$obj = new Matrix();
		$testReturn = $obj->size();
	}
	public function testCheckForFunctionpush() 
	{
		$obj = new Matrix();
		$testReturn = $obj->push();
	}
	public function testCheckForFunctionpop() 
	{
		$obj = new Matrix();
		$testReturn = $obj->pop();
	}
	public function testCheckForFunctionat() 
	{
		$obj = new Matrix();
		$testReturn = $obj->at();
	}
	public function testCheckForFunctionsync() 
	{
		$obj = new Matrix();
		$testReturn = $obj->sync();
	}
	public function testCheckForFunctionjoin() 
	{
		$obj = new Matrix();
		$testReturn = $obj->join();
	}
	public function testCheckForFunctionadd() 
	{
		$obj = new Matrix();
		$testReturn = $obj->add();
	}
	public function testCheckForFunctiongrow() 
	{
		$obj = new Matrix();
		$testReturn = $obj->grow();
	}
	public function testCheckForFunctionshrink() 
	{
		$obj = new Matrix();
		$testReturn = $obj->shrink();
	}
}
?>