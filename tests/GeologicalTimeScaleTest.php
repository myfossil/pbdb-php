<?php
/**
 * ./tests/GeologicalTimeScaleTest.php
 *
 * @author Brandon Wood <bwood@atmoapps.com>
 * @package myFOSSIL
 */


use myFOSSIL\PBDB\GeologicalTimeScale;

class GeologicalTimeScaleTest extends PHPUnit_Framework_Testcase {

    /**
     *
     */
    public function testInstantiation()
    {
        $time_scale = new GeologicalTimeScale();
        $this->assertGreaterThanOrEqual( 5, $time_scale->properties->count() );
    }

    /**
     *
     */
    public function testRetrieveData()
    {
        $time_scale = new GeologicalTimeScale();
        $time_scale->pbdbid = 1;

        $test_values = array(
            'record_type' => 'timescale',
            'scale_name' => "International Commission on Stratigraphy",
            'num_levels' => 5
        );

        foreach ( $test_values as $k => $v ) {
            $this->assertEquals( $v, $time_scale->{ $k } );
        }
    }

}
