<?php

namespace App\Console\Commands\Responses;

use App\Console\Commands\Interfaces\CommandResponseInterface;

class TextResponse extends AbstractResponse implements CommandResponseInterface
{
    /**
     * TextResponse constructor.
     * @param null $data
     */
    public function __construct($data = null)
    {
        parent::__construct($data);
    }
}