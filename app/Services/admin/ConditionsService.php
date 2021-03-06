<?php

namespace App\Services\Admin;

use App\Builders\Interfaces\ConditionsBuilderInterface;
use App\Category;
use App\Color;
use App\Components\Condition;
use App\Components\ConditionsBox;
use App\ConditionOperation;
use App\ModelGroup;
use App\Product;
use App\ProductStatus;
use App\Property;
use App\Services\Admin\Interfaces\ProductServiceInterface;
use App\Services\Admin\Interfaces\ShareServiceInterface;
use App\Size;
use App\Strategies\Conditions\ConditionStrategy;
use Illuminate\Support\Collection;

class ConditionsService
{
    /**
     * @var ShareServiceInterface
     */
    private $shareService;
    /**
     * @var ProductServiceInterface
     */
    private $productService;
    /**
     * @var ConditionsBuilderInterface
     */
    private $conditionsBoxBuilder;
    /**
     * @var array
     */
    private $operations;
    /**
     * @var ConditionStrategy
     */
    private $conditionsStrategy;

    /**
     * ConditionsService constructor.
     * @param ShareServiceInterface $shareService
     * @param ProductServiceInterface $productService
     * @param ConditionsBuilderInterface $builder
     */
    public function __construct(ShareServiceInterface $shareService, ProductServiceInterface $productService, ConditionsBuilderInterface $builder)
    {
        $this->shareService = $shareService;
        $this->productService = $productService;
        $this->conditionsBoxBuilder = $builder;
        $this->conditionsStrategy = new ConditionStrategy();

        $this->loadData();
    }

    /**
     * @param $share
     * @return mixed
     */
    public function getExistingConditions($share)
    {
        $this->conditionsBoxBuilder->createBox();
        $this->conditionsBoxBuilder->setDelimiter($this->getConditionsDelimiter($share));
        $this->conditionsBoxBuilder->setConditionsList($this->getConditionsList());
        $this->conditionsBoxBuilder->setOperationsList($this->getOperationsList());

        foreach ($share->conditions as $id => $conditionData) {
            $this->conditionsBoxBuilder->addCondition(Condition::createFromShareData($id, $conditionData));
            $this->conditionsBoxBuilder->setValuesList($id, $this->getValuesList($conditionData[array_keys($conditionData)[0]]["field"]));
        }

        return $this->conditionsBoxBuilder->getConditionsBox();
    }

    /**
     * Список всех условий, которые можно добавлять у акции
     * @param $request
     * @return ConditionsBox
     */
    public function getNewConditionBox($request)
    {
        $this->conditionsBoxBuilder->createBox();
        $this->conditionsBoxBuilder->setDelimiter($request->delimiterType);
        $this->conditionsBoxBuilder->setConditionsList($this->getConditionsList());
        $this->conditionsBoxBuilder->setOperationsList($this->getOperationsList());
        $this->conditionsBoxBuilder->addCondition(new Condition($request->conditionId));

        return $this->conditionsBoxBuilder->getConditionsBox();
    }

    private function loadData()
    {
        $this->operations = ConditionOperation::get()->pluck('name')->toArray();
    }

    /**
     * @return array|mixed
     */
    private function getConditionsList()
    {
        $conditionsList = collect();
        $this->addProductFields($conditionsList);
        $this->addProductProperties($conditionsList);

        return $conditionsList->toArray();
    }

    /**
     * @param Collection $conditionsList
     */
    private function addProductFields($conditionsList)
    {
        foreach ((new Product())->getFieldsTranslations() as $field => $translation) {
            $conditionsList->put($field, $translation);
        }
    }

    /**
     * @param Collection $conditionsList
     */
    private function addProductProperties($conditionsList)
    {
        foreach (Property::all() as $property) {
            $conditionsList->put("property-{$property->id}", $property->name);
        }
    }

    /**
     * @return array
     */
    private function getOperationsList()
    {
        return $this->operations;
    }

    /**
     * Все возможные значения конкретного условия
     * @param $conditionKey
     * @return mixed
     */
    public function getValuesList($conditionKey)
    {
        return $this->conditionsStrategy->getStrategy($conditionKey)->getValues();
    }

    /**
     * @param $share
     * @return mixed|null
     */
    private function getConditionsDelimiter($share)
    {
        return ($share->conditions) ?
            array_get(array_keys(array_get($share->conditions, 0)), 0) : null;
    }
}
