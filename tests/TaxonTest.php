<?php

use myFOSSIL\PBDB\Taxon;

class TaxonTest extends PHPUnit_Framework_Testcase {

    public function testInstantiation() {
        $taxon = new Taxon();
        $this->assertGreaterThanOrEqual( 60, $taxon->properties->count() );
    }

    public function testRetrieveData() {
        $taxon = new Taxon();
        $taxon->parameters->id->value = 69296;
        $taxon->load();

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
            $this->assertEquals( $v, $taxon->properties->$k->value );
        }
    }

    public function testParentRetrieve() {
        $taxon = new Taxon();
        $taxon->parameters->id->value = 69296;
        $taxon->load();

        $test_values = array(
                'Dascilloidea',
                'Elateriformia',
                'Polyphaga',
                'Coleoptera', 
                'Coleopterida',
                'Endopterygota',
                'Neoptera',
                'Pterygota',
                'Dicondylia',
                'Insecta',
                'Hexapoda',
                'Pancrustacea',
                'Mandibulata',
            );

        foreach ( $test_values as $taxon_name ) {
            $taxon = $taxon->parent();
            $this->assertEquals( $taxon_name, $taxon->properties->taxon_name->value );
        }
    }
}
