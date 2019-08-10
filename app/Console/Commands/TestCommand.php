<?php

namespace App\Console\Commands;

use App\Console\Commands\Executors\Executor;
use App\Jobs\TestJob;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class TestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test-command1';

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
        $job = new TestJob();

        Log::info("command done");

        dump("ask");

        //$name = $this->ask('What is your name?');

        //dump($name);

        $job->handle();

        //dispatch((new TestJob())->delay(Carbon::now()->addSeconds(5)));
//        dispatch((new TestJob())
//            //->delay(Carbon::now()->addSeconds(10))
//            ->onQueue("test1")
//            ->onConnection("database")
//        );

        //$job->dispatch();

        $executor = Executor::createAdmin();
        dump($executor);
    }
}
