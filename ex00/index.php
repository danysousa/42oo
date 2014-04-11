<?php

session_start();

spl_autoload_register(function($class)
{
	require_once __DIR__ . '/classes/' . $class . '.class.php';
});

if (Game::exists())
{
	$game = Game::loadFromFile();
}
else
{
	$game = new Game();
	$game->addPlayer($neutralPlayer = new Player("Switzerland", Player::INACTIVE));
	$game->addPlayer($p1 = new Player("Conrad", Player::ACTIVE));
	$game->addPlayer($p2 = new Player("Arthur", Player::ACTIVE));
	$game->addShip(new SwordOfAbsolution(0, 0, $p1));
	$game->addShip(new HonorableDuty(148, 95, $p2));
	$game->addBlock(new Asteroberg(30, 30, $neutralPlayer));
	// add ships etc...
}

include 'templates/game.php';