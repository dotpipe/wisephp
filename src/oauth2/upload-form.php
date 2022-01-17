<?php
    namespace src\oauth2;

    require_once(__DIR__."/../../../vendor/autoload.php");

    $crud = new CRUD();
  
   
  	$crud->create([
      	"id" => null,
      	"background" => "somebackground.json",
      	"people" => "somepeople.json",
      	"places" => "locations.json",
      	"things" => "objects.json",
      	"colors" => "rgb.json"
      ], "keywords");
?>