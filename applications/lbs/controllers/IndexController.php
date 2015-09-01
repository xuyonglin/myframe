<?php
namespace applications\lbs\controllers;

use base\controllers\BaseController;
use applications\lbs\models\UserinfoModel;
use applications\lbs\models\AddressModel;

class IndexController extends BaseController{

    public function actionTest(){
        $model = new AddressModel();
        $re = $model->test();
        var_dump($re);exit;
        $cache = new \cache();
        $re = $cache->set('test', $re, 10);
        var_dump($re);exit;
        return $re;
    }
    
    public function actionDb(){
        $model = new AddressModel();
        $re = $model->colums('*')->where(['id>0','1'])->orderBy('id desc')->limit('0,10')->result();
        return $re;
        
    }
    
    public function actionGet(){
        $cache = new \cache();
        $re = $cache->get('test');
        var_dump($re);
    }
}