<?php

class Player extends Base
{
	protected $name;
	protected $pp;
	protected $active;
	protected $sessionId;

	const INACTIVE = false;
	const ACTIVE = true;

	public function __construct($name, $active, $sessionId)
	{
		$this->setName($name);
		$this->setPp(0);
		$this->setActive($active);
		$this->setSessionId($sessionId);
	}

	public function toJson()
	{
		return array(
			'name' => $this->getName(),
			'id' => hash('sha512', $this->getSessionId()),
			'active' => $this->getActive()
		);
	}
}