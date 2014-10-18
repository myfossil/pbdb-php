<?php
/**
 * PBDB Parameter set.
 *
 * @link       http://atmoapps.com
 * @since      0.0.1
 */

namespace myFOSSIL\PBDB\API;

/**
 * PBDB Parameter set.
 *
 * This class defines all information relating to a parameter of a PBDB object.
 *
 * @since      0.0.1
 * @author     Brandon Wood <bwood@atmoapps.com>
 */
class ParameterSet extends AbstractSet
{
    /**
     * Returns unique identifier used to determine hash in storage array.
     *
     * @since   0.0.1
     * @access  public
     * @param   Parameter   $param  Property object to calculate hash with.
     * @see     \SplObjectStorage::getHash
     * @return  string      Identifier for parameter using PBDB vocabulary.
     */
    public function getHash( $param ) {
        return $param->name;
    }

    /**
     * Returns a URL style query string.
     *
     * @since   0.0.1
     * @access  public
     * @return  string  URL query string
     */
    public function render() {
        $rend = array();
        foreach ( $this as $param ) 
            $rend[] = $param->render();

        $result = implode( '&', array_filter( $rend ) );
        return $result ? $result : null;
    }

}
