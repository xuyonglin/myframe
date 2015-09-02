<?php
namespace applications\lbs\controllers;

use Azi\Input;
use base\controllers\BaseController;

class DefaultController extends BaseController{
    
    public function actionIp2city(){
        $ip = Input::get('ip');
        $ipUtil = new \bdlbs();
        $re = $ipUtil->ip2city($ip);
        return $re;
    }
    
    public function actionCorrd2city(){
        $corrd = Input::get('corrd');
        $ipUtil = new \bdlbs();
        $re = $ipUtil->corrds2city($corrd);
        return $re;
    }
    
}

