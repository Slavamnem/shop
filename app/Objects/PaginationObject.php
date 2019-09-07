<?php

namespace App\Objects;

use App\Objects\Interfaces\PaginationObjectInterface;

class PaginationObject implements PaginationObjectInterface
{
    /**
     * @var int
     */
    private $maxPage;
    /**
     * @var int
     */
    private $currentPage;

    /**
     * @return mixed
     */
    public function getCurrentPage()
    {
        return $this->currentPage;
    }

    /**
     * @param $value
     * @return $this
     */
    public function setCurrentPage($value)
    {
        $this->currentPage = $value;
        return $this;
    }

    /**
     * @return int
     */
    public function getNextPage()
    {
        return $this->currentPage < $this->maxPage ? $this->currentPage + 1 : $this->currentPage;
    }

    /**
     * @return int
     */
    public function getPreviousPage()
    {
        return $this->currentPage > 1 ? $this->currentPage -1 : $this->currentPage;
    }

    /**
     * @return mixed
     */
    public function getMaxPage()
    {
        return $this->maxPage;
    }

    /**
     * @param $value
     * @return $this
     */
    public function setMaxPage($value)
    {
        $this->maxPage = $value;
        return $this;
    }
}
