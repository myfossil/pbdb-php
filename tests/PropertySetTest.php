<?php

use myFOSSIL\PBDB\API;

class PropertySetTest extends PHPUnit_Framework_Testcase {

    public function testInstantiation() {
        $this->assertInstanceOf( 'myFOSSIL\PBDB\API\PropertySet', new API\PropertySet );
    }

    public function testPropertyReset() {
        // Setup.
        $props = new API\PropertySet();
        $props->attach( new API\Property( 'test1', 'tst1', 'test' ) );
        $props->attach( new API\Property( 'test2', 'tst2', 'test' ) );
        $props->attach( new API\Property( 'test3', 'tst3', 'test' ) );

        $this->assertEquals( 3, $props->count() );

        $props->reset();
        $this->assertEquals( 0, $props->count() );
    }

    /**
     * Test that we can get Properties by ID.
     */
    public function testPropertyGet() {
        // Setup.
        $props = new API\PropertySet();
        $props->attach( new API\Property( 'test1', 'tst1', 'test' ) );
        $props->attach( new API\Property( 'test2', 'tst2', 'test' ) );
        $props->attach( new API\Property( 'test3', 'tst3', 'test' ) );

        $this->assertEquals( 'tst1', $props->test1->compacted );
        $this->assertEquals( 'tst2', $props->test2->compacted );
        $this->assertContains( 'test', $props->test3->block );

        $this->assertNull( $props->noexist );
    }

}
