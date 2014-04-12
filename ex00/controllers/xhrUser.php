<?php

return function() {
	$login = app()->get('session')->get('login');

	header('content-type: application/json');

	if ($login === false) {
		die(json_encode(null));
	}
	$user = app()->get('db')->queryOne("SELECT id, name, id_partie, score, defaite FROM user WHERE name = ?", [
		$login
	]);
	if ($user === null) {
		die(json_encode(null));
	}
	echo json_encode($user);
};