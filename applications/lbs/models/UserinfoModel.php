<?php
namespace applications\lbs\models;

use base\models\BaseModel;

class UserinfoModel extends BaseModel{
    protected $dbName = 'lbs';
    protected $tableName = 'userinfo';
    
    public function __construct() {
        parent::__construct();
    }
    
    public function test(){
        $sql = 'select * from userinfo where 1';
        $re = $this->getAll($sql);
        return $re;
    }
}


