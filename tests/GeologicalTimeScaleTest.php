<?php

use myFOSSIL\PBDB\GeologicalTimeScale;

class GeologicalTimeScaleTest extends PHPUnit_Framework_Testcase {

    public function testInstantiation() {
        $time_scale = new GeologicalTimeScale();
        $this->assertGreaterThanOrEqual( 5, $time_scale->api->properties->count() );
    }

    public function testRetrieveData() {
        $time_scale = new GeologicalTimeScale();
        $time_scale->api->parameters->id->value = 1;
        $time_scale->api->load();

        $test_values = array(
                'record_type' => 'timescale',
                'scale_name' => "International Commission on Stratigraphy",
                'num_levels' => 5
            );

        foreach ( $test_values as $k => $v ) {
            $this->assertEquals( $v, $time_scale->api->properties->$k->value );
        }
    }

}
