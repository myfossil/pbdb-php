<?php

use myFOSSIL\PBDB\Parameter;

class ParameterTest extends PHPUnit_Framework_Testcase {

    public function testInstantiation() {
        $param = new Parameter( 'id', 69296, false );
        $this->assertInstanceOf( 'myFOSSIL\PBDB\Parameter', $param );
    }

    public function testParameterSetRender() {
        $param = new Parameter( 'id', 69296, false );
        $this->assertContains( 'id=69296', $param->render() );
                
        $param = new Parameter( 'show', 'attr' );
        $this->assertContains( 'show=attr', $param->render() );

        $param = new Parameter( 'empty', null );
        $this->assertNull( $param->render() );
        $this->assertEmpty( $param->render() );
    }
}
