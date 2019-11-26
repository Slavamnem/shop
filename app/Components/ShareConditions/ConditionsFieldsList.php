<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 14.11.2019
 * Time: 0:17
 */

namespace App\Components\ShareConditions;

use App\Components\ShareConditions\Interfaces\ConditionsFieldsListInterface;
use App\Product;
use App\Property;
use Illuminate\Support\Collection;

class ConditionsFieldsList implements ConditionsFieldsListInterface
{
    /**
     * @var Collection
     */
    private $list;
    /**
     * @var ConditionsFieldsList
     */
    private static $instance;

    /**
     * @return ConditionsFieldsList
     */
    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * @return Collection
     */
    public function getList()
    {
        if (empty($this->list)) {
            $this->addProductFields();
            $this->addProductProperties();
        }

        return $this->list;
    }

    private function addProductFields()
    {
        foreach ((new Product())->getFieldsTranslations() as $field => $translation) {
            $this->list->put($field, $translation);
        }
    }

    private function addProductProperties()
    {
        foreach (Property::all() as $property) {
            $this->list->put("property-{$property->id}", $property->name);
        }
    }
}
