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

        $data = array(
                'taxon' => "Pinocetus polonicus",
                'species' => "Pinocetus polonicus",
                'genus' => "Pinocetus",
                'family' => "Aglaocetidae",
                'order' => "Cetacea",
                'class' => "Mammalia",
                'phylum' => "Chordata",
                'kingdom' => "Metazoa",
            );

        $fossil = FossilOccurence::factory( 147937 );

        foreach ( $data as $lvl => $taxon_name ) {
            $expected = $taxon_name;
            $observed = $fossil->{ $lvl }->name;
            $this->assertEquals( $expected, $observed );
        }
    }

    public function testIncompleteTaxa() {
        $fossil_data_json = file_get_contents( 'tests/data/fossils-incomplete-taxa.json' );
        $fossil_data = json_decode( $fossil_data_json );

        $valid_ranks = array( 'species', 'genus', 'family', 'order', 'class',
                'phylum', 'kingdom' );

        // These are occurrence_no's that should probably be pointed out to
        // PBDB as being anomalous in how their taxonomy is being calculated.
        $exclude_ids = array( 461074, 462836 );

        foreach ( $fossil_data as $fossil_datum ) {
            $rank        = $fossil_datum->taxon_rank;
            $rank_no     = array_search( $rank, $valid_ranks );
            $fossil_no   = (int) $fossil_datum->occurrence_no;

            // Skip taxon ranks that we do not support
            if ( !in_array( $rank, $valid_ranks ) 
                    || in_array( $fossil_no, $exclude_ids )
                    || $rank == 'species' 
                    || $rank == 'kingdom' )
                continue;

            $rank_child  = $valid_ranks[ ( $rank_no - 1 ) ];
            $rank_parent = $valid_ranks[ ( $rank_no + 1 ) ];
            $taxon_no    = (int) $fossil_datum->taxon_no;


            $f = FossilOccurence::factory( $fossil_no );
            $this->assertEquals( $rank, $f->taxon->rank );
            $this->assertEquals( $taxon_no, $f->taxon_no );
            $this->assertEquals( $taxon_no, $f->taxon->pbdbid );
            $this->assertNull( $f->taxon->{ $rank_child } );
            $this->assertNotNull( $f->taxon->{ $rank_parent } );
        }

    }

    /*
    public function testGeochronology() {
        $keys = array( 'eon', 'era', 'period', 'epoch', 'age', 'chron' );
        $fossil = FossilOccurence::factory( 147937 );
    }

    public function testLithostratigraphy() {
        $keys = array( 'supergroup', 'group', 'formation', 'member', 'bed' );
    }
    */

}
