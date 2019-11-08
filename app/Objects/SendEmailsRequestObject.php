<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 08.11.2019
 * Time: 23:42
 */

namespace App\Objects;

use Illuminate\Support\Collection;

class SendEmailsRequestObject
{
    /**
     * @var Collection
     */
    private $receivers;
    /**
     * @var string
     */
    private $subject;
    /**
     * @var string
     */
    private $message;
    /**
     * @var string
     */
    private $template;

    public function __construct()
    {
        $this->receivers = collect();
    }

    /**
     * @return string
     */
    public function getTemplate(): string
    {
        return $this->template;
    }

    /**
     * @param string $template
     * @return SendEmailsRequestObject
     */
    public function setTemplate(string $template): SendEmailsRequestObject
    {
        $this->template = $template;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getReceivers()
    {
        return $this->receivers;
    }

    /**
     * @param $receiver
     * @return $this
     */
    public function addReceiver($receiver)
    {
        $this->receivers->push($receiver);
        return $this;
    }

    /**
     * @param mixed $receivers
     * @return SendEmailsRequestObject
     */
    public function setReceivers($receivers)
    {
        $this->receivers = collect($receivers);
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @param mixed $subject
     * @return SendEmailsRequestObject
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param mixed $message
     * @return SendEmailsRequestObject
     */
    public function setMessage($message)
    {
        $this->message = $message;
        return $this;
    }
}
