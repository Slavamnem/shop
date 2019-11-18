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
use Carbon\Carbon;

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
     * @return mixed
     */
    public function getMainBlockId()
    {
        return @$this->share->conditions['id'];
    }

    /**
     * @return mixed
     */
    public function getMainBlockTypeId()
    {
        return @$this->share->conditions['type_id'];
    }

    /**
     * @return mixed
     */
    public function getMainBlockDelimiter()
    {
        return @$this->share->conditions['delimiter'];
    }

    /**
     * @return mixed
     */
    public function getMainBlockChildData()
    {
        return @$this->share->conditions['conditionBlocks'];
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
    public function createConditionBlockFromData(ShareConditionsFactory $factory, $childBlockData) //TODO
    {
        if ($childBlockData['entity'] == 'condition') {
            return $factory->getCondition()
                ->setId($childBlockData['id'])
                ->setParentId($childBlockData['pid'])
                ->setFieldsList($factory->getFieldsList())
                ->setOperationsList($factory->getOperationList());
        } elseif ($childBlockData['entity'] == 'box') {
            return $factory->getConditionBox();
        }

        // if entity = 'box'
    }
}

/*



    [
        id => 23421421,
        pid => 0,
        delimiter => 'and'|'or',
        entity => 'box',
        type_id => 1, //base
        active_from => '2019-10-10 12:00:00',
        active_to => '2019-15-12 12:00:00',
        conditionBlocks => [
            [
                id => 543534,
                pid => 23421421,
                entity => 'condition',
                type_id => 1, //base
                field => 'color_id',
                operation_id => 1,
                value => 3,
                active_from => '2019-10-10 12:00:00',
                active_to => '2019-15-12 12:00:00',
            ],
            [
                id => 4234234,
                pid => 23421421,
                delimiter => 'and'|'or',
                entity => 'box',
                type_id => 1, //base
                active_from => '2019-10-10 12:00:00',
                active_to => '2019-15-12 12:00:00',
                conditionBlocks => [
                    ...
                ]
            ]
        ]
    ]

type
active_from
active_to

[
   {"and":{"field":"id","operation":"=","value":"1"}},
   {"and":{"field":"base_price","operation":">","value":"2"}}
]
 */
