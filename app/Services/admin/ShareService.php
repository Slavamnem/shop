<?php

namespace App\Services\Admin;

use App\Product;
use App\Services\Admin\Interfaces\ShareServiceInterface;
use App\Share;
use Carbon\Carbon;
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
     * @param Share $share
     * @return mixed|void
     */
    public function saveConditions(Share $share)
    {
        //dump("start");

        $conditionsData = [];

        foreach ($this->request->conditions as $num => $condition) {
            $whereType = $this->request->conditions_delimiter;
            $conditionsData[][$whereType] = [
                "field"     => $condition,
                "operation" => $this->request->operations[$num],
                "value"     => $this->request->conditions_values[$num]
            ];
        }

        $share->conditions = $conditionsData;
        //$share->active_from = Carbon::now();
        //$share->active_to = Carbon::now();
        //dump($conditionsData);

        //$this->getAccordingProducts($conditionsData);

        //dump("end");
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