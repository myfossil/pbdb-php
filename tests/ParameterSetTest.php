<?php

use myFOSSIL\PBDB\Parameter;
use myFOSSIL\PBDB\ParameterSet;

class ParameterSetTest extends PHPUnit_Framework_Testcase {

    public function testInstantiation() {
        $this->assertInstanceOf( 'myFOSSIL\PBDB\ParameterSet', new ParameterSet );
    }

    public function testParameterSetRender() {
        $params = new ParameterSet();

        $params->attach( new Parameter( 'id', 69296, false ) );
        $params->attach( new Parameter( 'show', 'attr' ) );
        $params->attach( new Parameter( 'empty', null ) );

        $render = $params->render();

        $this->assertContains( 'id=69296', $render );
        $this->assertContains( 'show=attr', $render );
        $this->assertNotContains( 'empty', $render );
    }
}
