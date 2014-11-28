<?php
/**
 * ./tests/TaxonTest.php
 *
 * @author Brandon Wood <bwood@atmoapps.com>
 * @package myFOSSIL
 */


use myFOSSIL\PBDB\Taxon;

class TaxonTest extends PHPUnit_Framework_Testcase {

    /**
     *
     */
    public function testInstantiation()
    {
        $taxon = new Taxon();
        $this->assertGreaterThanOrEqual( 60, $taxon->properties->count() );
    }

    /**
     *
     */
    public function testRetrieveData()
    {
        $taxon = new Taxon();
        $taxon->pbdbid = 69296;

        $test_values = array(
            'taxon_no'    => 69296,
            'orig_no'     => 69296,
            'record_type' => 'taxon',
            'rank'        => 'family',
            'taxon_name'  => 'Dascillidae',
            'common_name' => 'soft bodied plant beetle',
            'status'      => 'belongs to',
            'parent_no'   => 69295
        );

        foreach ( $test_values as $k => $v ) {
            $this->assertEquals( $v, $taxon->$k );
        }
    }


    /**
     *
     */
    public function testFactory()
    {
        $taxon = Taxon::factory( 53140 );
        $this->assertEquals( $taxon->name, "Pinocetus polonicus" );
    }

    /**
     *
     */
    public function testHierarchy()
    {
        // from {@link http://paleobiodb.org/data1.1/taxa/single.json?id=53140}
        $data = array(
            'species' => "Pinocetus polonicus",
            'genus' => "Pinocetus",
            'family' => "Aglaocetidae",
            'order' => "Cetacea",
            'class' => "Mammalia",
            'phylum' => "Chordata",
            'kingdom' => "Metazoa",
        );

        $taxon = Taxon::factory( 53140 );

        foreach ( $data as $lvl => $taxon_name ) {
            $expected = $taxon_name;
            $observed = $taxon->{ $lvl }->name;
            $this->assertEquals( $expected, $observed );
        }

    }

}
