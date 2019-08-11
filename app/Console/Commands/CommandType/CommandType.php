<?php

namespace App\Console\Commands\CommandType;

use App\Console\Commands\Interfaces\CommandResponseInterface;
use App\Console\Commands\Responses\FileResponse;
use App\Console\Commands\Responses\TableResponse;
use App\Console\Commands\Responses\TextResponse;

class CommandType
{
    /**
     * @var
     */
    private $name;
    /**
     * @var
     */
    private $commandResponse;

    private static $typesCreators = [
        'text'   => 'createTextType',
        'table'  => 'createTableType',
        'window' => 'createWindowType',
        'file'   => 'createFileType',
    ];

    /**
     * CommandType constructor.
     * @param $name
     * @param CommandResponseInterface $response
     */
    private function __construct($name = null, $response = null)
    {
        $this->name = $name;
        $this->commandResponse = $response;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return CommandResponseInterface
     */
    public function getCommandResponse()
    {
        return $this->commandResponse;
    }

    /**
     * @param $type
     * @return mixed
     */
    public static function create($type)
    {
        return call_user_func([new self, self::$typesCreators[$type]]);
    }

    /**
     * @return CommandType
     */
    public static function createTextType()
    {
        return new self('text', new TextResponse());
    }

    /**
     * @return CommandType
     */
    public static function createTableType()
    {
        return new self('table', new TableResponse());
    }

    /**
     * @return CommandType
     */
    public static function createWindowType()
    {
        return new self('window', new TextResponse());
    }

    /**
     * @return CommandType
     */
    public static function createFileType()
    {
        return new self('file', new FileResponse());
    }
}