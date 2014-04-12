<?php

// view engine
class View {
	private $_root;

	public function __construct($root) {
		$this->_root = $root;
	}

	public function render($___template, array $___context = array()) {
		$___template = $this->_root . '/' . $___template . '.php';
		ob_start();
		extract($___context);
		include $___template;
		$___compiled = ob_get_contents();
		ob_end_clean();
		return $___compiled;
	}
}