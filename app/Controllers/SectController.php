<?php

namespace Controllers;

use Silex\Application;
use Silex\ControllerProviderInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Models\SectModel;

class SectController implements ControllerProviderInterface{
    public function connect(Application $app){
        $this->sectModel = new SectModel($app['db']);
        $this->sections = $this->sectModel->getSections();

        $indexController = $app['controllers_factory'];
        foreach($this->sections as $section){
            $indexController->get('/'.$section['slug'], [$this, 'handleSection'])->bind('section_'.$section['slug']);
            $indexController->get('/'.$section['slug'].'/{slug}', [$this, 'handleSectionPage'])->bind('sectionpage_'.$section['slug']);
        }
        return $indexController;
    }
    public function handleSection(Application $app){
        $route = explode('_', $app['request']->get("_route"), 2)[1];
        $section = $this->sections[$route];

        $pages = $this->sectModel->getSectPages($section['id']);

        $twigdata = [
            'section' => $section,
            'pages' => $pages
        ];
        return $app['twig']->render('section.twig', $twigdata);
    }
    public function handleSectionPage(Application $app, $slug){
        $route = explode('_', $app['request']->get("_route"), 2)[1];
        $page = $this->sectModel->getPage($slug);
        if(!$page) throw new NotFoundHttpException("Pagina nu există");

        $section = $this->sections[$route];
        $twigdata = [
            'section' => $section,
            'page' => $page
        ];
        return $app['twig']->render('page.twig', $twigdata);
    }
}
