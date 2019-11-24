<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 15.11.2019
 * Time: 0:57
 */

namespace App\Adapters;

use App\Adapters\Interfaces\ShareConditionsAdapterInterface;
use App\Components\ShareConditions\Interfaces\Condition;
use App\Components\ShareConditions\Interfaces\ConditionBlock;
use App\Components\ShareConditions\Interfaces\ConditionBox;
use App\Components\ShareConditions\Interfaces\ShareConditionsFactory;
use App\Enums\ConditionDelimiterTypesEnum;
use App\Enums\ConditionTypesEnum;
use App\Share;

class ShareConditionsAdapter implements ShareConditionsAdapterInterface
{
    /**
     * @var Share
     */
    private $share;
    /**
     * @var ShareConditionsFactory
     */
    private $factory;

    /**
     * ShareConditionsAdapter constructor.
     * @param Share $share
     */
    public function __construct(Share $share)
    {
        $this->share = $share;
        $this->factory = ConditionTypesEnum::CREATE($this->getMainBlockTypeId())->getTypeFactory();
    }

    /**
     * @return Condition|ConditionBlock|ConditionBox|mixed
     */
    public function createConditionBox()
    {
        return $this->createConditionBlockFromData($this->share->conditions);
    }

    /**
     * @param $conditionBlockData
     * @return ConditionBlock|Condition|ConditionBox
     */
    public function createConditionBlockFromData($conditionBlockData)
    {
        if (array_get($conditionBlockData, 'entity') == 'condition') {
            return $this->createConditionFromData($conditionBlockData);
        } elseif (array_get($conditionBlockData, 'entity') == 'box') {
            return $this->createConditionBoxFromData($conditionBlockData);
        }
    }

    /**
     * @param $conditionBlockData
     * @return ConditionBlock
     */
    private function createConditionFromData($conditionBlockData)
    {
        return $this->factory->getCondition()
            ->setField(array_get($conditionBlockData, 'field'))
            ->setOperationId(array_get($conditionBlockData, 'operation_id'))
            ->setValue(array_get($conditionBlockData, 'value'))
            ->setFieldsList($this->factory->getFieldsList())
            ->setOperationsList($this->factory->getOperationList())
            ->setId(array_get($conditionBlockData, 'id'))
            ->setPid(array_get($conditionBlockData, 'pid'));
    }

    /**
     * @param $conditionBlockData
     * @return ConditionBlock
     */
    private function createConditionBoxFromData($conditionBlockData)
    {
        $conditionBox = $this->factory->getConditionBox()
            ->setDelimiter(ConditionDelimiterTypesEnum::getClass(array_get($conditionBlockData, 'delimiter', 'and')))
            ->setId(array_get($conditionBlockData, 'id'))
            ->setPid(array_get($conditionBlockData, 'pid'));

        foreach ($this->getConditionBlockChildren($conditionBlockData) as $childData)
        {
            $conditionBox->addChild($this->createConditionBlockFromData($childData));
        }

        return $conditionBox;
    }

    /**
     * @return mixed
     */
    private function getMainBlockTypeId()
    {
        return array_get($this->share->conditions, 'type_id', null);
    }

    /**
     * @param array $conditionBoxData
     * @return \Illuminate\Support\Collection
     */
    private function getConditionBlockChildren($conditionBoxData)
    {
        return array_get($conditionBoxData, 'children', []);
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
        children => [
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
                children => [
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
