<?php
namespace base\models;

class BaseModel{
    protected $dbName = false;
    protected $tableName = false;
    protected $dbConfig = false;
    protected $db = false;
    protected $select = '*';
    protected $where = 'where 1';
    protected $andWhere = false;
    protected $orderBy = false;
    protected $limit = false;
    protected $command = false;


    public function __construct() {
        $this->dbConfig = $GLOBALS['config']['db'];
        $config = $this->dbConfig[$this->dbName];
        $this->db = new \mysqli($config['db_host'], $config['db_user'], $config['db_pass'], $this->dbName, 3306);
        $this->db->query('SET NAMES ' . $config['db_charset']);
    }
    
    public function getDB(){
        return $this->db;
    }
    
    public function where($conditions){
        foreach($conditions as $val){
            $this->where .= ' and ' . $val;
        }
        return $this;
    }
    
    public function colums($colums){
        $this->select = $colums;
        return $this;
    }
    
    public function orderBy($orderBy){
        $this->orderBy = $orderBy;
        return $this;
    }
    
    public function limit($limit){
        $this->limit = $limit;
        return $this;
    }
    
    public function result(){
        $sql = $this->createSql();
        return $this->db->query($sql)->fetch_all();
    }
    
    public function resultOne(){
        $sql = $this->createSql();
        return $this->db->query($sql)->fetch_row();
    }
    
    public function count(){
        $this->select = 'count(*)';
        $sql = $this->createSql();
        $re = $this->db->query($sql)->fetch_row();
        return $re[0];
    }
    
    public function createSql(){
        $sql = 'SELECT ' . $this->select . ' FROM ' . $this->tableName .  ' ' . $this->where;
        if($this->orderBy){
            $sql .= ' ORDER BY ' . $this->orderBy;
        }
        if($this->limit){
            $sql .= ' LIMIT ' . $this->limit;
        }
        return $sql;
    }
    
    public function createCommand($sql){
        $this->command = $sql;
        return $this;
    }
    
    public function one(){
        return $this->db->query($this->command)->fetch_row();
    }
    
    public function all(){
        return $this->db->query($this->command)->fetch_all();
    }
    
    
    public function update($condition, $colums){
        $sql = $this->createUpdateSql($condition, $colums);
        if($this->db->query($sql)){
            return $this->db->affected_rows;
        }else{
            return false;
        }
    }
    
    public function updateOne($condition, $colums){
        $sql = $this->createUpdateSql($condition, $colums, 1);
        if($this->db->query($sql)){
            return $this->db->affected_rows;
        }else{
            return false;
        }
    }
    
    public function create($colums){
        $sql = $this->createInsertSql($colums);
        if($this->db->query($sql)){
            return $this->db->insert_id;
        }else{
            return false;
        }
    }
    
    public function createInsertSql($colums){
        $colums = $this->createColum($colums);
        $sql = 'INSERT ' . $this->tableName . ' set ' . $colums;
        return $sql;
    }
    
    public function createUpdateSql($condition, $colums, $limit = false){
        $colums = $this->createColum($colums);
        $condition = $this->createCondition($condition);
        $sql = 'UPDATE ' . $this->tableName . ' set ' . $colums . ' where ' . $condition;
        if($limit){
            $sql .= ' limit 1';
        }
        return $sql;
    }
    
    public function createCondition($condition){
        if(!$condition){
            return ' 1 ';
        }
        $cod = '';
        foreach($condition as $key=>$val){
            $cod = 'and ' . $val;
        }
        return trim($cod, 'and');
    }
    
    public function createColum($colums){
        $col = '';
        foreach($colums as $key=>$val){
            $col .= ",`$key`='$val'";
        }
        return trim($col, ',');
    }
    
    
    public function tableName(){
        return $this->tableName;
    }
    
}
