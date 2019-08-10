<?php

namespace App\Console\Commands\Executors;

use App\Console\Commands\Interfaces\ExecutorInterface;

class Executor implements ExecutorInterface
{
    /**
     * @var
     */
    private $devRights;
    /**
     * @var
     */
    private $adminRights;
    /**
     * @var
     */
    private $moderRights;
    /**
     * @var
     */
    private $ceoRights;

    /**
     * Executor constructor.
     * @param bool $devRights
     * @param bool $adminRights
     * @param bool $moderRights
     * @param bool $ceoRights
     */
    public function __construct($devRights = false, $adminRights = false, $moderRights = false, $ceoRights = false)
    {
        $this->devRights = $devRights;
        $this->adminRights = $adminRights;
        $this->moderRights = $moderRights;
        $this->ceoRights = $ceoRights;
    }

    /**
     * @return Executor
     */
    public static function createDev()
    {
        return new self(true, true, true, true);
    }

    /**
     * @return Executor
     */
    public static function createAdmin()
    {
        return new self(false, true);
    }

    /**
     * @return Executor
     */
    public static function createModer()
    {
        return new self(false, false, true);
    }

    /**
     * @return Executor
     */
    public static function createCeo()
    {
        return new self(false , false, false, true);
    }

    /**
     * @return bool
     */
    public function hasDevRights()
    {
        return $this->adminRights;
    }
    /**
     * @return bool
     */
    public function hasAdminRights()
    {
        return $this->adminRights;
    }

    /**
     * @return bool
     */
    public function hasModerRights()
    {
        return $this->moderRights;
    }

    /**
     * @return bool
     */
    public function hasCeoRights()
    {
        return $this->ceoRights;
    }
}