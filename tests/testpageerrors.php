<?php

namespace wise\src\wireframe;

require_once '\wise\src\wireframe\PageErrors.php';

 class PageErrorsTest extends PageErrors {

	public function testCheckForFunctionmissingFile() 
	{
		$obj = new PageErrors();
		$testReturn = $obj->missingFile();
	}
	public function testCheckForFunctionerrorByCode() 
	{
		$obj = new PageErrors();
		$testReturn = $obj->errorByCode();
	}
}
?>