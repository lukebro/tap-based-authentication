<?php

namespace App\Http\Controllers;

use App\Attempt;
use App\Compare\CosineSimilarity;
use App\Compare\EuclideanDistance;
use Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    protected $passing = 35;

    public function __construct()
    {
        $this->middleware('auth', ['except' => 'user']);
        $this->middleware('api');
    }

    public function master()
    {
        $keys = array_map([$this, 'normalize'], request('sequences'));

        Auth::user()->masterKeys()->create([
            'sequence' => $keys,
        ]);

        return response('OK', 200);
    }

    public function attempt(EuclideanDistance $similarity)
    {
        $keys = Auth::user()->key();

        if (! $keys) {
            return response('INVALID', 200);
        }

        $attempt = $this->normalize(request('sequence'));

        $rating = $similarity->compare($keys->sequence, $attempt);
        $pass = $rating < $this->passing;

        Attempt::create([
            'user_id' => Auth::id(),
            'master_key_id' => $keys->id,
            'sequence' => $attempt,
            'rating' => $rating,
            'passing' => $this->passing
        ]);

        return $pass ? response('SUCCESS', 200) : response('FAIL', 200);
    }

    public function statistics()
    {
        return response()->json(Auth::user()->statistics, 200);
    }

    public function user()
    {
        if (! Auth::check()) {
            return null;
        }

        return response()->json(Auth::user(), 200);
    }

    public function reset()
    {
        Auth::user()->attempts()->delete();
        Auth::user()->masterKeys()->delete();

        return response('OK', 200);
    }

    protected function normalize(array $vector)
    {
        $output = [];

        for ($i = 0; $i < count($vector) - 1; $i++) {
            $current = $vector[$i];
            $next = $vector[$i + 1];

            $output[] = round($next - $current, 3);
        }

        return $output;
    }
}
