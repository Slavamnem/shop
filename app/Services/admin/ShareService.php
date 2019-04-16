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
            $whereType = $num > 0 ? $this->request->conditions_delimiters[$num - 1] : "and";
            $conditionsData[][$whereType] = [
                $condition,
                $this->request->operations[$num],
                $this->request->conditions_values[$num]
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
                // TODO отчленить имена полей и свойств, для свойств отдельные подзапросы
                if ($key == "and") {
                    $query = $query->where($item[0], $item[1], $item[2]);
                } else {
                    $query = $query->orWhere($item[0], $item[1], $item[2]);
                }
            }
        }

        dump($query->toSql());
    }
}