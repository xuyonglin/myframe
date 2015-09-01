<?php
namespace applications\lbs\models;

use base\models\BaseModel;

class AddressModel extends BaseModel{
    protected $dbName = 'bj_gsss';
    protected $tableName = 'address';
    
    public function __construct() {
        parent::__construct();
    }
    
    public function test(){
        $sql = 'select * from address where 1';
        $re = $this->getAll($sql);
        return $re;
    }
}


