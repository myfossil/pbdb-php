<?php

use myFOSSIL\PBDB\Taxon;

class TaxonTest extends PHPUnit_Framework_Testcase {

    public function testInstantiation() {
        $taxon = new Taxon();
        $this->assertTrue( $taxon->init() );
        $this->assertGreaterThanOrEqual( 64, $taxon->properties->count() );
    }

}
