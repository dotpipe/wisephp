<?php

namespace Adoms\src\wireframe;

require_once '\Adoms\src\wireframe\PageViews.php';

 class PageViewsTest extends PageViews
 {
     public function testCheckForFunctionaddPartial()
     {
         $obj = new PageViews();
         $testReturn = $obj->addPartial();
     }
     public function testCheckForFunctionaddShared()
     {
         $obj = new PageViews();
         $testReturn = $obj->addShared();
     }
     public function testCheckForFunctionsave()
     {
         $obj = new PageViews();
         $testReturn = $obj->save();
     }
     public function testCheckForFunctionloadThisJSON()
     {
         $obj = new PageViews();
         $testReturn = $obj->loadThisJSON();
     }
     public function testCheckForFunctionis_session_started()
     {
         $obj = new PageViews();
         $testReturn = $obj->is_session_started();
     }
     public function testCheckForFunctionconfigPageWrite()
     {
         $obj = new PageViews();
         $testReturn = $obj->configPageWrite();
     }
     public function testCheckForFunctionwritePage()
     {
         $obj = new PageViews();
         $testReturn = $obj->writePage();
     }
     public function testCheckForFunctionremoveDependency()
     {
         $obj = new PageViews();
         $testReturn = $obj->removeDependency();
     }
     public function testCheckForFunctioncreateAction()
     {
         $obj = new PageViews();
         $testReturn = $obj->createAction();
     }
 }
