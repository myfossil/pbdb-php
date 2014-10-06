<?php
/**
 * PBDB Parameter set.
 *
 * @link       http://atmoapps.com
 * @since      0.0.1
 *
 * @package    myFOSSIL
 * @subpackage myFOSSIL/PBDB
 */
namespace myFOSSIL\PBDB;

/**
 * PBDB Parameter set.
 *
 * This class defines all information relating to a parameter of a PBDB object.
 *
 * @since      0.0.1
 * @package    myFOSSIL
 * @subpackage myFOSSIL/PBDB
 * @author     Brandon Wood <bwood@atmoapps.com>
 */
class ParameterSet extends BaseSet
{
    /**
     * Returns unique identifier used to determine hash in storage array.
     *
     * @var     Parameter   $param  Property object to calculate hash with.
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
     * @return  string  URL query string
     */
    public function render() {
        // Return null if we have no Parameters.
        if ( !$this->count() ) return null;

        $rend = array();
        foreach ( ParameterSet::filter( $this ) as $param ) 
            $rend[] = $param->render();

        return implode( '&', $rend );
    }

    /**
     * Return filtered ParameterSet.
     *
     * @since   0.0.1
     * @return  ParameterSet
     */
    public static function filter( $params ) {
        $filtered = new ParameterSet;
        foreach ( $params as $p )
            if ( !empty( $p->value ) )
                $filtered->attach( $p );

        return $filtered;
    }
}
