<?php

use MarinusJvv\Potentiate\Potentiate;

class PotentiateTest extends PHPUnit_Framework_TestCase
{
    public function testThingsWork()
    {
    	$pot = new Potentiate();
        $this->assertTrue($pot->someTest(true));
    }
}
