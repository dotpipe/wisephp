<?php

namespace Adoms\src\oauth2;

require_once '\Adoms\src\oauth2\userController.php';

 class userControllerTest extends userController
 {
     public function testCheckForFunctionnewUser()
     {
         $obj = new userController();
         $testReturn = $obj->newUser();
     }
     public function testCheckForFunctiondeleteUser()
     {
         $obj = new userController();
         $testReturn = $obj->deleteUser();
     }
     public function testCheckForFunctionnewUserPass()
     {
         $obj = new userController();
         $testReturn = $obj->newUserPass();
     }
     public function testCheckForFunctionlogin()
     {
         $obj = new userController();
         $testReturn = $obj->login();
     }
     public function testCheckForFunctioncheckExpiry()
     {
         $obj = new userController();
         $testReturn = $obj->checkExpiry();
     }
     public function testCheckForFunctionnewUserTokenizer()
     {
         $obj = new userController();
         $testReturn = $obj->newUserTokenizer();
     }
     public function testCheckForFunctionhashPassword()
     {
         $obj = new userController();
         $testReturn = $obj->hashPassword();
     }
     public function testCheckForFunctioncreateTokenizer()
     {
         $obj = new userController();
         $testReturn = $obj->createTokenizer();
     }
     public function testCheckForFunctionlogout()
     {
         $obj = new userController();
         $testReturn = $obj->logout();
     }
 }
