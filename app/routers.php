<?php

$app->mount('/', new Controllers\IndexController());
$app->mount('/', new Controllers\SectController());
$app->mount('/', new Controllers\CatdController());
$app->mount('/prof', new Controllers\ProfController());
$app->mount('/cont', new Controllers\UserController());
$app->mount('/ajax', new Controllers\AjaxController());
// $app->mount('/user', new Controller\UserController());



//Needed to recover:
/*
$app->match('/galerie', $router_helper('static', ['galerie', 'Galerie Media']));
$app->match('/contact', $router_helper('static', ['contact', 'Contact']));
$app->match('/profesori', $router_helper('profesori'));
$app->match('/profesori/{param}', $router_helper('profesor'));
*/

// $app->match('/cont', $router_helper('cont'));
