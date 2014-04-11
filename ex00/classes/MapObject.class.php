<?php

abstract class MapObject extends Base
{
	const DIRECTION_WEST  = 0;
	const DIRECTION_SOUTH = 1;
	const DIRECTION_EAST  = 2;
	const DIRECTION_NORTH = 3;

	protected $x;
	protected $y;
	protected $h;
	protected $w;
	protected $pv;
	protected $sprite;
	protected $speed;
	protected $inertia;
	protected $shield;
	protected $weapons = array();
	protected $player;
	protected $name;

	// save initial values so we can reset everything on the next turn
	protected $initialPv;
	protected $initialSpeed;
	protected $initialInertia;
	protected $initialShield;

	protected $direction;
	protected $id;

	public function __construct($x, $y, $h, $w, $pv, $name, $sprite, Player $player, $speed = 0, $inertia = 0, $shield = 0, array $weapons = array())
	{
		$this->setX($x);
		$this->setY($y);
		$this->setH($h);
		$this->setW($w);
		$this->setSprite($sprite);
		$this->setPlayer($player);
		$this->setPv($pv);
		$this->setSpeed($speed);
		$this->setInertia($inertia);
		$this->setShield($shield);
		$this->setWeapons($weapons);
		$this->setName($name);

		$this->setInitialPv($pv);
		$this->setInitialSpeed($speed);
		$this->setInitialInertia($inertia);
		$this->setInitialShield($shield);

		$this->direction = rand(0, 3);
		$this->id = (int)microtime(true);
	}

	public function reset()
	{
		$this->setPv($this->getInitialPv());
		$this->setSpeed($this->getInitialSpeed());
		$this->setInertia($this->getInitialInertia());
		$this->setShield($this->getInitialShield());
	}

	public function isAlive()
	{
		return $this->pv > 0;
	}

	public function attack(Ship $other, Weapon $weapon)
	{
		$power = $weapon->getPower();
		$shield = $other->getShield();
		$pv = $other->getPv();
		while ($power > 0) 
		{
			if ($shield > 0)
				$shield--;
			else
				$pv--;
 			$power--;
		}
		$other->setShield($shield);
		$other->setPv($pv);
	}

	public function addWeapon(Weapon $weapon)
	{
		$this->weapons[] = $weapon;
	}

	public function improveShield($pp)
	{
		$this->shield += $pp;
	}

	public function improveSpeed($pp)
	{
		$this->speed += $pp;
	}

	public function improveInertia($pp)
	{
		$this->inertia -= $pp;
	}

	public function improvePv($pp)
	{
		$this->pv += $pp;
	}

	public function toJson()
	{
		return array(
			'name' => $this->getName(),
			'sprite' => $this->getSprite(),
			'speed' => $this->getSpeed(),
			'inertia' => $this->getInertia(),
			'pv' => $this->getPv(),
			'shield' => $this->getShield(),
			'x' => $this->getX(),
			'y' => $this->getY(),
			'w' => $this->getW(),
			'h' => $this->getH(),
			'alive' => $this->isAlive(),
			'player' => $this->getPlayer()->toJson(),
			'direction' => $this->getDirection()
		);
	}
}