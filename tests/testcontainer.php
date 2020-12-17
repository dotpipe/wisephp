<?php

namespace wise\src\lib;

require_once '\wise\src\lib\Container.php';

 class ContainerTest extends Container {

	public function testCheckForFunctionuse_strict() 
	{
		$obj = new Container();
		$testReturn = $obj->use_strict();
	}
}
?>