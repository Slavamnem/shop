<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 14.11.2019
 * Time: 0:29
 */

namespace App\Components\ShareConditions\Interfaces;

use App\Components\ShareConditions\ConditionsFieldsList;
use Illuminate\Support\Collection;

interface ConditionsFieldsListInterface
{
    /**
     * @return ConditionsFieldsList
     */
    public static function getInstance();

    /**
     * @return Collection
     */
    public function getList();
}
