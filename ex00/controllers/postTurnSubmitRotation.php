<?php

return function() {

	$_JSON = json_decode(file_get_contents('php://input'), TRUE);
	$login = app()->get('session')->get('login');

	if ($login === false) {
		die('Must be logged in.');
	}

	$player = app()->get('db')->queryOne("SELECT * FROM user WHERE name = ?", [$login]);

	if ($player === null) {
		die('Player does not exist.');
	}

	$game = app()->get('db')->queryOne("SELECT * FROM partie WHERE id = ?", [$player['id_partie']]);

	if ($game === null) {
		die('Player has no valid game.');
	}

	if ($game['id_current_player'] !== $player['id']) {
		die('Not your turn.');
	}

	$ship = app()->get('db')->queryOne("SELECT * FROM vaisseau WHERE id = ?", [$player['id_vaisseau']]);

	if ($ship === null) {
		die('No ship with that id for the current player.');
	}

	if ($ship['has_allocated'] === 0) {
		die('Please, allocate PP.');
	}

	if ($ship['has_rotated'] === 1) {
		die('Already rotated.');
	}

	if (!in_array($_JSON['direction'], ['north', 'east', 'west', 'south'], true)) {
		die('Invalid direction.');
	}

	// do rotation
	app()->get('db')->query("UPDATE user SET id_vaisseau = ? WHERE id = ?", [$ship['id'], $player['id']]);
	app()->get('db')->query("UPDATE vaisseau SET has_rotated = 1, rot = ? WHERE id = ?", [
		$_JSON['direction'],
		$ship['id']
	]);

	header('content-type: application/json');
	echo 'true';
};