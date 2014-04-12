<?php

return function() {

	$login = app()->get('session')->get('login');

	if ($login === false) {
		die('Must be logged in.');
	}

	echo app()->get('view')->render('army');
};