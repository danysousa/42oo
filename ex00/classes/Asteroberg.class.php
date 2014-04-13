<?php

class Asteroberg extends Block
{
	const W = 10;
	const H = 10;
	const SPRITE = "/ex00/img/Asteroberg_{{dir}}.png";
	
	public function __construct($x, $y, Player $player)
	{
		$name = "Astero Berg of Wrath";
		$w = self::W;
		$h = self::H;
		$pp = 0;
		$pv = 9999;
		$sprite = self::SPRITE;
		parent::__construct($x, $y, $h, $w, $pv, $name, $sprite, $player);
	}
}