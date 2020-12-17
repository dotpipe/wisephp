<?php

namespace wise\src\oauth2;

require_once '\wise\src\oauth2\OAuth2Owner.php';

 class OAuth2OwnerTest extends OAuth2Owner {

	public function testCheckForFunctionlogin() 
	{
		$obj = new OAuth2Owner();
		$testReturn = $obj->login();
	}
	public function testCheckForFunctioncheckExpiry() 
	{
		$obj = new OAuth2Owner();
		$testReturn = $obj->checkExpiry();
	}
	public function testCheckForFunctionnewUserTokenizer() 
	{
		$obj = new OAuth2Owner();
		$testReturn = $obj->newUserTokenizer();
	}
	public function testCheckForFunctionhashPassword() 
	{
		$obj = new OAuth2Owner();
		$testReturn = $obj->hashPassword();
	}
	public function testCheckForFunctioncreateTokenizer() 
	{
		$obj = new OAuth2Owner();
		$testReturn = $obj->createTokenizer();
	}
	public function testCheckForFunctionlogout() 
	{
		$obj = new OAuth2Owner();
		$testReturn = $obj->logout();
	}
}
?>