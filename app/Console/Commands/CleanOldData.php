<?php

namespace App\Console\Commands;

use App\AdminAuth;
use App\Notification;
use App\UserAction;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CleanOldData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clean-old-data';

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
        AdminAuth::where('created_at', '<', Carbon::createFromTimestamp(strtotime('-1 month'))->toDateTimeString())->delete();
        Notification::where('created_at', '<', Carbon::createFromTimestamp(strtotime('-3 month'))->toDateTimeString())->delete();
        UserAction::where('created_at', '<', Carbon::createFromTimestamp(strtotime('-3 month'))->toDateTimeString())->delete();
    }
}
