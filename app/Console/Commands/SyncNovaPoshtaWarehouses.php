<?php

namespace App\Console\Commands;

use App\City;
use App\Components\RestApi\NovaPoshta;
use App\NpWarehouses;
use App\Services\Admin\Interfaces\NovaPoshtaServiceInterface;
use App\Traits\CommandWorkTimeTrait;
use Illuminate\Console\Command;

class SyncNovaPoshtaWarehouses extends Command
{
    use CommandWorkTimeTrait;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync-np-warehouses  {--city=}';

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
     * @throws \Throwable
     */
    public function handle()
    {
        $this->commandStart = time();

        if (!$this->option('city')) {
            foreach (City::all() as $city) {
                $this->line("\nЗагрузка отделений города: {$city->name}");
                $this->getCityWarehouses($city);
            }
        } else {
            $this->getCityWarehouses(City::find($this->option('city')));
        }

        $this->showCommandTime();
    }

    /**
     * @param $city
     * @throws \Throwable
     */
    private function getCityWarehouses($city)
    {
        $npWarehouses = $this->novaPoshtaService->getCityWareHouses($city);
        $bar = $this->output->createProgressBar(count($npWarehouses));

        foreach ($npWarehouses as $npWarehouse) {
            NpWarehouses::updateOrCreate(
                ['ref' => $npWarehouse->Ref],
                [
                    'name'     => $npWarehouse->DescriptionRu,
                    'ref'      => $npWarehouse->Ref,
                    'address'  => $npWarehouse->ShortAddressRu,
                    'city_ref' => $city->ref,
                    'number'   => $npWarehouse->Number,
                    'phone'    => $npWarehouse->Phone,
                ]
            );
            $bar->advance();
        }

        $bar->finish();
    }
}
