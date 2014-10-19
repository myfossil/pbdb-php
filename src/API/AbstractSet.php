<?php
/**
 * Base Set.
 *
 * @link       http://atmoapps.com
 * @since      0.0.1
 * @author Brandon Wood <bwood@atmoapps.com>
 * @package myFOSSIL
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
    public function reset()
    {
        $this->removeAll( $this );
    }

    /**
     * Magic method that overrides get behavior.
     *
     * The purpose of this overload is to easily get properties or parameters
     * from given parameter or property sets.
     *
     * @since   0.0.1
     * @param mixed   $key Hash resulting from obj::getHash()
     * @return  mixed               Object with a given hash key.
     */
    public function __get( $key )
    {
        foreach ( $this as $obj )
            if ( $this->getHash( $obj ) == $key )
                if ( property_exists( $obj, 'value' ) )
                    return $obj->value;
                else
                    return $obj;
                return null;
    }

    /**
     *
     *
     * @param unknown $key
     * @return unknown
     */
    public function get_as_object( $key )
    {
        foreach ( $this as $obj )
            if ( $this->getHash( $obj ) == $key )
                return $obj;
            return null;
    }


    /**
     * Magic method that overrides set behavior.
     *
     * The purpose of this overload is to easily get properties or parameters
     * from given parameter or property sets.
     *
     * @since   0.0.1
     * @param mixed   $key   Hash resulting from obj::getHash()
     * @param mixed   $value value
     * @return  mixed               Object with a given hash key.
     */
    public function __set( $key, $value )
    {
        foreach ( $this as $obj ) {
            if ( $this->getHash( $obj ) == $key ) {
                if ( is_a( $value, 'Property' ) || is_a( $value, 'Parameter' ) ) {
                    $this->detach( $obj );
                    $this->attach( $value );
                } else {
                    $this->detach( $obj );
                    $obj->value = $value;
                    $this->attach( $obj );
                }
                return $value;
            }
        }

        return $value;
    }
}
