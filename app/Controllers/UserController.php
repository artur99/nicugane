<?php

namespace Controllers;

use Silex\Application;
use Silex\ControllerProviderInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Models\UserModel;

class CatdController implements ControllerProviderInterface{
    public function connect(Application $app){
        $this->catdModel = new CatdModel($app['db']);

        $indexController = $app['controllers_factory'];
        // $indexController->get('/catedre', [$this, 'handeCatdIndex'])->bind('catedre');
        // $indexController->get('/catedre/{slug}', [$this, 'handeOneCatd'])->bind('catedra');
        // $indexController->get('/'.$section['slug'].'/{slug}', [$this, 'handleSectionPage'])->bind('sectionpage_'.$section['slug']);
        return $indexController;
    }
}
