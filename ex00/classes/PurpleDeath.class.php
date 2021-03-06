<?php

class PurpleDeath extends Ship
{
	const W = 8;
	const H = 13;
	const SPEED = 11;
	const SPRITE = "/ex00/img/PurpleDeath_{{dir}}.png";

	public function __construct($x, $y, Player $player)
	{
		$name = "Purple Death";
		$w = self::W;
		$h = self::H;
		$pp = 18;
		$pv = 3;
		$speed = self::SPEED;
		$inertia = 6;
		$shield = 1;
		$sprite = self::SPRITE;
		$weapon = array();
		parent::__construct($x, $y, $h, $w, $pv, $name, $sprite, $player, $speed, $inertia, $shield, $weapon);
	}
}