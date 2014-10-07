<?php

use myFOSSIL\PBDB\FossilOccurence;

class FossilOccurenceTest extends PHPUnit_Framework_Testcase {

    public function testInstantiation() {
        $fossil = new FossilOccurence();
        $this->assertGreaterThanOrEqual( 60, $fossil->pbdb->properties->count() );
    }

    public function testRetrieveData() {
        $fossil = new FossilOccurence();
        $fossil->pbdb->parameters->id->value = 1001;
        $fossil->pbdb->load( $fossil->endpoint() );

        $test_values = array(
                'occurrence_no' => 1001,
                'record_type' => 'occurrence',
                'taxon_name' => "Wellerella sp.",
            );

        foreach ( $test_values as $k => $v ) {
            $this->assertEquals( $v, $fossil->pbdb->properties->$k->value );
        }
    }

}
