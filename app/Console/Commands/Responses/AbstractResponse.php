<?php

namespace App\Console\Commands\Responses;

use App\Console\Commands\Interfaces\CommandResponseInterface;

abstract class AbstractResponse implements CommandResponseInterface
{
    /**
     * @var
     */
    private $data;

    /**
     * TextResponse constructor.
     * @param null $data
     */
    public function __construct($data = null)
    {
        $this->data = $data;
    }

    /**
     * @return null
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param $data
     */
    public function setData($data)
    {
        $this->data = $data;
    }
}