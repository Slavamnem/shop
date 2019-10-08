<?php

namespace App\Jobs;

use App\Client;
use App\Mail\MailSender;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;

class SendEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var Client
     */
    private $client;
    /**
     * @var
     */
    private $theme;
    /**
     * @var
     */
    private $message;

    /**
     * Create a new job instance.
     *
     * SendEmail constructor.
     * @param Client $client
     * @param $theme
     * @param $message
     */
    public function __construct(Client $client, $theme, $message)
    {
        $this->client = $client;
        $this->theme = $theme;
        $this->message = $message;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->client->email)->send(new MailSender($this->theme, $this->message, "default"));
    }
}
