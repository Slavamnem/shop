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
        //$citiesFromNovaPoshta = array_slice($citiesFromNovaPoshta, 0, 850);
        $citiesToUpdate = City::whereIn("ref", collect($citiesFromNovaPoshta)->pluck("Ref"))->get();

        if (count($citiesToUpdate)) {
            $this->updateCities($citiesFromNovaPoshta, $citiesToUpdate);
        }

        $this->insertCities($citiesFromNovaPoshta, $citiesToUpdate);

        $timeEnd = time();
        $duration = $timeEnd - $timeStart;
        $this->alert("\nTime: " . $duration);
    }

    /**
     * @param $citiesFromNovaPoshta
     * @param $citiesToUpdate
     */
    private function updateCities($citiesFromNovaPoshta, $citiesToUpdate)
    {
        $this->info("Update existing cities...");

        $bar = $this->output->createProgressBar(count($citiesToUpdate));
        foreach ($citiesToUpdate as $city) {
            $cityFromNovaPoshta = collect($citiesFromNovaPoshta)->where("Ref", $city->ref)->first();

            $city->name = $cityFromNovaPoshta->DescriptionRu;
            $city->city_id = $cityFromNovaPoshta->CityID;
            $city->area = $cityFromNovaPoshta->Area;
            $city->save();

            $bar->advance();
        }

        $bar->finish();
        $this->info("\nUpdated " . count($citiesToUpdate) . " cities");
    }

    /**
     * @param $citiesFromNovaPoshta
     * @param $citiesToUpdate
     */
    private function insertCities($citiesFromNovaPoshta, $citiesToUpdate)
    {
        $citiesToInsert = collect($citiesFromNovaPoshta)->reject(function($city) use($citiesToUpdate){
            return in_array($city->Ref, $citiesToUpdate->pluck("ref")->toArray());
        });

        $citiesToInsert = $citiesToInsert->map(function($city){
            return [
                'name'    => $city->DescriptionRu,
                'ref'     => $city->Ref,
                'city_id' => $city->CityID,
                'area'    => $city->Area,
            ];
        });

        City::insert($citiesToInsert->toArray());
        $this->info("\nInserted " . count($citiesToInsert) . " cities");
    }
}
