<?php

use myFOSSIL\PBDB\API;

class PBDB_API_Client_Test extends PHPUnit_Framework_Testcase {

    public function testInstantiation() {
        $client = new API\Client;
    }

}
