<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SiteElement extends Model
{
    protected $table = 'site_elements';

    protected $fillable = ['key', 'type'];

    /**
     * @return mixed
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @param $value
     * @return $this
     */
    public function setKey($value)
    {
        $this->key = $value;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param $value
     * @return $this
     */
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param $value
     * @return $this
     */
    public function setType($value)
    {
        $this->type = $value;
        return $this;
    }
}
