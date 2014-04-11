<?php

class Block extends MapObject
{
	public function __construct($info)
	{
		parent::__construct($info['x'], $info['y'], $info['w'], $info['h'], $info['name']);
	}
}