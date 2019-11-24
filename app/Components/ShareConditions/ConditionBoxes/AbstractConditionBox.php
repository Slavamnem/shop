<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 13.11.2019
 * Time: 23:49
 */

namespace App\Components\ShareConditions\ConditionBoxes;

use App\Components\ShareConditions\AbstractConditionBlock;
use App\Components\ShareConditions\Interfaces\ConditionBlock;
use App\Components\ShareConditions\Interfaces\ConditionBox;
use App\Components\ShareConditions\Interfaces\Delimiter;
use Illuminate\Support\Collection;

abstract class AbstractConditionBox extends AbstractConditionBlock implements ConditionBox
{
    /**
     * @var Delimiter
     */
    private $delimiter;
    /**
     * @var Collection
     */
    private $childrenBlocks;

    /**
     * AbstractConditionBox constructor.
     */
    public function __construct()
    {
        $this->childrenBlocks = collect();
    }

    /**
     * @return Delimiter
     */
    public function getDelimiter(): Delimiter
    {
        return $this->delimiter;
    }

    /**
     * @param Delimiter $delimiter
     * @return ConditionBox
     */
    public function setDelimiter(Delimiter $delimiter): ConditionBox
    {
        $this->delimiter = $delimiter;
        return $this;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function getChildren() : Collection
    {
        return $this->childrenBlocks;
    }

    /**
     * @param ConditionBlock $conditionBlock
     */
    public function addChild(ConditionBlock $conditionBlock)
    {
        $this->childrenBlocks->put($conditionBlock->getId(), $conditionBlock);
    }

    /**
     * @param $id
     * @return ConditionBlock
     */
    public function getChildById($id) : ConditionBlock
    {
        return $this->childrenBlocks->get($id);
    }
}
