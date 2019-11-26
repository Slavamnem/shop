<?php

namespace App\Components\ShareConditions\ShareConditionBuilders;

use App\Adapters\Interfaces\ShareConditionsAdapterInterface;
use App\Components\ShareConditions\ConditionBoxes\AbstractConditionBox;
use App\Components\ShareConditions\Interfaces\ConditionBox;
use App\Components\ShareConditions\Interfaces\ShareConditionBuilderInterface;

class ShareConditionBuilder implements ShareConditionBuilderInterface
{
    /**
     * @var ShareConditionsAdapterInterface
     */
    private $shareConditionsAdapter;
    /**
     * @var ConditionBox
     */
    private $conditionsBox;

    /**
     * @param ShareConditionsAdapterInterface $shareConditionsAdapter
     * @return $this
     */
    public function createEmptyBox(ShareConditionsAdapterInterface $shareConditionsAdapter)
    {
        $this->shareConditionsAdapter = $shareConditionsAdapter;

        $this->conditionsBox = $this->shareConditionsAdapter->createMainBox();

        return $this;
    }

    public function fillBox()
    {
        $this->setChildrenBlocks($this->conditionsBox, $this->shareConditionsAdapter->getMainBlockChildren());
    }

    /**
     * @return ConditionBox
     */
    public function getConditionBox()
    {
        return $this->conditionsBox;
    }

    /**
     * @param ConditionBox $conditionBox
     * @param $childrenBlocksData
     */
    private function setChildrenBlocks(ConditionBox $conditionBox, $childrenBlocksData)
    {
        foreach ($childrenBlocksData as $childBlockData)
        {
            $childBlock = $this->shareConditionsAdapter->createConditionBlock($childBlockData);

            if ($childBlock instanceof AbstractConditionBox) {
                $this->setChildrenBlocks($childBlock, $this->shareConditionsAdapter->getConditionBlockChildren($childBlockData));
            }

            $conditionBox->addChild($childBlock);
        }
    }
}
