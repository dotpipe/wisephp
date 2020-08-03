<?php

namespace Adoms\src\lib;

require_once '\Adoms\src\lib\IndexException.php';

 class IndexExceptionTest extends IndexException {

	public function testCheckForFunctionerror_msg() 
	{
		$obj = new IndexException();
		$testReturn = $obj->error_msg();
	}
}
?>