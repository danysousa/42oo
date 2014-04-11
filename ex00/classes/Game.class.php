<?php

class Game extends Base
{
	protected $ships = array();
	protected $blocks = array();
	protected $players = array();
	protected $currentPlayer;
	protected $locked = false;
	protected $collisionMatrix;
	const FILE = '/../game.txt';

	public function __construct()
	{
		$this->setCurrentPlayer(0);
		$this->collisionMatrix = new CollisionMatrix();
	}

	// lock players, ships and blocks so the game can start
	public function lock()
	{
		$this->setLocked(true);
	}

	public function addShip(Ship $ship)
	{
		if ($this->getLocked())
			throw new Exception('Cannot add ship as game is locked.');
		$this->ships[] = $ship;
		$this->collisionMatrix->addObject($ship);
	}

	public function addBlock(Block $block)
	{
		if ($this->getLocked())
			throw new Exception('Cannot add block as game is locked.');
		$this->blocks[] = $block;
		$this->collisionMatrix->addObject($block);
	}

	public function addPlayer(Player $player)
	{
		if ($this->getLocked())
			throw new Exception('Cannot add player as game is locked.');
		$this->players[] = $player;
	}

	public function start()
	{
		$this->lock();
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
		if (!$this->getLocked())
			throw new Exception('Cannot play a turn while the game is unlocked.');
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

	public function toJson()
	{
		$objects = array();
		foreach ($this->getShips() as $s)
			$objects[] = $s->toJson();
		foreach ($this->getBlocks() as $b)
			$objects[] = $b->toJson();
		return $objects;
	}
}