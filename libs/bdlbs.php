<?php


class bdlbs{
    
    private $config = [
                    'ak' => '20c023166a06dc5e190f2ac50c6adf3d',
                    'sk' => 'EE0be1cc22282f9600654c06927bd0b6',
                ];
    private $cachePre = 'myframe_lbs_';
    private $cache = false;
    
    public function __construct(){
        $this->cache = new cache();
    }
    
    
    public function getAk(){
        return $this->config['ak'];
    }
    
    //IP城市转换
    public function ip2city($ip){
        $ip = Utils::ipDes($ip);//将IP格式化为 *.*.1.1,方便缓存
        $cacheKey = $this->cachePre . 'ip_' . ip2long($ip);
        $nowCity = $this->cache->get($cacheKey);
        if(!$nowCity){
            $nowCity = $this->getCityByIP($ip);
            if($nowCity['status'] == 0){
                $this->cache->set($cacheKey, $nowCity, 30);
            }else{
                $this->cache->set($cacheKey, 'nocity', 30);
                return false;
            }
        }
        return $nowCity;
    }
    
    //坐标城市转换
    public function corrds2city($corrd){
        $cacheCoord = Utils::corrdDes($corrd);//将坐标保留两位小数，方便缓存
        $cacheKey = $this->cachePre . 'corrd_' . md5($cacheCoord);
        $city = $this->cache->get($cacheKey);
        if(!$city){
            $newCorrd = $this->getBdCoords($corrd);
            if($newCorrd['status'] !== 0){
                //echo '坐标有误，默认北京';
                return false;
            }
            $newCorrd = $newCorrd['result'][0];
            $corrdStr = implode(',', $newCorrd);
            $re = $this->getCityByCorrd($corrdStr);
            if($re['status'] !== 0){
                //echo '没有获取到，默认北京';
                return false;
            }
            $city = $re['result']['addressComponent']['city'];
            $this->cache->set($cacheKey, $city, 30);
        }
        return $city;
    }
    
    
    private function getCityByIP($ip){
        $url = 'http://api.map.baidu.com/location/ip?ip=' . $ip . '&ak=' . self::getAk();
        $re = Utils::_postDataCurl($url);
        return json_decode($re, true);
    }
    
    private function getBdCoords($coords) {
        $url = 'http://api.map.baidu.com/geoconv/v1/?coords=' . $coords . '&from=3&to=5&ak=' . self::getAk();
        $re = Utils::_postDataCurl($url);
        return json_decode($re, true);
    }
    
    private function getCityByCorrd($corrd){
        $url = 'http://api.map.baidu.com/geocoder/v2/?output=json&ak=' . self::getAk() . '&location=' . $corrd;
        $re = Utils::_postDataCurl($url);
        return json_decode($re, true);
    }
    
}
