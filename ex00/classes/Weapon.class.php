<?php

abstract class Weapon extends Base
{
	protected $power;
	protected $name;

	public function __construct($name, $power)
	{
		$this->name = (string)$name;
		$this->power = (int)$power;
	}

	public function improvePower($pp)
	{
		$this->power += $pp;
	}
}