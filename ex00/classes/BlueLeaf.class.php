<?php

class BlueLeaf extends Ship
{
	const W = 12;
	const H = 12;
	const SPEED = 18;
	
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
		$sprite = "/ex00/img/BlueLeaf_{{dir}}.png";
		$weapon = array();
		parent::__construct($x, $y, $h, $w, $pv, $name, $sprite, $player, $speed, $inertia, $shield, $weapon);
	}
}