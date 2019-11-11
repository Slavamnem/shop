<?php

namespace App\Traits;

trait CommandWorkTimeTrait //TODO делать парочку трейтов (фильтры для crud)
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
