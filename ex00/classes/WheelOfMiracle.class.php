<?php

class WheelOfMiracle extends Ship
{
	const W = 13;
	const H = 13;
	const SPEED = 6;
	const SPRITE = "/ex00/img/WheelOfMiracle_{{dir}}.png";
	
	public function __construct($x, $y, Player $player)
	{
		$name = "Wheel Of Miracle";
		$w = self::W;
		$h = self::H;
		$pp = 20;
		$pv = 10;
		$speed = self::SPEED;
		$inertia = 10;
		$shield = 2;
		$sprite = self::SPRITE;
		$weapon = array();
		parent::__construct($x, $y, $h, $w, $pv, $name, $sprite, $player, $speed, $inertia, $shield, $weapon);
	}
}