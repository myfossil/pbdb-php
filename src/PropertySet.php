<?php
/**
 * PBDB PropertySet.
 *
 * @link       http://atmoapps.com
 * @since      0.0.1
 */

namespace myFOSSIL\PBDB;

/**
 * PBDB PropertySet.
 *
 * This class defines a set of Properties.
 *
 * @since      0.0.1
 * @author     Brandon Wood <bwood@atmoapps.com>
 */
class PropertySet extends BaseSet
{
    /**
     * Returns unique identifier used to determine hash in storage array.
     *
     * @since   0.0.1
     * @access  public
     * @param   Property    $prop   Property object to calculate hash with.
     * @see     \SplObjectStorage::getHash
     * @return  string      Identifier for property using PBDB vocabulary.
     */
    public function getHash( $prop ) {
        return $prop->pbdb;
    }

    /**
     * Load a given PBDB response object as a new PropertySet.
     *
     * @since   0.0.1
     * @access  public
     * @param   mixed       $resp               Parsed JSON object or array with Properties to load.
     * @return  PropertySet 
     */
    public function load( $resp ) {
        foreach ( $resp['records'] as $record ) {
            foreach ( $record as $k => $v ) {
                try {
                    $this->$k->value = $v;
                } catch ( \RuntimeException $_ ) {
                    $this->attach( new Property( $k ) );
                    $this->$k->value = $v;
                }
            }
        }

        return $this;
    }

}
