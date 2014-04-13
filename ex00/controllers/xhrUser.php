<?php

return function() {
	$login = app()->get('session')->get('login');

	header('content-type: application/json');

	if ($login === false) {
		die(json_encode(null));
	}
	$user = app()->get('db')->queryOne("SELECT id, name, id_partie, score, defaite, id_vaisseau FROM user WHERE name = ?", [
		$login
	]);
	if ($user === null) {
		die(json_encode(null));
	}
	$game = app()->get('db')->queryOne("SELECT id_current_player FROM partie WHERE id = ?", [$user['id_partie']]);
	if ($game) {
		$user['must_play'] = $game['id_current_player'] === $user['id'];
	} else {
		$user['must_play'] = false;
	}
	echo json_encode($user);
};