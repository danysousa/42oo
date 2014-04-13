<?php

class SwordOfAbsolution extends Ship
{
	const W = 8;
	const H = 10;
	const SPEED = 15;
	const SPRITE = "/ex00/img/SwordOfAbsolution_{{dir}}.png";
	
	public function __construct($x, $y, Player $player)
	{
		$name = "Sword Of Absolution";
		$w = self::W;
		$h = self::H;
		$pp = 10;
		$pv = 4;
		$speed = self::SPEED;
		$inertia = 3;
		$shield = 0;
		$sprite = self::SPRITE;
		$weapon = array();
		parent::__construct($x, $y, $h, $w, $pv, $name, $sprite, $player, $speed, $inertia, $shield, $weapon);
	}
}