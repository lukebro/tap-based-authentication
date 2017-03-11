<?php

namespace App\Console\Commands;

use App\Attempt;
use App\Compare\CosineSimilarity;
use App\MasterKey;
use Illuminate\Console\Command;

class Compare extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'compare';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Compare two arrays against an algorithm.';

    protected $compare;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(CosineSimilarity $compare)
    {
        parent::__construct();

        $this->compare = $compare;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('Yo dawg.. We heard you like this.');
        $key = $this->normalize(MasterKey::first()->sequence);
        $attempt = $this->normalize(Attempt::find(12)->sequence);

        $similarity = $this->compare->compare($key, $attempt);

        $this->info($similarity);
    }

    protected function normalize(array $vector)
    {
        $output = [];

        for ($i = 0; $i < count($vector); $i++) {
            $value = $vector[$i];

            $output[] = round($value['end'] - $value['start'], 3);

            if (array_key_exists($i + 1, $vector)) {
                $next = $vector[$i + 1];

                $output[] = round($next['start'] - $value['end'], 3);
            }
        }

        return $output;
    }
}
