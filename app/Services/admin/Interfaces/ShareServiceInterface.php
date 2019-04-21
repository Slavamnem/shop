<?php

namespace App\Services\Admin\Interfaces;

use App\Share;

interface ShareServiceInterface
{
    /**
     * @return array
     */
    public function getConditionsOperations();

    /**
     * @param $share
     * @return array
     */
    public function getOldConditionsData($share);

    /**
     * @return array
     */
    public function getNewConditionData();

    /**
     * @param string $conditionKey
     * @return array
     */
    public function getConditionValues($conditionKey);

    /**
     * @param Share $share
     * @return mixed
     */
    public function setConditions(Share $share);
}