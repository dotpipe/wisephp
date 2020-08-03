<?php

namespace Adoms\src\lib;

require_once '\Adoms\src\lib\XML.php';

 class XMLTest extends XML {

	public function testCheckForFunctionnewObj() 
	{
		$obj = new XML();
		$testReturn = $obj->newObj();
	}
	public function testCheckForFunctionxmlIn() 
	{
		$obj = new XML();
		$testReturn = $obj->xmlIn();
	}
	public function testCheckForFunctionxmlOut() 
	{
		$obj = new XML();
		$testReturn = $obj->xmlOut();
	}
	public function testCheckForFunctionsave() 
	{
		$obj = new XML();
		$testReturn = $obj->save();
	}
	public function testCheckForFunctionsize() 
	{
		$obj = new XML();
		$testReturn = $obj->size();
	}
	public function testCheckForFunctionloadJSON() 
	{
		$obj = new XML();
		$testReturn = $obj->loadJSON();
	}
	public function testCheckForFunctioncurrent() 
	{
		$obj = new XML();
		$testReturn = $obj->current();
	}
	public function testCheckForFunctiongetIndex() 
	{
		$obj = new XML();
		$testReturn = $obj->getIndex();
	}
	public function testCheckForFunctionsetIndex() 
	{
		$obj = new XML();
		$testReturn = $obj->setIndex();
	}
	public function testCheckForFunctionIter() 
	{
		$obj = new XML();
		$testReturn = $obj->Iter();
	}
	public function testCheckForFunctionrevIter() 
	{
		$obj = new XML();
		$testReturn = $obj->revIter();
	}
	public function testCheckForFunctionCycle() 
	{
		$obj = new XML();
		$testReturn = $obj->Cycle();
	}
	public function testCheckForFunctionrevCycle() 
	{
		$obj = new XML();
		$testReturn = $obj->revCycle();
	}
	public function testCheckForFunctionsync() 
	{
		$obj = new XML();
		$testReturn = $obj->sync();
	}
}
?>