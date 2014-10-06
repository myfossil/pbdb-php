<?php
/**
 * PBDB Parameter set.
 *
 * @link       http://atmoapps.com
 * @since      0.0.1
 *
 * @package    myFOSSIL_PBDB
 * @subpackage myFOSSIL_PBDB/includes/pbdb
 */
namespace myFOSSIL\PBDB;

/**
 * PBDB Parameter set.
 *
 * This class defines all information relating to a parameter of a PBDB object.
 *
 * @since      0.0.1
 * @package    myFOSSIL_PBDB
 * @subpackage myFOSSIL_PBDB/includes/pbdb
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
}
