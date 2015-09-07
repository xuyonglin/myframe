<?php
namespace applications\lbs\controllers;

use base\controllers\BaseController;

class DefaultController extends BaseController{
    
    public function actionMycity(){
        $ip = \Utils::getIP();
        $ipUtil = new \bdlbs();
        $re = $ipUtil->ip2city($ip);
        if(!$re){
            return $this->_dataFailed('未获取到');
        }else{
            return $this->_dataSuccess($re);
        }
    }
    
    public function actionIp2city(){
        $ip = \Input::get('ip');
        $ipUtil = new \bdlbs();
        $re = $ipUtil->ip2city($ip);
        if(!$re){
            return $this->_dataFailed('未获取到');
        }else{
            return $this->_dataSuccess($re);
        }
    }
    
    public function actionCorrd2city(){
        $corrd = \Input::get('corrd');
        $ipUtil = new \bdlbs();
        $re = $ipUtil->corrds2city($corrd);
        return $re;
    }
    
}

