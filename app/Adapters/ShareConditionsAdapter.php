<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 15.11.2019
 * Time: 0:57
 */

namespace App\Adapters;

use App\Components\ShareConditions\Interfaces\ConditionBlock;
use App\Components\ShareConditions\Interfaces\ShareConditionsFactory;
use App\Share;

class ShareConditionsAdapter
{
    /**
     * @var Share
     */
    private $share;

    /**
     * ShareConditionsAdapter constructor.
     * @param Share $share
     */
    public function __construct(Share $share)
    {
        $this->share = $share;
    }

    /**
     * @return int
     */
    public function getMainBlockId()
    {
        return 1;
    }

    /**
     * @param ConditionBlock $conditionBlock
     * @return \Illuminate\Support\Collection
     */
    public function getChildConditionsBlocksData(ConditionBlock $conditionBlock)
    {
        return collect();
    }

    /**
     * @param ShareConditionsFactory $factory
     * @param $childBlockData
     * @return ConditionBlock
     */
    public function createConditionFromData(ShareConditionsFactory $factory, $childBlockData)
    {
        return $factory->getCondition();
    }
}

/*


[

]


 */
