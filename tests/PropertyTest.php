<?php

use myFOSSIL\PBDB\Property;

class PropertyTest extends PHPUnit_Framework_Testcase {

    public function testInstantiation() {
        $param = new Property( 'id', 69296, false );
        $this->assertInstanceOf( 'myFOSSIL\PBDB\Property', $param );
    }

}
