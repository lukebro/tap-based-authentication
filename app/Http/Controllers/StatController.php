<?php

namespace App\Http\Controllers;

use App\Attempt;
use Illuminate\Http\Request;

class StatController extends Controller
{
    public function index()
    {
    	$acc = collect();

        for ($i = 0; $i <= 20; $i++) {
            $acc->push($i * 5);
        }

        $imposter = Attempt::where('user_id', 2)->count();
        $good = Attempt::where('user_id', 1)->count();

        $data = collect();

        foreach ($acc as $a) {

            $data->push([
                'threshold' => $a,
                'far' => round(Attempt::where('user_id', 2)->where('score', '<', $a)->count() / $imposter, 2),
                'frr' => round(Attempt::where('user_id', 1)->where('score', '>', $a)->count() / $good, 2),
            ]);

        }

        echo "threshhold, far, frr";
        echo "<br />";

        foreach ($data as $set) {
            echo $set['threshold'].  ', ' . $set['far'] . ', ' . $set['frr'];
            echo "<br />";
        }

        dd();


    	return view('stat', [
    		'data' => $data,
    	]);
    } 
    
}
