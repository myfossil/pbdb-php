<?php

use myFOSSIL\PBDB\API;

class ParameterSetTest extends PHPUnit_Framework_Testcase {

    public function testInstantiation() {
        $this->assertInstanceOf( 'myFOSSIL\PBDB\API\ParameterSet', new API\ParameterSet );
    }

    public function testParameterSetRender() {
        // Setup.
        $params = new API\ParameterSet();
        $params->attach( new API\Parameter( 'id', 69296, false ) );
        $params->attach( new API\Parameter( 'show', 'attr' ) );
        $params->attach( new API\Parameter( 'empty', null ) );

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
        $params = new API\ParameterSet();
        $params->attach( new API\Parameter( 'id', 69296, false ) );
        $params->attach( new API\Parameter( 'show', 'attr' ) );
        $params->attach( new API\Parameter( 'empty', null ) );
    
        $this->assertEquals( 3, $params->count() );

        $params->reset();
        $this->assertEquals( 0, $params->count() );
    }

    /**
     * Test that we can get API\Parameters by ID.
     */
    public function testParameterGet() {
        // Setup.
        $params = new API\ParameterSet();
        $params->attach( new API\Parameter( 'id', 69296, false ) );
        $params->attach( new API\Parameter( 'show', 'attr' ) );
        $params->attach( new API\Parameter( 'empty', null ) );

        $this->assertEquals( 69296 , $params->id->value );
        $this->assertEquals( 'attr', $params->show->value );
        $this->assertEquals( null  , $params->empty->value );

        $this->assertNull( $params->noexist );
    }

}
