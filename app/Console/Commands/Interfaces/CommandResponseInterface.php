<?php

namespace App\Console\Commands\Interfaces;

interface CommandResponseInterface
{
    /**
     * TextResponse constructor.
     * @param null $data
     */
    public function __construct($data = null);

    /**
     * @return null
     */
    public function getData();

    /**
     * @param $data
     */
    public function setData($data);
}