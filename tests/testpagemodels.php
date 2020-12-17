<?php

namespace wise\src\wireframe;

require_once '\wise\src\wireframe\PageModels.php';

 class PageModelsTest extends PageModels {

	public function testCheckForFunction___construct() 
	{
		$obj = new PageModels();
		$testReturn = $obj->___construct();
	}
	public function testCheckForFunctionaddModelField() 
	{
		$obj = new PageModels();
		$testReturn = $obj->addModelField();
	}
	public function testCheckForFunctioneditModelData() 
	{
		$obj = new PageModels();
		$testReturn = $obj->editModelData();
	}
	public function testCheckForFunctionaddModelData() 
	{
		$obj = new PageModels();
		$testReturn = $obj->addModelData();
	}
	public function testCheckForFunctionpaginateModels() 
	{
		$obj = new PageModels();
		$testReturn = $obj->paginateModels();
	}
	public function testCheckForFunctionaddModelValid() 
	{
		$obj = new PageModels();
		$testReturn = $obj->addModelValid();
	}
	public function testCheckForFunctioncheckValid() 
	{
		$obj = new PageModels();
		$testReturn = $obj->checkValid();
	}
}
?>