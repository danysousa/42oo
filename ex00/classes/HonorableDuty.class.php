<?php

class HonorableDuty extends Ship
{
	public function __construct($x, $y, Player $player)
	{
		$name = "Honorable Duty";
		$w = 1;
		$h = 4;
		$pp = 10;
		$pv = 5;
		$speed = 15;
		$inertia = 4;
		$shield = 0;
		$sprite = "";
		$weapon = array();
		parent::__construct($x, $y, $h, $w, $pv, $name, $sprite, $player, $speed, $inertia, $shield, $weapon);
	}
}