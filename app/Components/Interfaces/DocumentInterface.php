<?php

namespace App\Components\Interfaces;

interface DocumentInterface
{
    /**
     * @param $name
     */
    public function setName($name);

    /**
     * @return mixed
     */
    public function getName();

    /**
     * @param $content
     */
    public function setContent($content);

    /**
     * @return mixed
     */
    public function getContent();

    /**
     * @return string
     */
    public function getPath();

    public function render();

    public function save();
}
