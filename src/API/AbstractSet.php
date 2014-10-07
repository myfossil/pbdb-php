<?php
/**
 * Base Set.
 *
 * @link       http://atmoapps.com
 * @since      0.0.1
 */

namespace myFOSSIL\PBDB\API;

/**
 * Base Set.
 *
 * This class defines all information relating to a parameter of a PBDB object.
 *
 * @since      0.0.1
 * @author     Brandon Wood <bwood@atmoapps.com>
 */
abstract class AbstractSet extends \SplObjectStorage 
{
    /**
     * Remove all objects in the Set.
     *
     * @since   0.0.1
     */
    public function reset() {
        $this->removeAll( $this );
    }

    /**
     * Magic method that overrides get behavior.
     *
     * The purpose of this overload is to easily get properties or parameters
     * from given parameter or property sets.
     *
     * @since   0.0.1
     * @throws  \RuntimeException   If the set does not contain the key provided.
     * @param   mixed   $key        Hash resulting from obj::getHash()
     * @return  mixed               Object with a given hash key.
     */
    public function __get( $key ) {
        foreach ( $this as $obj )
            if ( $this->getHash( $obj ) == $key )
                return $obj;

        // Key not found, trigger error
        throw new \RuntimeException( "Set does not contain the provided key $key." );
    }

}
