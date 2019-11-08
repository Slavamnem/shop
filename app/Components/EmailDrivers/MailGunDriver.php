<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 08.11.2019
 * Time: 23:53
 */

namespace App\Components\EmailDrivers;

use App\Components\Interfaces\EmailDriverInterface;
use App\Components\RestApi\MailGunClient;
use App\Objects\EmailDataObject;
use App\Objects\SendEmailsRequestObject;

class MailGunDriver implements EmailDriverInterface
{
    /**
     * @var MailGunClient
     */
    private $client;

    public function __construct()
    {
        $this->client = new MailGunClient();
    }

    /**
     * @param SendEmailsRequestObject $emailsRequest
     */
    public function send(SendEmailsRequestObject $emailsRequest)
    {
        foreach ($emailsRequest->getReceivers() as $receiver) {
            $response = $this->client->sendMessage((new EmailDataObject())
                ->setReceiver($receiver)
                ->setSubject($emailsRequest->getSubject())
                ->setMessage($emailsRequest->getMessage())
            ); //dump($response);
        }
    }
}
