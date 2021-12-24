<?php
ini_set("memory_limit","512M");

ini_set('max_execution_time', 600003);
class Cache {
	private $cache;
	private $expire;
	public function __construct($driver, $expire = 86400) {
		$class = 'Cache\\' . $driver;

		if (class_exists($class)) {
			$this->cache = new $class($expire);
		} else {
			exit('Error: Could not load cache driver ' . $driver . ' cache!');
		}
	}

	public function get($key) {
		return $this->cache->get($key);
	}

	public function set($key, $value) {
		return $this->cache->set($key, $value);
	}

	public function delete($key) {
		return $this->cache->del($key);
	}
	public function del($key) {
		return $this->cache->del($key);
	}
}
