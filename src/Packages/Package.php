<?php
namespace MarinusJvv\Potentiate\Packages;

use MarinusJvv\Potentiate\Exceptions\PackageCost;
 
class Package
{
    private $totalWeight = 0;
    private $totalCost = 0;
    private $courierCharge = 0;
    private $items = array();

    public function getTotalWeight()
    {
        return $this->totalWeight;
    }

    public function getTotalCost()
    {
        return $this->totalCost;
    }

    public function getCourierCharge()
    {
        return $this->courierCharge;
    }

    public function getItems()
    {
        return $this->items;
    }

    public function addItem($item)
    {
        $this->testItemAllowed($item);
        $this->addItemData($item);
        $this->recalculateCourierCharge();
    }

    private function testItemAllowed($item)
    {
        if ($this->getTotalCost() + $item->price > MAX_VALUE) {
            throw new PackageCost();
        }
    }

    private function addItemData($item)
    {
        $this->items[] = $item;
        $this->totalWeight += $item->weight;
        $this->totalCost += $item->price;
    }

    private function recalculateCourierCharge()
    {
        foreach (json_decode(COST_LIST, true) as $cost) {
            if ($this->getTotalWeight() >= (int)$cost['low_weight']
                && $this->getTotalWeight() <= (int)$cost['high_weight']) {
                $this->courierCharge = (int)$cost['charge'];
            }
        }
    }
}
