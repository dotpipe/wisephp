<?php

namespace wise\src\lib;

require_once '\wise\src\lib\Stack.php';

 class StackTest extends Stack {

	public function testCheckForFunctionsave() 
	{
		$obj = new Stack();
		$testReturn = $obj->save();
	}
	public function testCheckForFunctionloadJSON() 
	{
		$obj = new Stack();
		$testReturn = $obj->loadJSON();
	}
	public function testCheckForFunctionsize() 
	{
		$obj = new Stack();
		$testReturn = $obj->size();
	}
	public function testCheckForFunctionunstack() 
	{
		$obj = new Stack();
		$testReturn = $obj->unstack();
	}
	public function testCheckForFunctionthreadManager() 
	{
		$obj = new Stack();
		$testReturn = $obj->threadManager();
	}
	public function testCheckForFunctioninsert() 
	{
		$obj = new Stack();
		$testReturn = $obj->insert();
	}
	public function testCheckForFunctionclear() 
	{
		$obj = new Stack();
		$testReturn = $obj->clear();
	}
}
?>