<?php

$app->mount('/', new Controllers\IndexController());
$app->mount('/', new Controllers\SectController());
$app->mount('/', new Controllers\CatdController());
// $app->mount('/user', new Controller\UserController());




$app->match('/galerie', $router_helper('static', ['galerie', 'Galerie Media']));
$app->match('/contact', $router_helper('static', ['contact', 'Contact']));
$app->match('/profesori', $router_helper('profesori'));
$app->match('/profesori/{param}', $router_helper('profesor'));
$app->match('/cont', $router_helper('cont'));
