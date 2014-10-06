<?php
/**
 * Base Set.
 *
 * @link       http://atmoapps.com
 * @since      0.0.1
 *
 * @package    myFOSSIL
 * @subpackage myFOSSIL/PBDB
 */
namespace myFOSSIL\PBDB;

/**
 * Base Set.
 *
 * This class defines all information relating to a parameter of a PBDB object.
 *
 * @since      0.0.1
 * @package    myFOSSIL
 * @subpackage myFOSSIL/PBDB
 * @author     Brandon Wood <bwood@atmoapps.com>
 */
abstract class BaseSet extends \SplObjectStorage 
{
    /**
     * Remove all objects in the Set.
     *
     * @since   0.0.1
     */
    public function reset() {
        $this->removeAll( $this );
    }

    public function __get( $key ) {
        foreach ( $this as $obj )
            if ( $this->getHash( $obj ) == $key )
                return $obj;

        // Key not found, trigger error
        throw new \RuntimeException( "Set does not contain the provided key $key." );
        return null;
    }

}
