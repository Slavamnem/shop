<?php

namespace App\Console\Commands\Decorators;

use App\Console\Commands\Interfaces\CommandResponseInterface;

class BaseDecorator implements CommandResponseInterface
{
    /**
     * @var CommandResponseInterface
     */
    protected $commandResponse;
    /**
     * @var array
     */
    private static $decorators;

    public function __construct($commandResponse = null)
    {
        $this->commandResponse = $commandResponse;
    }

    /**
     * @return null
     */
    public function getData()
    {
        return $this->commandResponse->getData();
    }

    /**
     * @param $data
     */
    public function setData($data)
    {
        $this->commandResponse->setData($data);
    }

    /**
     * @return mixed
     */
    public function render()
    {
        return $this->commandResponse->render();
    }

    /**
     * @param $name
     * @param null $commandResponse
     * @return mixed
     */
    public static function getDecorator($name, $commandResponse = null)
    {
        self::loadDecorators();

        return new self::$decorators[$name]($commandResponse);
    }

    private static function loadDecorators()
    {
        self::$decorators = collect();
        self::$decorators->put('border', BorderDecorator::class);
        self::$decorators->put('color', ColorDecorator::class);
    }
}