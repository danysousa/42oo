<?php

return function() {

	$login = app()->get('session')->get('login');

	if ($login === false) {
		header('location: index.php?action=login');
		die();
	}

	echo app()->get('view')->render('army');
};