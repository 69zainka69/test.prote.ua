<?php
/**
 * @author  Jack Wiwat (wiwat.nkp@gmail.com)
 * @license Free
 * @since Version 1.0
 * 
 */

namespace Cache;
class Memcached {
	private $expire;
	private $cache;

	public function __construct($expire) {
		$this->expire = $expire;

		$this->cache = new \Memcached();
		$this->cache->addServer(CACHE_HOSTNAME, CACHE_PORT);
	}

	public function get($key) {
		return $this->cache->get(CACHE_PREFIX . $key);
	}

	public function set($key,$value) {
		return $this->cache->set(CACHE_PREFIX . $key, $value, $this->expire);
	}

	public function delete($key) {
		$this->cache->delete(CACHE_PREFIX . $key);
	}
}