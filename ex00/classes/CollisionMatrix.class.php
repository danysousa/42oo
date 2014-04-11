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
		// north of south
		if ($o->getDirection() % 2 === 1)
		{
			$i = $o->getY();
			while (++$i < $o->getY() + $o->getH())
			{
				$j = $o->getX();
				while (++$j < $o->getX() + $o->getW())
					$this->table[$i][$j] = 1;
			}
		}
		else
		{
			// west / east
			$i = $o->getY();
			while (++$i < $o->getY() + $o->getW())
			{
				$j = $o->getX();
				while (++$j < $o->getX() + $o->getH())
					$this->table[$i][$j] = 1;
			}
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
				// north or south
				if ($o->getDirection() % 2 === 1)
				{
					if ($o->getX() <= $j && $j <= $o->getX() + $o->getW() && $o->getY() <= $i && $i <= $o->getY() + $o->getH())
					{
						if ($this->table[$i][$j] == 1)
							return true;
					}
				}
				else
				{
					// west / east
					if ($o->getX() <= $j && $j <= $o->getX() + $o->getH() && $o->getY() <= $i && $i <= $o->getY() + $o->getW())
					{
						if ($this->table[$i][$j] == 1)
							return true;
					}
				}
			}
		}
		return false;
	}
}