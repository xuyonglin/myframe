<?php
namespace applications\demo\models;

use base\models\BaseModel;

class UserinfoModel extends BaseModel{
    protected $dbName = 'lbs';
    protected $tableName = 'userinfo';
    
    public function __construct() {
        parent::__construct();
    }
    
}


