<?php

namespace App;

use Illuminate\Support\Collection;

class TapComparer {

	public static function score($attempt, MasterKey $key) {
		$attempt = TapComparer::normalize(collect($attempt));

		$mean = $key->sequence;
		$std = $key->std;

		if (count($attempt) != count($mean)) {
			return 1000;
		}

		$score = 0;

		for ($i = 0; $i < count($mean); $i++) {
			$score += TapComparer::tapScore($attempt[$i], $mean[$i], $std[$i]);
		}

		return $score;
	}

	public static function tapScore($attempt, $master, $std)
	{
		$score = 0;
		$score += TapComparer::ssmd($attempt['start'], $master['start'], $std['start']);
		$score += TapComparer::ssmd($attempt['end'], $master['end'], $std['end']);

		return $score;
	}

	public static function ssmd($attempt, $master, $std)
	{
		if ($std == 0) {
			return abs($master - $attempt);
		}

		return abs($master - $attempt) / $std;
	}

	public static function collect(array $sequences)
	{
		$sequences = collect($sequences);

		return $sequences->map(function ($sequence) {
			return collect($sequence);
		});
	}

	public static function normalize(Collection $sequence)
	{
		$base = $sequence->first()['start'];

		return $sequence->map(function ($sequence) use ($base) {
			return [
				'start' => $sequence['start'] - $base,
				'end' => $sequence['end'] - $base
			];
		});
	}

	public static function std(Collection $sequences, Collection $mean)
	{
		$count = $sequences->first()->count();
		$std = collect();


		for ($i = 0; $i < $count; $i++) {
			$stdStart = 0;
			$stdEnd = 0;
			for ($j = 0; $j < $sequences->count(); $j++) {
				$stdStart += pow($sequences->get($j)->get($i)['start'] - $mean->get($i)['start'], 2);
				$stdEnd += pow($sequences->get($j)->get($i)['end'] - $mean->get($i)['end'], 2);
			}

			$stdStart = sqrt($stdStart / $sequences->count());
			$stdEnd = sqrt($stdEnd / $sequences->count());

			$std->push([
				'start' => $stdStart,
				'end' => $stdEnd,
			]);
		}

		return $std;
	}

	public static function mean(Collection $sequences)
	{
		$count = $sequences->first()->count();
		$mean = collect();

		for ($i = 0; $i < $count; $i++) {
			$start = 0;
			$end = 0;
			for ($j = 0; $j < $sequences->count(); $j++) {
				$start += $sequences->get($j)->get($i)['start'];
				$end += $sequences->get($j)->get($i)['end'];
			}

			$mean->push(collect([
				'start' => $start / $sequences->count(),
				'end' => $end / $sequences->count()
			]));
		}

		dd($mean);
		return $mean;
	}

}
