<?php

namespace Sylake\AkeneoProducerBundle\Connector\Projector;

use Sylake\AkeneoProducerBundle\Connector\ItemSetInterface;

final class ItemsProjector
{
    /** @var ItemSetInterface */
    private $itemSet;

    /** @var ItemProjectorInterface */
    private $itemProjector;

    public function __construct(ItemSetInterface $itemSet, ItemProjectorInterface $itemProjector)
    {
        $this->itemSet = $itemSet;
        $this->itemProjector = $itemProjector;
    }

    public function postFlush()
    {
        $this();
    }

    public function __invoke()
    {
        foreach ($this->itemSet->all() as $item) {
            $this->itemProjector->__invoke($item);
        }

        $this->itemSet->clear();
    }
}
