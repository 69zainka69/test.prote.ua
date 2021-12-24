<?php
namespace Cache;
class Redis {
private $expire;
private $cache;
public function __construct($expire) {
$this->expire = $expire;
$this->cache = new \Redis();
$this->cache->pconnect(CACHE_HOSTNAME, CACHE_PORT);
}
public function get($key) {
$data = $this->cache->get(CACHE_PREFIX . $key);
return json_decode($data, true);
}
public function set($key,$value) {
$status = $this->cache->set(CACHE_PREFIX . $key,
json_encode($value));
if($status){
$this->cache->expire(CACHE_PREFIX . $key, $this->expire);
$this->cache->setEx(CACHE_PREFIX . $key, $this->expire, json_encode($value)); // sets key → value, with 1h TTL.
}
return $status;
}
public function delete($key) {
$this->cache->del(CACHE_PREFIX . $key);
}
public function del($key) {
    $this->cache->del(CACHE_PREFIX . $key);
}

}