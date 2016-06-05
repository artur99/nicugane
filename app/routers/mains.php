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
    $twigdata = [];
    $twigdata['staticpage'] = $data_array[0];
    $twigdata['title'] = $data_array[1];

    return $app['twig']->render('static.twig', $twigdata);
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
