<?php

use myFOSSIL\PBDB\Taxon;

class TaxonTest extends PHPUnit_Framework_Testcase {

    public function testInstantiation() {
        $taxon = new Taxon();
        $this->assertGreaterThanOrEqual( 60, $taxon->api->properties->count() );
    }

    public function testRetrieveData() {
        $taxon = new Taxon();
        $taxon->api->parameters->id->value = 69296;
        $taxon->api->load();

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
            $this->assertEquals( $v, $taxon->api->properties->$k->value );
        }
    }

    public function testParentRetrieve() {
        $taxon = new Taxon();
        $taxon->api->parameters->id->value = 69296;
        $taxon->api->load();

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
            $this->assertEquals( $taxon_name, $taxon->api->properties->taxon_name->value );
        }
    }
}
