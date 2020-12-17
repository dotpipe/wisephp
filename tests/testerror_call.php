<?php

namespace wise\src\lib;

require_once '\wise\src\lib\Error_call.php';

 class Error_callTest extends Error_call {

	public function testCheckForFunctionerror_msg() 
	{
		$obj = new Error_call();
		$testReturn = $obj->error_msg();
	}
}
?>