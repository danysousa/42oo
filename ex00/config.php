<?php

$GLOBALS['DB_NAME'] = 'rush';
$GLOBALS['DB_USER'] = 'root';
$GLOBALS['DB_PASSWORD'] = 'helloworld';

if (@file_exists(__DIR__ . '/config_custom.php'))
	require_once __DIR__ . '/config_custom.php';