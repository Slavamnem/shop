<?php

namespace App\Console\Commands\Decorators;

class BorderDecorator extends BaseDecorator
{
    public function decorate()
    {
        $data = $this->commandResponse->getData();
        $data .= "<p>Border Decorator Line</p>";
        $this->commandResponse->setData($data);
    }
}