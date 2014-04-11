<?php

class Asteroberg extends Block
{
	const W = 10;
	const H = 10;
	
	public function __construct($x, $y, Player $player)
	{
		$name = "Astero Berg of Wrath";
		$w = self::W;
		$h = self::H;
		$pp = 0;
		$pv = 9999;
		$sprite = "/ex00/img/Asteroberg_{{dir}}.png";
		parent::__construct($x, $y, $h, $w, $pv, $name, $sprite, $player);
	}
}