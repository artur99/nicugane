<?php

namespace Controllers;

use Silex\Application;
use Silex\ControllerProviderInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Models\CatdModel;

class CatdController implements ControllerProviderInterface{
    public function connect(Application $app){
        $this->catdModel = new CatdModel($app['db']);

        $indexController = $app['controllers_factory'];
        $indexController->get('/catedre', [$this, 'handeCatdIndex'])->bind('catedre');
        $indexController->get('/catedre/{slug}', [$this, 'handeOneCatd'])->bind('catedra');
        // $indexController->get('/'.$section['slug'].'/{slug}', [$this, 'handleSectionPage'])->bind('sectionpage_'.$section['slug']);
        return $indexController;
    }
    public function handeCatdIndex(Application $app){
        // $route = explode('_', $app['request']->get("_route"), 2)[1];
        $section = [
            'slug' => 'catedre',
            'name' => 'Catedre',
            'description' => false
        ];

        $pages = $this->catdModel->getCatds();

        $twigdata = [
            'section' => $section,
            'pages' => $pages
        ];
        return $app['twig']->render('section.twig', $twigdata);
    }
    public function handeOneCatd(Application $app, $slug){
        if(!($info = $this->catdModel->getCatdInfo($slug))){
            throw new NotFoundHttpException("Pagina nu există");
        }
        $arts = $this->catdModel->getCatdArts($info['id']);

        $twigdata = [
            'title' => $info['name'],
            'cpdata' => $info,
            'catddata' => $arts
        ];
        return $app['twig']->render('catedra.twig', $twigdata);
    }
}
