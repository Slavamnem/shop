<?php

namespace App\Console\Commands;

use App\City;
use App\Components\RestApi\NovaPoshta;
use App\Services\Admin\Interfaces\NovaPoshtaServiceInterface;
use App\Traits\CommandWorkTimeTrait;
use Illuminate\Console\Command;

class SyncNovaPoshtaCities extends Command
{
    use CommandWorkTimeTrait;
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
     * @var NovaPoshtaServiceInterface
     */
    private $novaPoshtaService;
    /**
     * @var
     */
    private $commandStart;

    /**
     * Create a new command instance.
     *
     * SyncNovaPoshtaCities constructor.
     * @param NovaPoshtaServiceInterface $novaPoshtaService
     */
    public function __construct(NovaPoshtaServiceInterface $novaPoshtaService)
    {
        parent::__construct();
        $this->novaPoshtaService = $novaPoshtaService;
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function handle()
    {
        $this->commandStart = time();

        $citiesFromNovaPoshta = $this->novaPoshtaService->getCities();

        $bar = $this->output->createProgressBar(count($citiesFromNovaPoshta));
        foreach ($citiesFromNovaPoshta as $cityFromNovaPoshta) {
            City::updateOrCreate(
                ['ref' => $cityFromNovaPoshta->Ref],
                [
                    'city_id' => $cityFromNovaPoshta->CityID,
                    'name'    => $cityFromNovaPoshta->DescriptionRu,
                    'area'    => $cityFromNovaPoshta->Area,
                ]
            );
            $bar->advance();
        }
        $bar->finish();

        $this->showCommandTime();
    }
}
