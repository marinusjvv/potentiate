<?php
namespace MarinusJvv\Potentiate;

use MarinusJvv\Potentiate\Exceptions\PackageCost;
 
class Potentiate
{
    /**
     * @var array Information for all items available
     */
    private $itemsInfo = array();

    /**
     * @var array Packages to be sent out
     */
    private $packages = array();

    /**
     * Sets up the information array. This is used later in order
     * to retrieve required data.
     */
    public function __construct()
    {
        $this->itemsInfo = json_decode(ITEM_LIST, true);
    }

    /**
     * @param array $ids The ids posted to the page
     *
     * @return array Processed packages data
     */
	public function process($ids)
	{
        $selectedItemsData = $this->getSelectedItemsData($ids);
        $this->setupEmptyPackages($selectedItemsData);
        $this->addItemsToPackages($selectedItemsData);
        return $this->packages;
	}

    /**
     * @param array $ids The ids which information will be retrieved
     * for. Non-integer values, or values which are out of bounds
     * (as in a hack attempt, etc.) will simply be ignored so the 
     * script can continue gracefully.
     *
     * @return array
     */
    private function getSelectedItemsData($ids)
    {
        $data = array();
        foreach ($ids as $id) {
            if (array_key_exists((int)$id, $this->itemsInfo) === false) {
                continue;
            }
            $data[] = (object)$this->itemsInfo[(int)$id];
        }
        usort($data, array($this, "compareWeights"));
        return $data;
    }

    /**
     * @param array $data Array of all selected items
     */
    private function setupEmptyPackages($data)
    {
        $package_count = $this->getPackageCount($data);
        for ($i = 0; $i < $package_count; $i++) {
            $this->packages[] = new Package();
        }
    }

    /**
     * @param array $data Array of all selected items
     *
     * @return int Amount of packages to be used
     */
    private function getPackageCount($data)
    {
        $total_cost = 0;
        foreach ($data as $item) {
            $total_cost += $item->price;
        }
        return ceil($total_cost / MAX_VALUE);
    }

    /**
     * Adds items to proper packages, according to the rules
     * set up in the test description.
     * 
     * The code tries to add the item to the current lightest
     * package. If it fails (PackageCost Exception thrown), it
     * adds the package id to an ignore list, and tries the
     * next lightest package until it has success.
     *
     * @param array $data Array of all selected items
     */
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

    /**
     * Gets the current lightest package by iterating through the
     * packages and looking at their current total weight.
     *
     * @param array $ignored Ids of packages not to be included
     *
     * @return int Id of lightest package that isn't ignored
     */
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

    /**
     * Checks that the amount of times the script has failed
     * to add an item to a package does not reach an enormous
     * amount. This is mainly to prevent an infinite loop.
     *
     * @param int $failcount Current amount of failures
     */
    private function checkFailCount($failCount)
    {
        if ($failCount > count($this->packages) + 5) {
            exit('Something went wrong :(');
        }
    }

    /**
     * Compares weights in order to arrange them from largest
     * to smallest.
     *
     * @param object $a Item a to be checked
     * @param object $b Item b to be checked
     *
     * @return int
     */
    private function compareWeights($a, $b)
    {
        return strcmp($b->weight, $a->weight);
    }
}
