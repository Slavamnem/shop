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
use App\Strategies\Interfaces\StrategyInterface;

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
        parent::__construct();
    }

    /**
     * @param GraphicResourceItem $resourceItem
     * @return mixed
     */
    public function getItemLabel(GraphicResourceItem $resourceItem)
    {
        return $this->segregationTypeStrategy->getStrategy($this->segregationType)->getResourceItemLabel($resourceItem);
//        return $resourceItem->getLabel();
//        return lang("months." . $resourceItem->getCreationDate()->format('F'));
    }
}
