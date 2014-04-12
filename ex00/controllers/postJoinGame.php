<?php

return function() {
	$gameName = trim((string)$_POST['join_game_login']);
	$login = app()->get('session')->get('login');

	if ($login === false) {
		die('Must be logged in.');
	}

	if ($gameName === '') {
		die('Game name cannot be empty.');
	}

	$user = app()->get('db')->queryOne("SELECT * FROM user WHERE name = ?", [$login]);
	if ($user === null) {
		die('Logged in user does not exist (weird, right?).');
	}

	$id = app()->get('db')->queryOne("SELECT id FROM partie WHERE name = ?", [$gameName]);
	if ($id === null) {
		die('Game does not exist.');
	}

	app()->get('db')->query("UPDATE user SET id_partie = ? WHERE id = ?", [$id, $user['id']]);

	echo 'Successfully joined the game!';
};