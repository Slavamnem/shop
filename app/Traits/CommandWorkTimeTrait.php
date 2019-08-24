<?php

namespace App\Traits;

trait CommandWorkTimeTrait
{
    public function showCommandTime()
    {
        $this->line('');
        $this->alert("Command execution time: {$this->getDuration()} seconds");
    }

    /**
     * @return int
     */
    private function getDuration()
    {
        return time() - $this->commandStart;
    }
}
