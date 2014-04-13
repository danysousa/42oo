<?php

class BloodPuller extends Ship
{
	const W = 13;
	const H = 8;
	const SPEED = 10;
	const SPRITE = "/ex00/img/BloodPuller_{{dir}}.png";

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
		$sprite = self::SPRITE;
		$weapon = array();
		parent::__construct($x, $y, $h, $w, $pv, $name, $sprite, $player, $speed, $inertia, $shield, $weapon);
	}
}