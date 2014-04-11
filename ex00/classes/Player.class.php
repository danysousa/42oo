<?php

class Player extends Base
{
	protected $name;
	protected $pp;
	protected $active;

	const INACTIVE = false;
	const ACTIVE = true;

	public function __construct($name, $active)
	{
		$this->setName($name);
		$this->setPp(0);
		$this->setActive($active);
	}
}