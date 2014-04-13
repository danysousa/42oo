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

	$shipId = (int)$_JSON['shipId'];
	$ship = app()->get('db')->queryOne("SELECT * FROM vaisseau WHERE id = ?", [$shipId]);

	if ($ship === null) {
		die('No ship with that id for the current player.');
	}

	if ($ship['has_allocated'] === 1) {
		die('Already allocated PP.');
	}

	// check max PP
	$weaponPp = (int)$_JSON['weaponPp'];
	$movePp = (int)$_JSON['movePp'];
	if ($weaponPp + $movePp > GAME_PP) {
		die('Too many PP used.');
	}

	// do repartition
	app()->get('db')->query("UPDATE user SET id_vaisseau = ? WHERE id = ?", [$ship['id'], $player['id']]);
	app()->get('db')->query("UPDATE vaisseau SET has_allocated = 1, pp_gun = ?, pp_move = ? WHERE id = ?", [
		$weaponPp,
		$movePp,
		$ship['id']
	]);
};