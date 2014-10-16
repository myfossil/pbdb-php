<?php

use myFOSSIL\PBDB\FossilOccurence;

class FossilOccurenceTest extends PHPUnit_Framework_Testcase {

    public function testInstantiation() {
        $fossil = new FossilOccurence;
        $this->assertGreaterThanOrEqual( 60, $fossil->api->properties->count() );
    }

    public function testRetrieveData() {
        $fossil = new FossilOccurence;
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

    public function testAbstractedRetrieveData() {
        $fossil = FossilOccurence::factory( 1001 );

        $this->assertContains( "Wellerellidae", $fossil->family->name );
        $this->assertContains( "Rhynchonellida", $fossil->order->name );
        $this->assertContains( "Rhynchonellata", $fossil->class->name );
        $this->assertContains( "Brachiopoda", $fossil->phylum->name );
        $this->assertContains( "Wellerella", $fossil->genus->name );
        $this->assertContains( "Wellerella", $fossil->taxon->name );
    }

}
