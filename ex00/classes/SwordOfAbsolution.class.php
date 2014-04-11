<?php

class SwordOfAbsolution extends Ship
{
	const W = 10;
	const H = 15;
	
	public function __construct($x, $y, Player $player)
	{
		$name = "Sword Of Absolution";
		$w = self::W;
		$h = self::H;
		$pp = 10;
		$pv = 4;
		$speed = 18;
		$inertia = 3;
		$shield = 0;
		$sprite = "/ex00/img/SwordOfAbsolution_{{dir}}.png";
		$weapon = array();
		parent::__construct($x, $y, $h, $w, $pv, $name, $sprite, $player, $speed, $inertia, $shield, $weapon);
	}
}