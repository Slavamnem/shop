<?php

namespace App\Console\Commands\Responses;

use App\Console\Commands\Interfaces\CommandResponseInterface;

class TableResponse extends AbstractResponse implements CommandResponseInterface
{
    /**
     * TextResponse constructor.
     * @param null $data
     */
    public function __construct($data = null)
    {
        parent::__construct($data);
    }

    public function render()
    {
        $this->setData(
            view("admin.commands.table_response", ['data' => $this->getData()])->render()
        );

        return $this->getData();
    }
}