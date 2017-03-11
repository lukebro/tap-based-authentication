<?php

namespace App\Compare;

abstract class VectorComparer {

	protected $decimals = 4;

	abstract public function compare(array $key, array $attempt);

	/**
	 * Calculate the root mean square.
	 * @param  array  $values
	 * @return flaot
	 */
	protected function rms(array $values)
	{
		return round(sqrt(array_sum(array_map(function ($value) {
			return $value * $value;
		}, $values))), $this->decimals);
	}


}
