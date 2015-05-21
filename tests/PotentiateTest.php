<?php

use MarinusJvv\Potentiate\Potentiate;

class PotentiateTest extends PHPUnit_Framework_TestCase
{
    public function testProcessGivenSetDataReturnsExpectedData()
    {
    	$potentiate = new Potentiate();
        $returned = $potentiate->process(array(1, 2, 3, 4, 6, 7));

        $expected = array(
            0 => array(
                'total_weight' => 530,
                'total_cost' => 160,
                'courier_price' => 15,
                'item_count' => 3,
            ),
            1 => array(
                'total_weight' => 510,
                'total_cost' => 240,
                'courier_price' => 15,
                'item_count' => 3,
            ),
        );
        $count = 0;
        foreach ($returned as $data) {
            $this->assertEquals($expected[$count]['total_weight'], $data->getTotalWeight());
            $this->assertEquals($expected[$count]['total_cost'], $data->getTotalCost());
            $this->assertEquals($expected[$count]['courier_price'], $data->getCourierCharge());
            $this->assertEquals($expected[$count]['item_count'], count($data->getItems()));
            $count++;
        }
    }
}
