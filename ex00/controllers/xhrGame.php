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
	// get ships for all users
	$ships = app()->get('db')->query(
		"SELECT v.id ship_id, v.class ship_class, v.posX ship_posX, v.posY ship_posY, v.pv ship_pv, v.portee ship_range, v.mobile ship_mobile, u.id user_id, u.name user_name
		FROM flotte f JOIN vaisseau v
		ON f.id_vaisseau = v.id JOIN user u
		ON u.id = f.id_user JOIN partie p
		ON p.id = ?", [
		$game['id']
	]);

	$game['ships'] = $ships;

	echo json_encode($game);
};