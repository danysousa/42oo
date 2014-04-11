<?php

class Game extends Base
{
	protected $ships = array();
	protected $blocks = array();
	protected $players = array();
	protected $currentPlayer;
	protected $locked = false;
	const FILE = '/../game.txt';

	public function __construct()
	{
		$this->setCurrentPlayer(0);
	}

	public function hasCollision(MapObject $o)
	{
		$collisionMatrix = new CollisionMatrix(GAME_NUM_ROWS, GAME_NUM_COLS);
		foreach ($this->getShips() as $s)
		{
			if ($s !== $o)
				$collisionMatrix->addObject($s);
		}
		foreach ($this->getBlocks() as $b)
		{
			if ($b !== $o)
				$collisionMatrix->addObject($b);
		}
		return $collisionMatrix->collision($o);
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
		$this->ships[$ship->getId()] = $ship;
	}

	public function addBlock(Block $block)
	{
		if ($this->getLocked())
			throw new Exception('Cannot add block as game is locked.');
		$this->blocks[$block->getId()] = $block;
	}

	public function addPlayer(Player $player)
	{
		if ($this->getLocked())
			throw new Exception('Cannot add player as game is locked.');
		$this->players[$player->getId()] = $player;
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

	public function playerShips(Player $p)
	{
		$ships = array();
		foreach ($this->getShips() as $s)
		{
			if ($s->getPlayer() === $p)
				$ships[] = $s->toJson();
		}
		return $ships;
	}

	public function currentPlayerShips()
	{
		$id = session_id();
		foreach ($this->getPlayers() as $p)
		{
			if ($p->getSessionId() === $id)
				return $this->playerShips($p);
		}
		return array();
	}
}