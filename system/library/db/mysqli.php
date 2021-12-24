<?php
namespace DB;
final class MySQLi {
	private $link;

	public function __construct($hostname, $username, $password, $database, $port = '3306', $socket='/var/lib/mysql/mysql.sock') { 
		$this->link = new \mysqli($hostname, $username, $password, $database, $port, $socket);

		if ($this->link->connect_error) {
			trigger_error('Error: Could not make a database link (' . $this->link->connect_errno . ') ' . $this->link->connect_error);
			exit();
		}

		$this->link->set_charset("utf8");
		$this->link->query("SET SQL_MODE = ''");
                // echo $this->link->host_info. "\n";
	}

	public function set_charset_utf8mb4() {
        mysqli_set_charset($this->link,'utf8mb4');
    }

	public function query($sql) {

		//$query = $this->link->query($sql);

		if (defined("IS_DEBUG") && IS_DEBUG) {
			global $debugModelQueries;

			$startTime = microtime(true);
			$query = $this->link->query($sql);
			$executeTimeQuery = microtime(true) - $startTime;

			$debugBacktrace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 3);

			$debugModelQueries[] = [
				'class' => (!empty($debugBacktrace[2]['class'])) ? $debugBacktrace[2]['class'] : '',
				'method' => (!empty($debugBacktrace[2]['function'])) ? $debugBacktrace[2]['function'] : '',
				'query' => $sql,
				'time'  => $executeTimeQuery,
				'file' => (!empty($debugBacktrace[2]['file'])) ? $debugBacktrace[2]['file'] : $debugBacktrace[1]['file'],
				'class:method' => (!empty($debugBacktrace[2]['class'])) ? $debugBacktrace[2]['class'] . '->' . $debugBacktrace[2]['function'] : '',
			];
		} else {
			$query = $this->link->query($sql);
		}

		if (!$this->link->errno) {
			if ($query instanceof \mysqli_result) {
				$data = array();

				while ($row = $query->fetch_assoc()) {
					$data[] = $row;
				}

				$result = new \stdClass();
				$result->num_rows = $query->num_rows;
				$result->row = isset($data[0]) ? $data[0] : array();
				$result->rows = $data;

				$query->close();

				return $result;
			} else {
				return true;
			}
		} else {
			trigger_error('Error: ' . $this->link->error  . '<br />Error No: ' . $this->link->errno . '<br />' . $sql);
		}
	}

	public function escape($value) {
		return $this->link->real_escape_string($value);
	}

	public function countAffected() {
		return $this->link->affected_rows;
	}

	public function getLastId() {
		return $this->link->insert_id;
	}

	public function __destruct() {
		$this->link->close();
	}
}