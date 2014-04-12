<?php

return function() {
	$gameName = trim((string)$_POST['create_game_name']);
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

	app()->get('db')->query("INSERT INTO partie (pts, id_admin, id_current_player, start, max_player, name) VALUES (?, ?, ?, ?, ?, ?)", [
		500, // ship points
		$user['id'],
		$user['id'],
		false,
		4, // max players
		$gameName
	]);

	echo 'Successfully created the game!';
};