<?php

namespace App\Services\Admin;

use App\Product;
use App\Services\Admin\Interfaces\ShareServiceInterface;
use Illuminate\Http\Request;

class ShareService implements ShareServiceInterface
{
    /**
     * @var
     */
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @return mixed
     */
    public function saveConditions()
    {
        dump("start");

        $conditionsData = [];

        foreach ($this->request->conditions as $num => $condition) {
            $whereType = $this->request->conditions_delimiter;
            $conditionsData[][$whereType] = [
                "field"     => $condition,
                "operation" => $this->request->operations[$num],
                "value"     => $this->request->conditions_values[$num]
            ];
        }

        dump($conditionsData);

        $this->getAccordingProducts($conditionsData);

        dump("end");
    }

    private function getAccordingProducts($conditionsData)
    {
        $query = Product::query();

        foreach ($conditionsData as $conditionsDataItem) {
            foreach ($conditionsDataItem as $key => $item) {
                if ($this->isPropertyCondition($item)) {
                    if ($item["operation"] == "!=") {
                        $query = $query->whereDoesntHave("properties", function($q) use($item){
                            $q->where("product_properties.property_id", $this->getPropertyConditionId($item))
                                    ->where("product_properties.value", $item["value"]);
                        });
                    } else {
                        $query = $query->whereHas("properties", function($q) use($item){
                            $q->where("product_properties.property_id", $this->getPropertyConditionId($item))
                                ->where("product_properties.value", $item["operation"], $item["value"]);
                        });
                    }
                } else {
                    if ($key == "and") {
                        $query = $query->where($item["field"], $item["operation"], $item["value"]);
                    } else {
                        $query = $query->orWhere($item["field"], $item["operation"], $item["value"]);
                    }
                }

                //whereHas("properties", function())
            }
        }

        dump($query->toSql());

        dump($query->get()->pluck("name"));
    }

    private function isPropertyCondition($item)
    {
        return strpos($item["field"], "property-") !== false;
    }

    private function getPropertyConditionId($item)
    {
        return explode("-", $item["field"])[1];
    }
}