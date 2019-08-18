<?php

namespace App\Console\Commands\Decorators;

class ColorDecorator extends BaseDecorator
{
    public function decorate()
    {
        $data = $this->commandResponse->getData();
        $data .= "<p>Color Decorator Line</p>";
        $this->commandResponse->setData($data);
    }
}