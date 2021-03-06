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

        if (Auth::id()) {
            $this->executor = Auth::user()->createExecutor();
        }
    }

    public function init()
    {
        $this->commandType = CommandType::create($this->option('type'));
        $this->response = $this->commandType->getCommandResponse();
    }

    public function handle()
    {
        $this->init();
    }

    /**
     * @return mixed
     */
    public function getResponse()
    {
        return $this->response;
    }
}