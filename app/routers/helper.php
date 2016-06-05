<?php

$router_helper = function($type, $data){
    global $router;
    //Acesta este helperul care face legătura dintre cotrollere și routere
    return function()use($router, $type, $data){
        return $router[$type]($data);
    };
};
