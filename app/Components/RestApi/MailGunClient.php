<?php

namespace App\Components\RestApi;

use App\Components\Interfaces\EmailDriverInterface;
use App\Objects\EmailDataObject;
use App\Objects\SendEmailsRequestObject;
use Illuminate\Support\Facades\Log;
use Mailgun\HttpClient\HttpClientConfigurator;
use Mailgun\Hydrator\ArrayHydrator;
use Mailgun\Mailgun;

class MailGunClient
{
    /**
     * @var
     */
    private $client;
    /**
     * @var
     */
    private $domain;

    public function __construct()
    {
        $configurator = new HttpClientConfigurator();
        $configurator->setApiKey(config('api.mailgun.api-key'));
        $this->client = new Mailgun($configurator, new ArrayHydrator());
        $this->domain = config('api.mailgun.domain');
    }

    /**
     * @param EmailDataObject $emailData
     * @return \Mailgun\Model\Message\SendResponse|\Psr\Http\Message\ResponseInterface
     */
    public function sendMessage(EmailDataObject $emailData)
    {
        try {
            return $this->client->messages()->send($this->domain, [
                'from'    => config('api.mailgun.from-email'),
                'to'      => $emailData->getReceiver(),
                'subject' => $emailData->getSubject(),
                'text'    => $emailData->getMessage()
            ]);
        } catch (\Exception $e) {
            Log::info('MailGun failed: ' . $e->getMessage());
        }
    }
}
