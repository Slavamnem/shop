<?php

namespace App\Console\Commands;

use App\City;
use App\Components\RestApi\NovaPoshta;
use Illuminate\Console\Command;

class SyncNovaPoshtaCities extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync-cities';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $timeStart = time();
        $citiesFromNovaPoshta = resolve(NovaPoshta::class)->getCities();

        $bar = $this->output->createProgressBar(count($citiesFromNovaPoshta));
        foreach ($citiesFromNovaPoshta as $cityFromNovaPoshta) {
            City::updateOrCreate(
                ['ref' => $cityFromNovaPoshta->Ref],
                [
                    'name'    => $cityFromNovaPoshta->DescriptionRu,
                    'city_id' => $cityFromNovaPoshta->CityID,
                    'area'    => $cityFromNovaPoshta->Area,
                ]
            );
            $bar->advance();
        }
        $bar->finish();

        $timeEnd = time();
        $duration = $timeEnd - $timeStart;
        $this->alert("Time: " . $duration);
    }
}
