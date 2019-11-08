<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 08.11.2019
 * Time: 23:49
 */

namespace App\Components\Interfaces;

use App\Objects\SendEmailsRequestObject;

interface EmailDriverInterface
{
    /**
     * @param SendEmailsRequestObject $emailsRequest
     */
    public function send(SendEmailsRequestObject $emailsRequest);
}
