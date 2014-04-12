<?php

class Database {
	// connection handle
	private $_conn;

	public function __construct($host, $user, $password, $name, $port = 3306) {
		$conn = @mysqli_connect($host, $user, $password, $name, $port);
		if ($conn === false)
			throw new Exception('Cannot connect to the database.');
		$this->_conn = $conn;
	}

	public function _getTypeFromValue($value) {
		if (is_int($value))
			return 'i';
		if (is_double($value))
			return 'd';
		if (is_string($value))
			return 's';
		return 'b';
	}

	// execute a db query and return all results in an assoc array
	public function query($sql, array $params = array()) {
		if (($stmt = mysqli_prepare($this->_conn, $sql)) === false) {
			throw new Exception('Could not prepare query: ' . $sql);
		}
		if (count($params) > 0) {
			$types = '';
			foreach ($params as $p) {
				$types .= $this->_getTypeFromValue($p);
			}
			$refs = array();
			foreach($params as $key => $value)
				$refs[$key] = &$params[$key];
			if (call_user_func_array('mysqli_stmt_bind_param', array_merge(array($stmt, $types), $refs)) === false) {
				throw new Exception('Could not bind param for query: ' . $sql);
			}
		}
		if (mysqli_stmt_execute($stmt) === false) {
			throw new Exception('Could not execute query: ' . $sql);
		}
		if (($result = mysqli_stmt_get_result($stmt)) === false) {
			return null;
		}
		return mysqli_fetch_all($result, MYSQLI_ASSOC);
	}

	// same as `query` but return only the first result
	public function queryOne($sql, array $params = array()) {
		$assoc = $this->query($sql, $params);
		if ($assoc === null || !isset($assoc[0]) || $assoc[0] === null)
			return null;
		return $assoc[0];
	}
}