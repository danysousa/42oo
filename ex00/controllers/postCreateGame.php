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
		(int)$_POST['create_ship_points'],
		$user['id'],
		$user['id'],
		false, // not yet started
		(int)$_POST['create_max_players'],
		$gameName
	]);
	$id_partie = app()->get('db')->query("SELECT id FROM partie WHERE name LIKE ?", array(
		$gameName
	));
	app()->get('db')->query("UPDATE user SET id_partie = ? WHERE id LIKE ?", array(
		$id_partie[0]['id'],
		app()->get('session')->get('id_usr')
	));

	echo 'Successfully created the game!';
};