<?php
use Silex\Provider;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

$app->error(function(\Exception $e, $code)use($app) {
    return new Response(
        $app['twig']->render('error.twig', ['error_code' => $code, 'error_text'=>$e->getMessage()]), $code
    );
});

$router['index'] = function()use($app){
    return $app['twig']->render('landing.twig');
};

$router['static'] = function($data_array)use($app){
    //Datele trimise prin $data_array vor fi id-ul paginii și titlul acesteia pe 0, 1
    //id-ul paginii este numele fișierului din templates/pages/
    if(!file_exists(rtrim($app['twig.path'], '/').'/pages/'.$data_array[0].'.twig')){
         throw new NotFoundHttpException("Conținutul acestei pagini nu există!");
    }
    $twigdata['staticpage'] = $data_array[0];
    $twigdata['title'] = $data_array[1];

    return $app['twig']->render('static.twig', $twigdata);
};
$router['proto'] = function($data_array)use($app){
    $twigdata['title'] = 'Pagină în construcție';

    return $app['twig']->render('proto.twig', $twigdata);
};

$router['profesori'] = function($array_data)use($app, $model){
    $twigdata['title'] = 'Profesori';
    $twigdata['profs'] = $model->get_profs();
    return $app['twig']->render('profesori.twig', $twigdata);
};
$router['activitati'] = function($array_data)use($app, $model){
    $twigdata['title'] = 'Activități';
    $twigdata['data'] = $model->get_activities();
    return $app['twig']->render('activitati.twig', $twigdata);
};
$router['evenimente'] = function($array_data)use($app, $model){
    $twigdata['title'] = 'Evenimente';
    $twigdata['data'] = $model->get_events();
    return $app['twig']->render('evenimente.twig', $twigdata);
};
$router['catedre'] = function($array_data)use($app, $model){
    $twigdata['title'] = 'Catedre';
    $twigdata['data'] = $model->get_catedre();
    return $app['twig']->render('catedre.twig', $twigdata);
};

$router['profesor'] = function($data, $param)use($app, $model){
    $pdata = $model->get_prof(intval(explode('-', $param)[0]));
    if(!$pdata) throw new NotFoundHttpException('Acest profesor nu există');

    $title = Misc\MiscClass::shorten($pdata['data']->statut).' '.$pdata['name'];
    $descr = $pdata['name'].' - '.$pdata['data']->statut.' la '.$app['conf.title'].', cu specializările: '.implode(', ', $pdata['data']->spec);
    $twigdata['title'] = $title;
    $twigdata['prof'] = $pdata;

    $seo = new Misc\SeoClass('profesor', $app);
    $seo->setTitle($title);
    $seo->setDescr($descr);

    $twigdata['meta'] = $seo->getAll();
    // $twigdata['profs'] = $model->get_profs();

    return $app['twig']->render('profesor.twig', $twigdata);
};

$router['activitate'] = function($data, $param)use($app, $model){
    $pdata = $model->get_activ(intval(explode('-', $param)[0]));
    if(!$pdata) throw new NotFoundHttpException('Această activitate nu există');

    $title = $pdata['title'];
    // $descr = $pdata['name'].' - '.$pdata['data']->statut.' la '.$app['conf.title'].', cu specializările: '.implode(', ', $pdata['data']->spec);
    $twigdata['title'] = $title;
    $twigdata['activ'] = $pdata;

    $seo = new Misc\SeoClass('activitate', $app);
    $seo->setTitle($title);
    $seo->setDescr("temp");

    $twigdata['meta'] = $seo->getAll();
    // $twigdata['profs'] = $model->get_profs();

    return $app['twig']->render('activitate.twig', $twigdata);
};

$router['eveniment'] = function($data, $param)use($app, $model){
    $pdata = $model->get_event(intval(explode('-', $param)[0]));
    if(!$pdata) throw new NotFoundHttpException('Acest eveniment nu există');

    $title = $pdata['title'];
    // $descr = $pdata['name'].' - '.$pdata['data']->statut.' la '.$app['conf.title'].', cu specializările: '.implode(', ', $pdata['data']->spec);
    $twigdata['title'] = $title;
    $twigdata['event'] = $pdata;

    $seo = new Misc\SeoClass('eveniment', $app);
    $seo->setTitle($title);
    $seo->setDescr("temp");

    $twigdata['meta'] = $seo->getAll();
    // $twigdata['profs'] = $model->get_profs();

    return $app['twig']->render('eveniment.twig', $twigdata);
};

$router['catedra'] = function($data, $param)use($app, $model){
    $cid = intval(current(explode('-', $param)));
    $cpdata = $model->get_catd_data($cid);
    if(!$cpdata) throw new NotFoundHttpException('Această catedră nu există!');
    $pdata = $model->get_catd_art($cid);

    $title = 'Catedra de '.$cpdata['name'];
    // $descr = $pdata['name'].' - '.$pdata['data']->statut.' la '.$app['conf.title'].', cu specializările: '.implode(', ', $pdata['data']->spec);
    $twigdata['title'] = $title;
    $twigdata['cpdata'] = $cpdata;
    $twigdata['catddata'] = $pdata;

    $seo = new Misc\SeoClass('catedra', $app);
    $seo->setTitle($title);
    $seo->setDescr("temp");

    $twigdata['meta'] = $seo->getAll();
    // $twigdata['profs'] = $model->get_profs();

    return $app['twig']->render('catedra.twig', $twigdata);
};





$router['cont'] = function()use($app){
    // if($uid = $app['user']->loggedin_cookie($request)) return $app['twig']->render('account2.twig', ['user'=>$app['user']->get($uid, 'name,email'), 'relogin'=>1]);
    $twigdata['title'] = 'Contul meu';
    if($uid = $app['user']->loggedin()){
        $twigdata['user'] = $app['user']->get($uid, 'id,name,image,email,data,rdate,prof,admin');
        $twigdata['user']['data'] = @json_decode($twigdata['user']['data']);
        if($twigdata['user']['prof']){
            $twigdata['user']['prof_catds'] = $app['user']->get_catds($twigdata['user']['id']);
        }
        return $app['twig']->render('cont_logat.twig', $twigdata);
    }
    return $app['twig']->render('cont.twig', $twigdata);
};

$router_dash = function()use($app,$model){
    if(!($uid = $app['user']->loggedin())) return $app->redirect('/account');
    return $app['twig']->render('dashboard.twig');
};

$router_dash_groups = function()use($app,$model){
    if(!($uid = $app['user']->loggedin())) return $app->redirect('/account');
    $tdata = [];
    $tdata['groups'] = $model->get_grouplist();

    return $app['twig']->render('dashboard_groups.twig', $tdata);
};
$router_dash_group_in = function($gid)use($app,$model){
    if(!($uid = $app['user']->loggedin())) return $app->redirect('/account');
    if(!$app['user']->in_group($gid)) throw new AccessDeniedHttpException("Nu aveți acces la acest grup!");
    $tdata = [];
    $tdata['gid'] = $gid;
    $tdata['group'] = $model->get_groupdata($gid);
    if(!$tdata['group']) throw new AccessDeniedHttpException("Nu aveți acces la acest grup!");
    return $app['twig']->render('dashboard_group_in.twig', $tdata);
};
