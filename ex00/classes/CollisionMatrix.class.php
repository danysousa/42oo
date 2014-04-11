<?php

class CollisionMatrix extends Base
{
	protected $table = array();

	public function __construct()
	{
		$i = -1;
		while (++$i < 100)
		{
			$this->table[$i] = array();
			$j = -1;
			while (++$j < 150)
			{
				$this->table[$i][$j] = 0;
			}
		}
	}

	public function addObject(MapObject $o)
	{
		$i = $o->getY();
		while (++$i < $o->getY() + $o->getH())
		{
			$j = $o->getX();
			while (++$j < $o->getX() + $o->getW())
				$this->table[$i][$j] = 1;
		}
	}

	public function collision(MapObject $o)
	{
		$i = -1;
		while (++$i < 100)
		{
			$j = -1;
			while (++$j < 150)
			{
				if ($o->getX() <= $j && $j <= $o->getX() + $o->getW() && $o->getY() <= $i && $i <= $o->getY() + $o->getH())
				{
					if ($this->table[$i][$j] == 1)
						return true;
				}
			}
		}
		return false;
	}
}