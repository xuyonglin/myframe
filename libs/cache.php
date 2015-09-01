<?php

class cache{
    private $cache = false;
    private $clientType = false;
    
    public function __construct() {
        $config = require(__DIR__ . '/../config/memcache.php');
        $this->clientType = class_exists('Memcache') ? "Memcache" : (class_exists('Memcached') ? "Memcached" : FALSE);
        if($this->clientType){
            switch($this->clientType){
                case 'Memcached':
                    $this->cache = new Memcached();
                    break;
                case 'Memcache':
                    $this->cache = new Memcache();
                    break;
            }
        }else{
            //抛出异常，没有memcache或者memcached扩展
        }
        $this->cache->addserver($config['host'], $config['port']);
    }
    
    public function set($k, $v, $time){
        switch ($this->clientType){
            case 'Memcache':
                $status = $this->cache->set($k, $v, false, $time);
                break;
            case 'Memcached':
                $status = $this->cache->set($k, $v, $time);
                break;
        }
        return $status;
    }
    
    public function get($k){
        return $this->cache->get($k);
    }
    
}

