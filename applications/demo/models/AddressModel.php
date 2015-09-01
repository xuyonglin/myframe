<?php
namespace applications\demo\models;

use base\models\BaseModel;

class AddressModel extends BaseModel{
    protected $dbName = 'bj_gsss';
    protected $tableName = 'address';
    
    public function __construct() {
        parent::__construct();
    }
    
}


