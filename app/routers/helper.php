<?php

$router_helper = function($type, $data=[]){
    global $router;
    //Acesta este helperul care face legătura dintre cotrollere și routere
    return function($param=null)use($router, $type, $data){
        if($param!=null) return $router[$type]($data, $param);
        return $router[$type]($data);
    };
};
