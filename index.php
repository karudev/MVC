<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

$loader = require_once __DIR__.'/vendor/autoload.php';
$loader->register();
include(__DIR__.'/src/Controller/TestController.php');


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\HttpKernel;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\HttpKernel\EventListener\RouterListener;
use Symfony\Component\HttpFoundation\RequestStack;

use src\Controller\TestController;



$routes = new RouteCollection();
$routes->add('hello', new Route('/hello/{name}', array(
        '_controller' => array(new TestController(),'helloAction')
    )
));

$request = Request::createFromGlobals();


$matcher = new UrlMatcher($routes, new RequestContext());

$dispatcher = new EventDispatcher();
$dispatcher->addSubscriber(new RouterListener($matcher,null,null,new RequestStack()));

$resolver = new ControllerResolver();
$kernel = new HttpKernel($dispatcher, $resolver);

$response = $kernel->handle($request);
$response->send();

$kernel->terminate($request, $response);
