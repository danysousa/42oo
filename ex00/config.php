<?php

define('DB_NAME', 'rush');
define('DB_USER', 'root');
define('DB_PASSWORD', 'rootroot');

if (@file_exists(__DIR__ . '/config_custom.php'))
	require_once __DIR__ . '/config_custom.php';