<?php

class BloodPuller extends Ship
{
	const W = 14;
	const H = 14;
	const SPEED = 10;
	
	public function __construct($x, $y, Player $player)
	{
		$name = "Blood Puller";
		$w = self::W;
		$h = self::H;
		$pp = 22;
		$pv = 5;
		$speed = self::SPEED;
		$inertia = 10;
		$shield = 2;
		$sprite = "/ex00/img/BloodPuller_{{dir}}.png";
		$weapon = array();
		parent::__construct($x, $y, $h, $w, $pv, $name, $sprite, $player, $speed, $inertia, $shield, $weapon);
	}
}