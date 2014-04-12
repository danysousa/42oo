<?php

return function() {
	$gameName = trim((string)$_POST['create_game_name']);

	$user = app()->get('session')->get('user');

	if ($gameName !== '') {
		// save game
	} else {
		// return errors
	}
};