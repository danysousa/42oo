<?php

return function() {
	$gameName = trim((string)$_POST['join_game_login']);

	if ($gameName !== '') {
		// save game
	} else {
		// return errors
	}
};