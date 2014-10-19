<?php
/**
 * PBDB PropertySet.
 *
 * @link       http://atmoapps.com
 * @since      0.0.1
 * @author Brandon Wood <bwood@atmoapps.com>
 * @package myFOSSIL
 */


namespace myFOSSIL\PBDB\API;

/**
 * PBDB PropertySet.
 *
 * This class defines a set of Properties.
 *
 * @since      0.0.1
 * @author     Brandon Wood <bwood@atmoapps.com>
 */
class PropertySet extends AbstractSet
{

    /**
     * Returns unique identifier used to determine hash in storage array.
     *
     * @since   0.0.1
     * @access  public
     * @see     \SplObjectStorage::getHash
     * @param Property $prop Property object to calculate hash with.
     * @return  string      Identifier for property using PBDB vocabulary.
     */
    public function getHash( $prop )
    {
        return $prop->pbdb;
    }

    /**
     * Load a given PBDB response object as a new PropertySet.
     *
     * @since   0.0.1
     * @access  public
     * @param mixed   $resp Parsed JSON object or array with Properties to load.
     * @return  PropertySet
     */
    public function load( $resp )
    {
        if ( !array_key_exists( 'records', $resp ) )
            return;

        foreach ( $resp['records'] as $record ) {
            foreach ( $record as $k => $v ) {
                if ( is_array( $v ) && count( $v ) == 1 )
                    $v = $v[0];

                try {
                    $this->{ $k } = $v;
                } catch ( \RuntimeException $_ ) {
                    $this->attach( new Property( $k ) );
                    $this->{ $k } = $v;
                }
            }
        }

        return $this;
    }

    /**
     *
     *
     * @param unknown $k
     * @return unknown
     */
    public function block( $k )
    {
        if ( $k = $this->get_as_object( $k ) )
            return $k->block;
    }

}
