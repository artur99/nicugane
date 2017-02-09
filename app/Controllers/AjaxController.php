<?php

namespace Controllers;

use Silex\Application;
use Silex\ControllerProviderInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Models\UserModel;

class AjaxController implements ControllerProviderInterface{
    public function connect(Application $app){
        $indexController = $app['controllers_factory'];
        $indexController->post('/account/{kind}', [$this, 'account']);
        $indexController->post('/catedre/add', [$this, 'addCatdPost']);
        return $indexController;
    }
    public function account(Application $app, $kind){
        $this->user = new UserModel($app['db'], $app['session']);
        $req = $app['request']->request;
        $ses = $app['session'];
        $data = ['type' => 'error'];
        if($kind == 'login'){
            if($uid = $this->user->login_check($req->get('email'), $req->get('password'))){
                $this->user->login($uid, false, $cookie);
                $data['type'] = 'success';
                $data['text'] = 'Autentificat cu succes';
            }else{
                $data['text'] = 'Date de autentificare greșite';
            }
        }elseif($kind == 'logout'){
            $rmcookie = $this->user->logout();
        }else{
            $data['text'] = 'Controller necunoscut';
        }


        $resp = new JsonResponse();
        if(isset($cookie))
            $resp->headers->setCookie($cookie);
        if(isset($rmcookie))
            $resp->headers->clearCookie('token');
        $resp->setData($data);
        return $resp;
    }
    public function addCatdPost(Application $app){

    }
}
