<?php

namespace ;

require_once '\ComposerAutoloaderInit3ed9eb479d75e9d10114e64ba1b7b783.php';

 class ComposerAutoloaderInit3ed9eb479d75e9d10114e64ba1b7b783Test extends ComposerAutoloaderInit3ed9eb479d75e9d10114e64ba1b7b783 {

	public function testCheckForFunctionloadClassLoader() 
	{
		$obj = new ComposerAutoloaderInit3ed9eb479d75e9d10114e64ba1b7b783();
		$testReturn = $obj->loadClassLoader();
	}
	public function testCheckForFunctiongetLoader() 
	{
		$obj = new ComposerAutoloaderInit3ed9eb479d75e9d10114e64ba1b7b783();
		$testReturn = $obj->getLoader();
	}
}
?>