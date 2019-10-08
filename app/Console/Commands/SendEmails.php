<?php

namespace App\Console\Commands;

use App\Client;
use App\EmailTemplate;
use App\Jobs\SendEmail;
use App\Mail\MailSender;
use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send-emails {--client_id=} {--template=1}';

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
        $progressBar = $this->output->createProgressBar();

        if ($clientId = $this->option('client_id')) {
            $progressBar->start(1);

            $client = Client::find($clientId); // move to job ???
            $this->line("\nSend email to: {$client->email}");

            $this->sendEmail($client, "Уведомление от MilanShop");
        } else {
            $clients = Client::all();
            $progressBar->start(count($clients));

            foreach ($clients as $client) {
                $this->sendEmail($client, "Уведомление от MilanShop");
                $progressBar->advance();
            }
        }

        $progressBar->finish();
    }

    /**
     * @param $client
     * @param $theme
     */
    private function sendEmail($client, $theme)
    {
        (new SendEmail($client, $theme, EmailTemplate::find($this->option('template'))->template))->handle();
        //Mail::to($client->email)->send(new MailSender($theme, EmailTemplate::find($this->option('template'))->template, "default"));
    }
}
