<?php

namespace App\Compare;

class EuclideanDistance extends VectorComparer  {

    public function compare(array $key, array $attempt)
    {
        if (count($key[0]) != count($attempt)) {
            return 200;
        }

        $mean = $this->mean($key);
        $std = $this->std($key, $mean);

        return $this->score($mean, $std, $attempt);
    }

    private function score($mean, $std, $attempt) {
        $score = 0;

        for($i = 0; $i < count($mean); $i++) {
            if ($std[$i] != 0) {
                $dev = abs($mean[$i] - $attempt[$i]) / $std[$i];

                if ($dev > 3) {
                    $score += $dev - 3;
                }
            }
        }

        return round($score, $this->decimals);
    }

    private function std(array $sequences, array $mean)
    {
        $std = array_fill(0, count($sequences[0]), 0);

        for ($i = 0; $i < count($sequences[0]); $i++) {

            for ($j = 0; $j < count($sequences); $j++) {
                $std[$i] += pow($sequences[$j][$i] - $mean[$i], 2);
            }

            $std[$i] /= count($sequences[0]);

            $std[$i] = round(sqrt($std[$i]), $this->decimals);
        }

        return $std;
    }

    private function mean(array $sequences)
    {
        $mean = array_fill(0, count($sequences[0]), 0);

        for ($i = 0; $i < count($sequences[0]); $i++) {
            for ($j = 0; $j < count($sequences); $j++) {
                $mean[$i] += $sequences[$j][$i];
            }

            $mean[$i] /= count($sequences);

            $mean[$i] = round($mean[$i], $this->decimals);
        }

        return $mean;
    }
}
