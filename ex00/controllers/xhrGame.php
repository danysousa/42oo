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
	$game = app()->get('db')->queryOne("SELECT * FROM partie WHERE id = ?", [
		$user['id_partie']
	]);
	if ($game === null) {
		die(json_encode(null));
	}
	$players = app()->get('db')->query("SELECT id, name, id_partie, score, defaite FROM user WHERE id_partie = ?", [
		$game['id']
	]);
	// ...
	echo json_encode($game);
};