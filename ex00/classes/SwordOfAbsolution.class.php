<?php

class SwordOfAbsolution extends Ship
{
	public function __construct($x, $y, Player $player)
	{
		$name = "Sword Of Absolution";
		$w = 1;
		$h = 3;
		$pp = 10;
		$pv = 4;
		$speed = 18;
		$inertia = 3;
		$shield = 0;
		$sprite = "";
		$weapon = array();
		parent::__construct($x, $y, $h, $w, $pv, $name, $sprite, $player, $speed, $inertia, $shield, $weapon);
	}
}