<?php
/**
 * ./tests/PropertyTest.php
 *
 * @author Brandon Wood <bwood@atmoapps.com>
 * @package myFOSSIL
 */


use myFOSSIL\PBDB\API;

class PropertyTest extends PHPUnit_Framework_Testcase {

    /**
     *
     */
    public function testInstantiation()
    {
        $param = new API\Property( 'id', 69296, false );
        $this->assertInstanceOf( 'myFOSSIL\PBDB\API\Property', $param );
    }

}
