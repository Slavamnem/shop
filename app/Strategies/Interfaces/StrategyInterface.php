<?php

namespace App\Strategies\Interfaces;

interface StrategyInterface
{
    public function loadStrategies();

    /**
     * @param $type
     * @return mixed
     */
    public function getStrategy($type);
}