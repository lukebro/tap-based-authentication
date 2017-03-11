<?php

namespace App\Compare;

class CosineSimilarity extends VectorComparer  {

	public function compare(array $key, array $attempt)
	{
		if (count($key[0]) != count($attempt)) {
			return 1;
		}

		$score = [];

        foreach ($key as $part) {
            $score[] = $this->similarity($attempt, $part);
        }

        return 1 - max($score);
	}

	protected function similarity(array $x, array $y)
	{
		$numerator = $this->multiply_sum($x, $y);
		$denominator = $this->rms($x) * $this->rms($y);

		return round($numerator / floatval($denominator), $this->decimals);
	}

	private function multiply_sum(array $x, array $y)
	{
		return array_sum(array_map(function ($a, $b) {
			return $a * $b;
		}, $x, $y));
	}

}
