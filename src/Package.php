<?php
namespace MarinusJvv\Potentiate;

use MarinusJvv\Potentiate\Exceptions\PackageCost;
 
class Package
{
    /**
     * @var int Current total weight of package
     */
    private $totalWeight = 0;

    /**
     * @var int Current total cost of items
     */
    private $totalCost = 0;

    /**
     * @var int Current cost of courier-ing package
     */
    private $courierCharge = 0;

    /**
     * @var array Items added to package
     */
    private $items = array();

    /**
     * @return int Current total weight of package
     */
    public function getTotalWeight()
    {
        return $this->totalWeight;
    }

    /**
     * @return int Current total cost of package
     */
    public function getTotalCost()
    {
        return $this->totalCost;
    }

    /**
     * @return int Current total cost of courier-ing package
     */
    public function getCourierCharge()
    {
        return $this->courierCharge;
    }

    /**
     * @return array Current items added to package
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * @param object Item to be added to package
     */
    public function addItem($item)
    {
        $this->testItemAllowed($item);
        $this->addItemData($item);
        $this->recalculateCourierCharge();
    }

    /**
     * Checks to see if item attempting to be added does not
     * exceed the maximum value allowed.
     *
     * @param object $item The item to be added
     * 
     * @throws PackageCost
     */
    private function testItemAllowed($item)
    {
        if ($this->getTotalCost() + $item->price > MAX_VALUE) {
            throw new PackageCost();
        }
    }

    /**
     * Adds all necessary data from item to package totals
     * 
     * @param object $item $item added
     */
    private function addItemData($item)
    {
        $this->items[] = $item;
        $this->totalWeight += $item->weight;
        $this->totalCost += $item->price;
    }

    /**
     * Calculates the current cost to send the package
     */
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
