<?php
require_once("vendor/autoload.php");

use express_php\ExpressPHP;

//informe o diretorio de suas controllers no construtor 
$expressPHP = new ExpressPHP("App/controllers");

ExpressPHP::get("/", "TestController@home");
ExpressPHP::post("/login", "TestController@login");
ExpressPHP::get("/logout", "TestController@logout");
