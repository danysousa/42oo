<?php

class Session {
	public function __construct() {
		session_start();
	}

	public function get($k) {
		if (!isset($_SESSION[$k]))
			return false;
		return $_SESSION[$k];
	}

	public function set($k, $v) {
		$_SESSION[$k] = $v;
	}

	public function flush() {
		session_destroy();
		session_regenerate_id();
	}
}