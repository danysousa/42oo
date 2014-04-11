<?php

abstract class Base
{
	public function __call($method, $args)
	{
		// get type: setter or getter
		$type = substr($method, 0, 3);
		// remove 'get' or 'set'
		$propertyName = lcfirst(substr($method, 3));
		if ($type === 'set')
		{
			$this->$propertyName = $args[0];
			return $this;
		}
		else if ($type === 'get')
		{
			return $this->$propertyName;
		}
		// nothing found, throw
		throw new Exception();
	}
}