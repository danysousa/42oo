<?php

class Game extends Base
{
	protected $ships = array();
	protected $blocks = array();
	protected $players = array();
	protected $currentPlayer;
	const FILE = '/game.save';

	public function __construct()
	{
		$this->setCurrentPlayer(0);
	}

	public function addShip(Ship $ship)
	{
		$this->ships[] = $ship;
	}

	public function addBlock(Block $block)
	{
		$this->blocks[] = $block;
	}

	public function addPlayer(Player $player)
	{
		$this->players[] = $player;
	}

	public function start()
	{
		$this->playTurn();
	}

	// deletes the current game
	public function reload()
	{
		@unlink(__DIR__ . self::FILE);
	}

	private function updateCurrentPlayer()
	{
		if (count($this->players) > $this->currentPlayer)
			$this->currentPlayer++;
		else
			$this->currentPlayer = 0;
	}

	public function playTurn()
	{
		$this->updateCurrentPlayer();
	}

	public function save()
	{
		@file_put_contents(__DIR__ . self::FILE, serialize($this));
	}

	static public function exists()
	{
		return @file_exists(__DIR__ . self::FILE);
	}

	static public function loadFromFile()
	{
		return unserialize(file_get_contents(__DIR__ . self::FILE));
	}
}