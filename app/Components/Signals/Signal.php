<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 25.09.2019
 * Time: 0:57
 */

namespace App\Components\Signals;

use App\Components\Interfaces\SignalInterface;

class Signal implements SignalInterface
{
    /**
     * @var
     */
    private $message;

    /**
     * Signal constructor.
     * @param null $message
     */
    public function __construct($message = null)
    {
        $this->message = $message;
    }

    /**
     * @param $message
     * @return $this
     */
    public function setMessage($message)
    {
        $this->message = $message;
        return $this;
    }

    /**
     * @return null
     */
    public function getMessage()
    {
        return $this->message;
    }
}
