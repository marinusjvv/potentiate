<?php

use MarinusJvv\Potentiate\Packages;

class PackageTest extends PHPUnit_Framework_TestCase
{
    public function testAddItemIncrementsTotalWeight()
    {
        $package = new Package();
        $item = new stdClass();
        $item->weight = 100;
        $item->price = 200;
        $package->addItem($item);
        $this->assertEquals(100, $package->getTotalWeight());
    }

    public function testAddItemIncrementsTotalCost()
    {
        $package = new Package();
        $item = new stdClass();
        $item->weight = 100;
        $item->price = 200;
        $package->addItem($item);
        $this->assertEquals(200, $package->getTotalCost());
    }

    public function testAddItemCostTooHighThrowsException()
    {
        $this->setExpectedException('MarinusJvv\Potentiate\Exceptions\PackageCost');
        $package = new Package();
        $item = new stdClass();
        $item->weight = 100;
        $item->price = 260;
        $package->addItem($item);
    }

    public function testAddItemAddsItem()
    {
        $package = new Package();
        $item = new stdClass();
        $item->weight = 100;
        $item->price = 200;
        $package->addItem($item);
        $items = $package->getItems();
        $this->assertEquals($item, $items[0]);
        $this->assertEquals(5, $package->getCourierCharge());
    }
}
