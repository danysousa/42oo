<?php

abstract class MapObject extends Base
{
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

	public function __construct($x, $y, $h, $w, $pv, $name, $sprite, Player $player, $speed = 0, $inertia = 0, $shield = 0, array $weapons = array())
	{
		$this->setX($x);
		$this->setY($y);
		$this->setH($h);
		$this->setW($w);
		$this->setPv($pv);
		$this->setSprite($sprite);
		$this->setPlayer($player);
		$this->setSpeed($speed);
		$this->setInertia($inertia);
		$this->setShield($shield);
		$this->setWeapons($weapons);
		$this->setName($name);
	}

	public function alive()
	{
		return $this->pv <= 0;
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
		$this->speed += $pp;
	}

	public function improvePv($pp)
	{
		$this->speed += $pp;
	}
}