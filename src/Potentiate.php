<?php
namespace MarinusJvv\Potentiate;

use MarinusJvv\Potentiate\Packages\Package;
use MarinusJvv\Potentiate\Exceptions\PackageCost;
 
class Potentiate
{
    private $itemInfo;
    private $packages = array();

    public function __construct()
    {
        $this->itemInfo = json_decode(ITEM_LIST, true);
    }

	public function process($ids)
	{
        $selectedItemsData = $this->getSelectedItemsData($ids);
        $this->setupPackages($selectedItemsData);
        $this->addItemsToPackages($selectedItemsData);
        return $this->packages;
	}

    private function getSelectedItemsData($ids)
    {
        $data = array();
        foreach ($ids as $id) {
            if (array_key_exists((int)$id, $this->itemInfo) === false) {
                continue;
            }
            $data[] = (object)$this->itemInfo[(int)$id];
        }
        usort($data, array($this, "compareWeights"));
        return $data;
    }

    private function setupPackages($data)
    {
        $package_count = $this->getPackageCount($data);
        for ($i = 0; $i < $package_count; $i++) {
            $this->packages[] = new Package();
        }
    }

    private function getPackageCount($data)
    {
        $total_cost = 0;
        foreach ($data as $item) {
            $total_cost += $item->price;
        }
        return ceil($total_cost / MAX_VALUE);
    }

    private function addItemsToPackages($data)
    {
        foreach ($data as $item) {
            $failCount = 0;
            $itemSuccessfullyAdded = false;
            $ignoredPackageIds = array();
            while ($itemSuccessfullyAdded === false) {
                $lightestPackageId = $this->getLightestPackage($ignoredPackageIds);
                try {
                    $this->packages[$lightestPackageId]->addItem($item);
                    $itemSuccessfullyAdded = true;
                } catch (PackageCost $e) {
                    $ignoredPackageIds[] = $lightestPackageId;
                    $failCount++;
                }
                $this->checkFailCount($failCount);
            }
        }
    }

    private function getLightestPackage($ignored)
    {
        $lightestWeight = $this->packages[0]->getTotalWeight();
        $lightestId = 0;
        foreach ($this->packages as $id => $package) {
            if (in_array($id, $ignored)) {
                continue;
            }
            if ($package->getTotalWeight() < $lightestWeight) {
                $lightestWeight = $package->getTotalWeight();
                $lightestId = $id;
            }
        }
        return $lightestId;
    }

    private function checkFailCount($failCount)
    {
        if ($failCount > count($this->packages)) {
            exit('Something went wrong :(');
        }
    }

    private function compareWeights($a, $b)
    {
        return strcmp($b->weight, $a->weight);
    }
}
