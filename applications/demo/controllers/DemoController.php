<?php
namespace applications\demo\controllers;

use base\controllers\BaseController;
use applications\demo\models\AddressModel;
use applications\demo\models\UserinfoModel;
use Azi\Input;
/**
 * author: xuyonglin@intv.com.cn
 */
class DemoController extends BaseController{
    /*
     * 框架使用方法：
     * 1. 首先在/applications下创建项目目录，目录下包含controllers,models目录
     * 2. 去配置文件（/config/config.php)中配置applications路径
     * 3. 去配置文件中（/config/config.php）中配置db属性
     * 4. 去配置文件中（/config/memcache.php)中配置memcache属性
     * 5. /applications/controllers(models)下创建控制器和模型文件，并声明namespace
     * 6. 执行composer dump-autoload
     * 7. 访问路径 配置虚拟主机域名请指向/public 
     *     http://xxxx.xxx.xx/应用程序目录/控制器名/action名称
     *    如未将根目录指向/public 请访问/public/index.php?r=应用程序目录/控制器名/action名称
     * 8. 支持多数据库，请再model中设置dbName
     * 9. 如需执行初始化操作，请再控制器中添加public function init()方法
     */
    
    //获取所有数据记录
    public function actionResult(){
        $userModel = new UserinfoModel();
        //result/one/count
        $re = $userModel->where(['id>0'])->orderBy('id desc')->limit(10)->result();
        return $re;
    }
    
    //获取IP
    public function actionGetip(){
        $ip = \Utils::getIP();
        echo $ip;exit;
    }
    
    //修改数据
    public function actionUpdate(){
        $userModel = new UserinfoModel();
        $where = ['id>0'];
        $colums = ['name' => 'xuyonglin1s', 'phone' => '18686629312'];
        //update/updateOnes
        $re = $userModel->updateOne($where, $colums);
        return $re;
    }
    
    //插入数据
    public function actionInsert(){
        $userModel = new UserinfoModel();
        //$userModel = new AddressModel();
        /*
        $colums = ['intvopenid' => 'xuyonglin', 
            'nick_name' => 'nick_name',
            'head_img' => '111',
            'uname' => '徐',
            'phone' => '18686629311',
            'address' => '北京',
            'prize_id' => '1',
            'prize_name' => 't',
            'program_id' => '5',
            'created_at' => date('Y-m-d H:i:s'),
            ];
         * */
        $colums = ['name' => 'xuyonglin', 'phone' => '18686629311'];
        $re = $userModel->create($colums);//返回insert_id
        return $re;
    }
    
    //执行自己的sql语句
    public function actionExecutesql(){
        $addressModel = new AddressModel();
        $sql = 'select * from ' . $addressModel->tableName() . ' where 1';
        $re = $addressModel->createCommand($sql)->all();
        return $re;
    }
    
    //缓存-设置
    public function actionSetcache(){
        $cache = new \cache();
        $cacheKey = 'myframe_k1';
        return $cache->set($cacheKey, 'xuyonglin', 30);
    }
    
    //缓存-获取
    public function actionGetcache(){
        $cache = new \cache();
        $cacheKey = 'myframe_k1';
        return $cache->get($cacheKey);
    }
    
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

