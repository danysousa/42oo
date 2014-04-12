<?php

return function() {
	$gameName = trim((string)$_POST['create_game_name']);

	if ($gameName !== '') {
		// save game
	} else {
		// return errors
	}
};