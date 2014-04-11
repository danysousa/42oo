<?php

class Game extends Base
{
	private $ships = array();
	private $blocks = array();
	private $players = array();

	private $currentPlayer;

	public function addShip(Ship $ship) {
		$this->ships[] = $ship;
	}

	public function addBlock(Block $block) {
		$this->blocks[] = $block;
	}

	public function addPlayer(Player $player) {
		$this->players[] = $player;
	}

	public function start() {
		$this->currentPlayer = 0;

		$this->playTurn();
	}

	private function updateCurrentPlayer() {
		if (count($this->players) > $this->currentPlayer)
			$this->currentPlayer++;
		else
			$this->currentPlayer = 0;
	}

	public function playTurn() {
		$this->updateCurrentPlayer();
	}
}