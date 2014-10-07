<?php

use myFOSSIL\PBDB\API;

class ParameterTest extends PHPUnit_Framework_Testcase {

    public function testInstantiation() {
        $param = new API\Parameter( 'id', 69296, false );
        $this->assertInstanceOf( 'myFOSSIL\PBDB\API\Parameter', $param );
    }

    public function testParameterSetRender() {
        $param = new API\Parameter( 'id', 69296, false );
        $this->assertContains( 'id=69296', $param->render() );
                
        $param = new API\Parameter( 'show', 'attr' );
        $this->assertContains( 'show=attr', $param->render() );

        $param = new API\Parameter( 'empty', null );
        $this->assertNull( $param->render() );
        $this->assertEmpty( $param->render() );
    }
}
