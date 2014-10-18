<?php

use myFOSSIL\PBDB\FossilOccurence;

class FossilOccurenceTest extends PHPUnit_Framework_Testcase {

    public function testInstantiation() {
        $fossil = new FossilOccurence;
        $this->assertGreaterThanOrEqual( 60, $fossil->properties->count() );
    }

    public function testBlocks() {
        $fossil = new FossilOccurence;
        $show_blocks = $fossil->blocks();
        $this->assertContains( 'coords', $show_blocks );
    }

    public function testRetrieveData() {
        $fossil = new FossilOccurence;
        $fossil->pbdbid = 1001;

        $test_values = array(
                'occurrence_no' => 1001,
                'record_type' => 'occurrence',
                'taxon_name' => "Wellerella sp.",
            );

        foreach ( $test_values as $k => $v ) {
            $this->assertEquals( $v, $fossil->{ $k } );
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
