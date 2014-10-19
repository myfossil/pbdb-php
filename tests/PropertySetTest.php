<?php
/**
 * ./tests/PropertySetTest.php
 *
 * @author Brandon Wood <bwood@atmoapps.com>
 * @package myFOSSIL
 */


use myFOSSIL\PBDB\API;

class PropertySetTest extends PHPUnit_Framework_Testcase {

    /**
     *
     */
    public function testInstantiation()
    {
        $this->assertInstanceOf( 'myFOSSIL\PBDB\API\PropertySet', new API\PropertySet );
    }

    /**
     *
     */
    public function testPropertyReset()
    {
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
    public function testPropertyGet()
    {
        // Setup.
        $props = new API\PropertySet();
        $props->attach( new API\Property( 'test1', 'tst1', 'test', 'testvalue1' ) );
        $props->attach( new API\Property( 'test2', 'tst2', 'test', 'testvalue2' ) );
        $props->attach( new API\Property( 'test3', 'tst3', 'test', 'testvalue3' ) );

        $this->assertEquals( $props->test1, 'testvalue1' );
        $this->assertEquals( $props->test2, 'testvalue2' );
        $this->assertEquals( $props->test3, 'testvalue3' );
        $this->assertNull( $props->noexist );

        $props->test1 = 'updatedtestvalue1';
        $props->test2 = 'updatedtestvalue2';
        $props->test3 = 'updatedtestvalue3';
        $this->assertEquals( $props->test1, 'updatedtestvalue1' );
        $this->assertEquals( $props->test2, 'updatedtestvalue2' );
        $this->assertEquals( $props->test3, 'updatedtestvalue3' );
    }

}
