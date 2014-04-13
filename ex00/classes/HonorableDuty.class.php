<?php

class HonorableDuty extends Ship
{
	const W = 10;
	const H = 15;
	const SPEED = 15;
	const SPRITE = "/ex00/img/HonorableDuty_{{dir}}.png";

	public function __construct($x, $y, Player $player)
	{
		$name = "Honorable Duty";
		$w = self::W;
		$h = self::H;
		$pp = 10;
		$pv = 5;
		$speed = self::SPEED;
		$inertia = 4;
		$shield = 0;
		$sprite = self::SPRITE;
		$weapon = array();
		parent::__construct($x, $y, $h, $w, $pv, $name, $sprite, $player, $speed, $inertia, $shield, $weapon);
	}
}