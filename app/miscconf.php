<?php
use Silex\Provider;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Csrf\CsrfToken;
use Symfony\Component\Security\Csrf\CsrfTokenManager;
use Stringy\Stringy as S;

function g_link($link){
    global $app;
    if(strpos($link, '://') !== false) return $link;
    return $app['conf.url'].'/'.ltrim($link, '/');
}
function a_link($asset){
    global $app;
    if(strpos($asset, '://') !== false) return $asset;
    return $app['conf.url'].$app['twig.assets'].ltrim($asset, '/');
}
function a_image($loc){
    global $app;
    if(substr($loc, 0, 7) == 'http://' || substr($loc, 0, 8) == 'https://'){
        $link = $loc;
    }else{
        if(substr($loc, 0, 1) == '/' || substr($loc, 0, 2) == './' || substr($loc, 0, 2) == '..')
            $link = $loc;
        else{
            $link = $app['conf.url_path'].$app['twig.assets'].ltrim('img/'.$loc, '/');
        }
    }
    return $link;
}
function global_patches($app){
    global $fb;
    $fb = new Facebook\Facebook(array(
      'app_id'  => $app['conf.facebook.app_id'],
      'app_secret' => $app['conf.facebook.app_secret']
    ));
}

$app['csrf'] = $app->share(function () {
    return new CsrfTokenManager();
});
$app['twig'] = $app->share($app->extend('twig', function($twig,$app){
    $twig->addExtension(new Twig_Extensions_Extension_Text());
    $twig->addFunction(new \Twig_SimpleFunction('asset', function ($asset)use($app){
        if(strpos($asset, '://') !== false) return $asset;
        return $app['conf.url'].$app['twig.assets'].ltrim($asset, '/');
    }));
    $twig->addFunction(new \Twig_SimpleFunction('user', function($what)use($app){
        return $app['user']->data($what);
    }));
    $twig->addFunction(new \Twig_SimpleFunction('l', function($what)use($app){
        if(strpos($what, '://') !== false) return $what;
        return $app['conf.url'].'/'.ltrim($what, '/');
    }));
    $twig->addFunction(new \Twig_SimpleFunction('csrftoken', function($id)use($app){
        return $app['csrf']->getToken($id)->__tostring();
    }));
    $twig->addFunction(new \Twig_SimpleFunction('mact', function($id)use($app){
        $d1 = explode('/', ltrim($id, '/'));
        $d2 = explode('/', ltrim($app['request']->getPathInfo(), '/'));
        $cond = isset($d1[0], $d2[0]) && !empty($d1[0]) && $d1[0]==$d2[0];
        return $id == $app['request']->getPathInfo() || $cond ?' active':'';
    }));
    $twig->addFunction(new \Twig_SimpleFunction('mact2', function($id)use($app){
        $d1 = explode('/', ltrim($id, '/'));
        $d2 = explode('/', ltrim($app['request']->getPathInfo(), '/'));
        $cond = isset($d1[0], $d2[0]) && !empty($d1[0]) && $d1[0]==$d2[0];
        return $id == $app['request']->getPathInfo() || $cond ?'class="active"':'';
    }));
    $twig->addFunction(new \Twig_SimpleFunction('img', function($loc)use($app){
        return a_image($loc);
    }));
    $twig->addFunction(new \Twig_SimpleFunction('gen_bgcss', function($loc)use($app){
        $link = a_image($loc);
        return 'background-image: url(\''.$link.'\')';
    }));
    $twig->addFilter(new \Twig_SimpleFilter('slugify', function($text){
        $s = S::create($text);
        return $s->slugify();
    }));
    $twig->addFilter(new \Twig_SimpleFilter('shorten', function($text){
        return Misc\MiscClass::shorten($text);
    }));
    return $twig;
}));
$app['user'] = $app->share(function() use ($app) {
    return new user($app);
});

$app['executers'] = $app->share(function() use ($app) {
    return [
        'user' => new \DaySplit\Executers\UserExecuter($app['db']),
    ];
});
