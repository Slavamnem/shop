<?php

namespace App\Console\Commands\Interfaces;

use App\Console\Commands\Executors\Executor;

interface ExecutorInterface
{
    /**
     * Executor constructor.
     * @param bool $devRights
     * @param bool $adminRights
     * @param bool $moderRights
     * @param bool $ceoRights
     */
    public function __construct($devRights = false, $adminRights = false, $moderRights = false, $ceoRights = false);

    /**
     * @return Executor
     */
    public static function createDev();

    /**
     * @return Executor
     */
    public static function createAdmin();

    /**
     * @return Executor
     */
    public static function createModer();

    /**
     * @return Executor
     */
    public static function createCeo();

    /**
     * @return bool
     */
    public function hasDevRights();

    /**
     * @return bool
     */
    public function hasAdminRights();

    /**
     * @return bool
     */
    public function hasModerRights();

    /**
     * @return bool
     */
    public function hasCeoRights();
}