<?php

namespace Controllers;

use Silex\Application;
use Silex\ControllerProviderInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Models\SectModel;

class ProfController implements ControllerProviderInterface{
    public function connect(Application $app){
        $this->sectModel = new SectModel($app['db']);

        $indexController = $app['controllers_factory'];
        $indexController->get('/consiliu-profesoral', [$this, 'handlePage'])->bind('prof_consiliu');
        $indexController->get('/profesori', [$this, 'handlePage'])->bind('prof_prof');
        return $indexController;
    }
    public function handlePage(Application $app){
        $route = explode('_', $app['request']->get("_route"), 2)[1];
        if($route == 'profesori'){
            
        }

        $pages = $this->sectModel->getSectPages($section['id']);

        $twigdata = [
            'section' => $section,
            'pages' => $pages
        ];
        return $app['twig']->render('section.twig', $twigdata);
    }
}
