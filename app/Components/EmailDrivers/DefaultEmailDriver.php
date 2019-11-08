<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 08.11.2019
 * Time: 23:53
 */

namespace App\Components\EmailDrivers;

use App\Components\Interfaces\EmailDriverInterface;
use App\Mail\MailSender;
use App\Objects\SendEmailsRequestObject;
use Illuminate\Support\Facades\Mail;

class DefaultEmailDriver implements EmailDriverInterface
{
    /**
     * @param SendEmailsRequestObject $emailsRequest
     */
    public function send(SendEmailsRequestObject $emailsRequest)
    {
        foreach ($emailsRequest->getReceivers() as $receiver) {
            Mail::to($receiver)->send(new MailSender(
                $emailsRequest->getSubject(),
                $emailsRequest->getMessage(),
                $emailsRequest->getTemplate()
            ));
        }
    }
}
