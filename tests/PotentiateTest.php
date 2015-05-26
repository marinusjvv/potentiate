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


    public function testProcessGivenExpensiveItemLateDoesNotFail()
    {
        $potentiate = new Potentiate();
        $returned = $potentiate->process(array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15));

        $expected = array(
            0 => array(
                'total_weight' => 1020,
                'total_cost' => 249,
                'courier_price' => 20,
                'item_count' => 3,
            ),
            1 => array(
                'total_weight' => 990,
                'total_cost' => 140,
                'courier_price' => 15,
                'item_count' => 2,
            ),
            2 => array(
                'total_weight' => 950,
                'total_cost' => 153,
                'courier_price' => 15,
                'item_count' => 2,
            ),
            3 => array(
                'total_weight' => 850,
                'total_cost' => 170,
                'courier_price' => 15,
                'item_count' => 3,
            ),
            4 => array(
                'total_weight' => 920,
                'total_cost' => 170,
                'courier_price' => 15,
                'item_count' => 4,
            ),
            5 => array(
                'total_weight' => 10,
                'total_cost' => 200,
                'courier_price' => 5,
                'item_count' => 1,
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
