<?
/*
USAGE RETRIVE FROM CACHE:
$dbCache = new dbCache;
if($dbCache->isCached('top-produse')) {
    $data = $dbCache->getCache('top-produse');
}
USAGE STORE CACHE:
$dbCache = new dbCache;
$dbCache->storeCache('top-produse', $data);
*/

class dbCache {
   
    static private $instance = NULL;
   
    private $CacheTable;
    private $cached_data;
   
    const CACHE_TTL = 600; // 10 minutes
   
    function __construct() {
        $this->CacheTable = '_db_cache';
        $this->cached_data = array();
    }
   
    public function getInstance() {
        if(!self::$instance) {
            self::$instance = new dbCache;
        }
        return self::$instance;
    }
   
   
    public function storeCache($_id_cache, $_data, $_ttl = 0) {
        $_ttl = $_ttl > 0 ? $_ttl : self::CACHE_TTL;
        if($this->cacheExists($_id_cache)) {
            return mysql_query("
                UPDATE ".$this->CacheTable." SET
                cache_data = '".mysql_real_escape_string($this->encodeCacheData($_data))."',
                cache_date = '".date('Y-m-d H:i:s', time() + $_ttl)."'
                WHERE id_cache = '$_id_cache'
            ");
            /*return $this->CacheTable->update(array(
                'cache_data' => $this->encodeCacheData($_data),
                'cache_date' => date('Y-m-d H:i:s', time() + $_ttl),
            ), $_id_cache);*/
        } else {
            return mysql_query("
                INSERT INTO ".$this->CacheTable." SET
                cache_data = '".mysql_real_escape_string($this->encodeCacheData($_data))."',
                cache_date = '".date('Y-m-d H:i:s', time() + $_ttl)."',
                id_cache = '$_id_cache'
            ");
            /*return $this->CacheTable->insert(array(
                'id_cache' => $_id_cache,
                'cache_data' => $this->encodeCacheData($_data),
                'cache_date' => date('Y-m-d H:i:s', time() + $_ttl),
            ));*/
        }
    }
   
    private function cacheExists($_id_cache) {
        $rs = mysql_query("SELECT * FROM ".$this->CacheTable." WHERE id_cache = '$_id_cache'");
        if(mysql_num_rows($rs) > 0) {
            return true;
        }
        return false;
    }
   
   
    public function getCache($_id_cache) {
        if(isset($this->cached_data[$_id_cache])) {
            return $this->cached_data[$_id_cache];
        } else {
            //$cached_data = $this->CacheTable->getrowbykey2(array('id_cache' => $_id_cache));
            $rs = mysql_query("SELECT * FROM ".$this->CacheTable." WHERE id_cache = '$_id_cache'");
            $cached_data = mysql_fetch_assoc($rs);
            #$t1 = date_to_time($cached_data['cache_date']);
            #$t2 = date_to_time(date('Y-m-d H:i:s'));
            if(is_array($cached_data) && !empty($cached_data) && strcmp($cached_data['cache_date'], date('Y-m-d H:i:s')) > 0) {
                #echo 'cache hit['.$_id_cache.']';
                #echo $cached_data['cache_date'] . ' --- ' . date('Y-m-d H:i:s');exit;
                return $this->decodeCacheData($cached_data['cache_data']);
            } else {
                return '';
            }
        }
    }
   
    /*private function date_to_time($_datetime) {
        $p = explode(' ', $_datetime);
        list($Y, $m, $d) = explode('-', $p[0]);
        list($H, $i, $s) = explode(':', $p[1]);
        return mktime();
    }*/
   
   
    public function isCached($_id_cache) {
        $cached_data = $this->getCache($_id_cache);
        if((is_array($cached_data) && !empty($cached_data)) || (!is_array($cached_data) && strlen($cached_data))) {
            $this->cached_data[$_id_cache] = $cached_data;
            return true;
        } else {
            return false;
        }
    }
   
   
    private function encodeCacheData($_data) {
        return serialize($_data);
    }
   

    private function decodeCacheData($_data) {
        return unserialize($_data);
    }
   
    public function cleanUpExpired() {
        // DELETE EVERYTHING OLDER THAN time() - $ttl
        //return $this->CacheTable->deletew("cache_date < '".date('Y-m-d H:i:s')."'");
        return mysql_query("DELETE FROM ".$this->CacheTable." WHERE cache_date < '".date('Y-m-d H:i:s')."'");
    }
}

?>