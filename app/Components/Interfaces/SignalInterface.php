<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 25.09.2019
 * Time: 0:58
 */

namespace App\Components\Interfaces;

interface SignalInterface
{
    /**
     * @param $message
     * @return $this
     */
    public function setMessage($message);

    /**
     * @return null
     */
    public function getMessage();
}
