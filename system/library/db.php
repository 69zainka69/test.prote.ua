<?php
class DB {
	private $db;
	// OCFilter query log start
  	public $log = array();
  	public $time = 0;
  	// OCFilter query log end

	public function __construct($driver, $hostname, $username, $password, $database, $port = NULL) {
		$class = 'DB\\' . $driver;

		if (class_exists($class)) {
			$this->db = new $class($hostname, $username, $password, $database, $port);
		} else {
			exit('Error: Could not load database driver ' . $driver . '!');
		}
	}

	public function query($sql) {
		
		// OCFilter query log start
	    /*$time_start = microtime(true);

	    $query = $this->db->query($sql);

	    $time = microtime(true) - $time_start;

	    $this->time += $time;

	    $this->log[] = array(
	      'sql' => $sql,
	      'time' => $time
	    );

	    return $query;*/
	    // OCFilter query log end

	    return $this->db->query($sql);
	}

	public function escape($value) {
		return $this->db->escape($value);
	}

	public function countAffected() {
		return $this->db->countAffected();
	}

	public function getLastId() {
		return $this->db->getLastId();
	}
    public function set_charset_utf8mb4() {
        $this->db->set_charset_utf8mb4();
    }
}
