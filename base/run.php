<?php

use Azi\Input;

class run{
    private $config = false;
    
    public function __construct(& $config) {
        $this->config = $config;
    }
    
    public function run(){
        $route = isset($_GET['r']) ? Input::get('r') : $_SERVER['REDIRECT_URL'];
        $routeArr = explode('/', trim($route, '/'));
        $routeArr[1] = isset($routeArr[1]) ? ucfirst($routeArr[1]) . 'Controller' : 'IndexController';
        $routeArr[2] = isset($routeArr[2]) ? 'action' . ucfirst($routeArr[2]) : 'actionIndex';
        $libName = $this->config['applications'][$routeArr[0]];
        $cName = $libName . '\\controllers\\' . $routeArr[1];
        if(!class_exists($cName)){
            die('class ' . $routeArr[1] . ' not exists');
        }
        $aName = $routeArr[2];
        $c = new $cName;
        if(!method_exists($c, $aName)){
            die('action ' . $aName . ' not exists');
        }
        if(method_exists($c, 'init')){
            $c->init();
        }
        $re = $c->$aName();
        echo $re;
    }
}

