<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 08.11.2019
 * Time: 23:42
 */

namespace App\Objects;

class EmailDataObject
{
    /**
     * @var string
     */
    private $receiver;
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

    /**
     * @return string
     */
    public function getTemplate(): string
    {
        return $this->template;
    }

    /**
     * @param string $template
     * @return EmailDataObject
     */
    public function setTemplate(string $template): EmailDataObject
    {
        $this->template = $template;
        return $this;
    }

    /**
     * @return string
     */
    public function getReceiver()
    {
        return $this->receiver;
    }

    /**
     * @param string $receiver
     * @return EmailDataObject
     */
    public function setReceiver($receiver)
    {
        $this->receiver = $receiver;
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
     * @return EmailDataObject
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
     * @return EmailDataObject
     */
    public function setMessage($message)
    {
        $this->message = $message;
        return $this;
    }
}
