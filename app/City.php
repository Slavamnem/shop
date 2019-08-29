<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table = "cities";

    protected $fillable = ['name', 'ref', 'city_id', 'area'];

    /*******************/
    /* accessors block */
    /*******************/

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getRef()
    {
        return $this->ref;
    }

    /**
     * @param $value
     */
    public function setRef($value)
    {
        $this->ref = $value;
    }

    /***********************/
    /* end accessors block */
    /***********************/
}
