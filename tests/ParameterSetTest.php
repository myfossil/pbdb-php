<?php

use myFOSSIL\PBDB\Parameter;
use myFOSSIL\PBDB\ParameterSet;

class ParameterSetTest extends PHPUnit_Framework_Testcase {

    public function testInstantiation() {
        $this->assertInstanceOf( 'myFOSSIL\PBDB\ParameterSet', new ParameterSet );
    }

    public function testParameterSetRender() {
        // Setup.
        $params = new ParameterSet();
        $params->attach( new Parameter( 'id', 69296, false ) );
        $params->attach( new Parameter( 'show', 'attr' ) );
        $params->attach( new Parameter( 'empty', null ) );

        // Test that we're rendering properly.
        $render = $params->render();
        $this->assertContains( 'id=69296', $render );
        $this->assertContains( 'show=attr', $render );
        $this->assertNotContains( 'empty', $render );

        // Test that given an empty set, that nothing is rendered.
        $params->reset();
        $this->assertNull( $params->render() );
        $this->assertEmpty( $params->render() );
    }

    public function testParameterReset() {
        // Setup.
        $params = new ParameterSet();
        $params->attach( new Parameter( 'id', 69296, false ) );
        $params->attach( new Parameter( 'show', 'attr' ) );
        $params->attach( new Parameter( 'empty', null ) );
    
        $this->assertEquals( 3, $params->count() );

        $params->reset();
        $this->assertEquals( 0, $params->count() );
    }
}
