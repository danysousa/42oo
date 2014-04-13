<?php

class BlueLeaf extends Ship
{
	const W = 7;
	const H = 12;
	const SPEED = 18;
	const SPRITE = "/ex00/img/BlueLeaf_{{dir}}.png";

	public function __construct($x, $y, Player $player)
	{
		$name = "Blue Leaf";
		$w = self::W;
		$h = self::H;
		$pp = 12;
		$pv = 3;
		$speed = self::SPEED;
		$inertia = 4;
		$shield = 0;
		$sprite = self::SPRITE;
		$weapon = array();
		parent::__construct($x, $y, $h, $w, $pv, $name, $sprite, $player, $speed, $inertia, $shield, $weapon);
	}
}