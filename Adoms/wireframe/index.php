<?php
namespace Adoms\wireframe;
spl_autoload_register(function ($className)
{
	$path1 = 'Adoms/wireframe/';
	$path2 = '';

	if (file_exists($path1.$className.'.php'))
		include $path1.$className.'.php';
	else
		include $path2.$className.'.php';
});
    $y = array("Address" => "BenSt", "Duration" => "fixed");
    $z = array("Address" => "25th", "Duration" => "limited");
    $x = new PageControllers("adp");
    $x->newView("index");
    $x->newView("BestPHPEverNow");
    $x->mvc['index']->addModelField("Address");
    $x->mvc['index']->addModelValid("Address",'/.*/');
    $x->mvc['index']->addModelValid("Duration",'/.*/');
    $x->mvc['index']->addModelData('index', $y);
    
    $x->mvc['index']->view->addPartial("index.php");
    $x->mvc['BestPHPEverNow']->view->addPartial("index.php");
    $x->mvc['BestPHPEverNow']->view->addShared("index.php");
    $x->mvc['BestPHPEverNow']->addModelValid("Address",'/1.*/', "Please ask the admin to help you!");
    $x->mvc['BestPHPEverNow']->addModelValid("Duration",'/.*/');
    $x->mvc['BestPHPEverNow']->addModelData('index', $y);
    $x->mvc['BestPHPEverNow']->addModelData('friends', $z);
    $x->paginateModels('index', 'index.php',0,3);
    $x->mvc['BestPHPEverNow']->view->removeDependency("shared","index.php");
    $x->mvc['index']->view->writePage("index");
    $x->save();
    $x = $x->loadJSON();
    echo json_encode($x);
    $x->mvc['index']->view->createAction("TestAction/TestModule/TestFilter");
    
    echo "<br><br><br>";
    echo json_encode($x);
