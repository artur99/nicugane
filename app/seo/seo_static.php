<?php

class staticSEO{
    function get($what){
        global $app;
        if($what == 'home'){
            $res['title'] = $app['conf.title'];
        }
    }
}
