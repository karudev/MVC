<?php

namespace src;
use Twig_Loader_Filesystem;
use Twig_Environment;

class Templating {

    public function render($path, $params) {
        $loaderTwig = new Twig_Loader_Filesystem(__DIR__ . '/View');
        $twig = new Twig_Environment($loaderTwig, array(
        ));
        return  $twig->render($path,$params);
    }

}
