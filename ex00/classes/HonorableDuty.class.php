<?php

class HonorableDuty extends Ship
{
	const W = 10;
	const H = 15;
	
	public function __construct($x, $y, Player $player)
	{
		$name = "Honorable Duty";
		$w = self::W;
		$h = self::H;
		$pp = 10;
		$pv = 5;
		$speed = 15;
		$inertia = 4;
		$shield = 0;
		$sprite = "/ex00/img/HonorableDuty_{{dir}}.png";
		$weapon = array();
		parent::__construct($x, $y, $h, $w, $pv, $name, $sprite, $player, $speed, $inertia, $shield, $weapon);
	}
}