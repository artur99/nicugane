<?php

namespace Controllers;

use Silex\Application;
use Silex\ControllerProviderInterface;
use Models\UserModel;

class UserController implements ControllerProviderInterface{
    public function connect(Application $app){
        $indexController = $app['controllers_factory'];
        $indexController->get('/', [$this, 'index']);
        $app['user'] = new UserModel($app['db'], $app['session']);
        $this->user = $app['user'];
        $app['twig']->addGlobal('user_in', $this->user->in());
        $app['twig']->addGlobal('user', $this->user->info());
        return $indexController;
    }
    public function index(Application $app){
        $twigdata = [];
        if(!$this->user->in())
            return $app['twig']->render('cont_out.twig', $twigdata);

        $twigdata['user'] = $this->user->info();

        if($twigdata['user']['prof']){
            $twigdata['user']['prof_catds'] = $app['user']->profCatds($twigdata['user']['id']);
        }
        return $app['twig']->render('cont.twig', $twigdata);
    }
}
