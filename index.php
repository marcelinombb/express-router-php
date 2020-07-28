<?php
require_once("vendor/autoload.php");

use express_php\ExpressPHP;

$expressPHP = new ExpressPHP("App/controllers");
$expressPHP->get("/", "TestController@home");
$expressPHP->post("/login", "TestController@login");
$expressPHP->get("/logout", "TestController@logout");