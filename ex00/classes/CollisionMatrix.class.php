<?php

class CollisionMatrix extends Base
{
	protected $table = array();

	public function __construct()
	{
		$i = -1;
		while (++$i < GAME_NUM_COLS)
		{
			$this->table[$i] = array();
			$j = -1;
			while (++$j < GAME_NUM_ROWS)
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
		while (++$i < GAME_NUM_COLS)
		{
			$j = -1;
			while (++$j < GAME_NUM_ROWS)
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