<?php
/**
 * ./tests/GeologicalTimeIntervalTest.php
 *
 * @author Brandon Wood <bwood@atmoapps.com>
 * @package myFOSSIL
 */


use myFOSSIL\PBDB\GeologicalTimeInterval;

class GeologicalTimeIntervalTest extends PHPUnit_Framework_Testcase {

    /**
     *
     */
    public function testInstantiation()
    {
        $time_interval = new GeologicalTimeInterval();
        $this->assertGreaterThanOrEqual( 5, $time_interval->properties->count() );
    }

    /**
     *
     */
    public function testRetrieveData()
    {
        $time_interval = new GeologicalTimeInterval();
        $time_interval->pbdbid = 16;

        $test_values = array(
            'record_type' => 'interval',
            'level' => 3,
            'color' => "#812B92"
        );

        foreach ( $test_values as $k => $v ) {
            $this->assertEquals( $v, $time_interval->{ $k } );
        }
    }

}
