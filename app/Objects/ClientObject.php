<?php

namespace App\Objects;

use Illuminate\Support\Collection;

class ClientObject
{
    /**
     * @var Collection
     */
    private $clients;
    /**
     * @var int
     */
    private $id;

    /**
     * @param $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param $values
     * @return $this
     */
    public function setClients($values)
    {
        $this->clients = $values;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getClients()
    {
        return $this->clients;
    }
}
