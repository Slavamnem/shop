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
use App\Strategies\Graphics\GraphicResource\GraphicResourceSegregationTypeStrategy;
use Illuminate\Support\Collection;

class TimeGraphicResource extends AbstractGraphicResource implements GraphicResource
{
    /**
     * @var GraphicResourceSegregationTypeStrategy
     */
    private $segregationTypeStrategy;

    /**
     * TimeGraphicResource constructor.
     */
    public function __construct()
    {
        $this->segregationTypeStrategy = new GraphicResourceSegregationTypeStrategy();
    }

    /**
     * @param Collection $resourceItems
     * @return GraphicResource
     */
    public function setResourceItems(Collection $resourceItems)
    {
        // Создаем сетку времени заполненную нулями так как не для каждого момента времени найдутся записи и сетка может быть не полной.
        $this->resourceItems = $this->segregationTypeStrategy->getStrategy($this->segregationType)->createSegregationSkeleton($this);

        foreach ($resourceItems as $resourceItem) {
            $this->incrementResourceItem($resourceItem);
        }

        //$this->sortResourceItems(); // для времени не нужно сортировать чтобы не сломать порядок
        return $this;
    }

    /**
     * @param GraphicResourceItem $resourceItem
     * @return mixed
     */
    public function getItemLabel(GraphicResourceItem $resourceItem)
    {
        return $this->segregationTypeStrategy->getStrategy($this->segregationType)->getResourceItemLabel($resourceItem);
    }
}
