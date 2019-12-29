<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 30.11.2019
 * Time: 18:41
 */

namespace App\Components\Graphics\Resources;

use App\Components\Graphics\GraphicResource;
use App\Components\Graphics\GraphicResourceItem;
use Illuminate\Support\Collection;

abstract class AbstractTimeGraphicResource extends AbstractGraphicResource implements GraphicResource
{
    /**
     * @return GraphicResource
     */
    public function buildResourceGrid() : GraphicResource
    {
        // Создаем сетку времени заполненную нулями так как не для каждого момента времени найдутся записи и сетка может быть не полной.
        $this->createGridSkeleton();

        foreach ($this->resourceItems as $resourceItem) {
            $resourceItem->setLabel($this->itemsLabelDistributorClosure);
            $resourceItem->setValue($this->itemsValueQualifierClosure);
            $this->addResourceItemToGrid($resourceItem);
        }

        //$this->sortResourceGridItems(); // для времени не нужно сортировать чтобы не сломать порядок
        return $this;
    }

    abstract public function createGridSkeleton();
}
