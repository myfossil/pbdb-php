<?php

use myFOSSIL\PBDB\Fossil\Occurence;

class FossilOccurenceTest extends PHPUnit_Framework_Testcase {

    public function testInstantiation() {
        $fossil = new Occurence;
        $this->assertGreaterThanOrEqual( 60, $fossil->api->properties->count() );
    }

    public function testRetrieveData() {
        $fossil = new Occurence;
        $fossil->api->parameters->id->value = 1001;
        $fossil->api->load();

        $test_values = array(
                'occurrence_no' => 1001,
                'record_type' => 'occurrence',
                'taxon_name' => "Wellerella sp.",
            );

        foreach ( $test_values as $k => $v ) {
            $this->assertEquals( $v, $fossil->api->properties->$k->value );
        }
    }

}
