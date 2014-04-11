<?php

class Player extends Base
{
	protected $name;

	public function __construct($name)
	{
		$this->setName($name);
	}
}