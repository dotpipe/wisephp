<?php

namespace Adoms;

require_once '\Adoms\Routes.php';

 class RoutesTest extends Routes {

	public function testCheckForFunctionaddContract() 
	{
		$obj = new Routes();
		$testReturn = $obj->addContract();
	}
	public function testCheckForFunctionaddUserToContract() 
	{
		$obj = new Routes();
		$testReturn = $obj->addUserToContract();
	}
	public function testCheckForFunctionremContract() 
	{
		$obj = new Routes();
		$testReturn = $obj->remContract();
	}
	public function testCheckForFunctionremUserFromContract() 
	{
		$obj = new Routes();
		$testReturn = $obj->remUserFromContract();
	}
	public function testCheckForFunctiongetContract() 
	{
		$obj = new Routes();
		$testReturn = $obj->getContract();
	}
	public function testCheckForFunctionhttp_parse_query() 
	{
		$obj = new Routes();
		$testReturn = $obj->http_parse_query();
	}
	public function testCheckForFunctionroute() 
	{
		$obj = new Routes();
		$testReturn = $obj->route();
	}
	public function testCheckForFunctionreqHeaders() 
	{
		$obj = new Routes();
		$testReturn = $obj->reqHeaders();
	}
	public function testCheckForFunctionresHeaders() 
	{
		$obj = new Routes();
		$testReturn = $obj->resHeaders();
	}
	public function testCheckForFunctionsave() 
	{
		$obj = new Routes();
		$testReturn = $obj->save();
	}
	public function testCheckForFunctionload() 
	{
		$obj = new Routes();
		$testReturn = $obj->load();
	}
}
?>