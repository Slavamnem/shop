<?php

namespace App\Console\Commands;

use App\Console\Commands\CommandType\CommandType;
use App\Console\Commands\Executors\Executor;
use App\Console\Commands\Interfaces\CommandResponseInterface;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;

abstract class AbstractCommand extends Command
{
    /**
     * @var Executor
     */
    protected $executor;
    /**
     * @var CommandResponseInterface
     */
    protected $response;
    /**
     * @var CommandType
     */
    protected $commandType;

    /**
     * AbstractCommand constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->executor = Auth::user()->createExecutor();
    }

    /**
     * @return mixed
     */
    public function getResponse()
    {
        return $this->response;
    }
}