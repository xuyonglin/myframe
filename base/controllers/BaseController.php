<?php
namespace base\controllers;

class BaseController{
    public function test(){
        return __FILE__;
    }
    
    public function _dataSuccess($data){
        $arr = [
                'meta' => [
                    'msg' => 'ok',
                    'status' => 200,
                ],
                'data' => $data,
            ];
        $callback = \Input::get('callback');
        if($callback){
            return $callback . '(' . json_encode($arr) . ')';
        }else{
            return json_encode($arr);
        }
    }
    
    public function _dataFailed($reason){
        $arr = [
            'meta' => [
                'msg' => $reason,
                'status' => 400,
            ],
            'data' => [],
        ];
        $callback = \Input::get('callback');
        if($callback){
            return $callback . '(' . json_encode($arr) . ')';
        }else{
            return json_encode($arr);
        }
    }
}

