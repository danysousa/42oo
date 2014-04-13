<?php

return function() {
	$login = app()->get('session')->get('login');

	if ($login === false) {
		die('Must be logged in.');
	}

	// get player game
	// get ship and check if ship belongs to player
	// check if player is up to play
	// check that player has PP === game_pp (which means he can do the repartition)
	// check that repartition <= game_pp
	// do repartition
};