<?php

namespace App\Components\Documents;

use App\Components\Interfaces\DocumentInterface;
use Illuminate\Support\Facades\Storage;

class Document implements DocumentInterface
{
    /**
     * @var
     */
    private $name;
    /**
     * @var
     */
    private $content;

    /**
     * Document constructor.
     * @param null $name
     */
    public function __construct($name = null)
    {
        $this->setName($name);
    }

    /**
     * @param $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return storage_path("app/{$this->getName()}");
    }

    public function render(){
        /// ... ///
    }

    public function save()
    {
        Storage::put($this->getName(), $this->content);
    }
}
