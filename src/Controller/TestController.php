<?php

namespace src\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
include(__DIR__.'/../Templating.php');
use src\Templating;

class TestController extends Templating{
    
    public function helloAction($name){
      
        $content = $this->render('Test/Hello.html.twig', array('name' => $name));
        return new Response($content);
      
    }
}