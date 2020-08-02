<?php
require_once("vendor/autoload.php");

use express_php\ExpressPHP;

//informe o diretorio de suas controllers no construtor 
$expressPHP = new ExpressPHP("App/controllers");

$expressPHP->get("/", "TestController@home");
$expressPHP->post("/login", "TestController@login");
$expressPHP->get("/logout", "TestController@logout");
