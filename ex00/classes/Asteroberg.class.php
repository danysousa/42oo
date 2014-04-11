<?php

class Asteroberg extends Block
{
	public function __construct($x, $y, Player $player)
	{
		$name = "Astero Berg of Wrath";
		$w = 5;
		$h = 5;
		$pp = 0;
		$pv = 9999;
		$sprite = "";
		parent::__construct($x, $y, $h, $w, $pv, $name, $sprite, $player);
	}
}