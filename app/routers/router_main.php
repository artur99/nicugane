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

$router['profesor'] = function($data, $param)use($app, $model){
    $pdata = $model->get_prof(intval(explode('-', $param)[0]));
    if(!$pdata) throw new NotFoundHttpException('Acest profesor nu există');

    $title = misc::shorten($pdata['data']->statut).' '.$pdata['name'];
    $descr = $pdata['name'].' - '.$pdata['data']->statut.' la '.$app['conf.title'].', cu specializările: '.implode(', ', $pdata['data']->spec);
    $twigdata['title'] = $title;
    $twigdata['prof'] = $pdata;

    $seo = new SEO('profesor', $app);
    $seo->setTitle($title);
    $seo->setDescr($descr);

    $twigdata['meta'] = $seo->getAll();
    // $twigdata['profs'] = $model->get_profs();

    return $app['twig']->render('profesor.twig', $twigdata);
};

$router['activitate'] = function($data, $param)use($app, $model){
    $pdata = $model->get_activ(intval(explode('-', $param)[0]));
    if(!$pdata) throw new NotFoundHttpException('Acest profesor nu există');

    $title = $pdata['title'];
    // $descr = $pdata['name'].' - '.$pdata['data']->statut.' la '.$app['conf.title'].', cu specializările: '.implode(', ', $pdata['data']->spec);
    $twigdata['title'] = $title;
    $twigdata['activ'] = $pdata;

    $seo = new SEO('profesor', $app);
    $seo->setTitle($title);
    $seo->setDescr("temp");

    $twigdata['meta'] = $seo->getAll();
    // $twigdata['profs'] = $model->get_profs();

    return $app['twig']->render('activitate.twig', $twigdata);
};

$router['eveniment'] = function($data, $param)use($app, $model){
    $pdata = $model->get_prof(intval(explode('-', $param)[0]));
    if(!$pdata) throw new NotFoundHttpException('Acest profesor nu există');

    $title = misc::shorten($pdata['data']->statut).' '.$pdata['name'];
    $descr = $pdata['name'].' - '.$pdata['data']->statut.' la '.$app['conf.title'].', cu specializările: '.implode(', ', $pdata['data']->spec);
    $twigdata['title'] = $title;
    $twigdata['prof'] = $pdata;

    $seo = new SEO('profesor', $app);
    $seo->setTitle($title);
    $seo->setDescr($descr);

    $twigdata['meta'] = $seo->getAll();
    // $twigdata['profs'] = $model->get_profs();

    return $app['twig']->render('profesor.twig', $twigdata);
};





$router_account = function(Request $request)use($app){
    if($uid = $app['user']->loggedin()) return $app['twig']->render('account2.twig', ['user'=>$app['user']->get($uid, 'name,email')]);
    if($uid = $app['user']->loggedin_cookie($request)) return $app['twig']->render('account2.twig', ['user'=>$app['user']->get($uid, 'name,email'), 'relogin'=>1]);
    return $app['twig']->render('account.twig');
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
