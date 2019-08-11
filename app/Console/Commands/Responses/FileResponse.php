<?php

namespace App\Console\Commands\Responses;

use App\Console\Commands\Interfaces\CommandResponseInterface;

class FileResponse extends AbstractResponse implements CommandResponseInterface
{
    /**
     * FileResponse constructor.
     * @param null $data
     */
    public function __construct($data = null)
    {
        parent::__construct($data);
    }

    public function render(){

    }
}