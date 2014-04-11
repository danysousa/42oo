<?php

abstract class Ship extends Base
{
	protected $name;
	// height
	protected $h;
	// width
	protected $w;
	// image that repsesents the ship on the canvas
	protected $sprite;
	// number of hits a ship can take
	protected $pv;
	// speed
	protected $speed;
	// maneouvrabilite
	protected $inertia;
	// bouclier
	protected $shield;
	// weapons
	protected $weapons = array();
	//pos_x
	protected $x;
	//pos_y
	protected $y;
	//player
	protected $player;

	public function __construct($info)
	{
		$this->name = (string)$info['name'];
		$this->h = (int)$info['h'];
		$this->w = (int)$info['w'];
		$this->sprite = (string)$info['sprite'];
		$this->pv = (int)$info['pv'];
		$this->speed = (int)$info['speed'];
		$this->intertia = (int)$info['inertia'];
		$this->shield = (int)$info['shield'];
		$this->x = $info['x'];
		$this->y = $info['y'];
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

	public function alive()
	{
		return $this->pv <= 0;
	}
}