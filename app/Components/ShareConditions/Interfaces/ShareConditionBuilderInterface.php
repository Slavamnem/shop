<?php

namespace App\Components\ShareConditions\Interfaces;

use App\Adapters\Interfaces\ShareConditionsAdapterInterface;

interface ShareConditionBuilderInterface
{
    /**
     * @param ShareConditionsAdapterInterface $shareConditionsAdapter
     * @return $this
     */
    public function createEmptyBox(ShareConditionsAdapterInterface $shareConditionsAdapter);

    public function fillBox();

    /**
     * @return ConditionBox
     */
    public function getConditionBox();
}
