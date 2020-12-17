<?php

namespace wise\src\lib;

require_once '\wise\src\lib\Type_Error.php';

 class Type_ErrorTest extends Type_Error {

	public function testCheckForFunctionerror_msg() 
	{
		$obj = new Type_Error();
		$testReturn = $obj->error_msg();
	}
}
?>