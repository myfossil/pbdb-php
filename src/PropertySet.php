<?php
/**
 * PBDB PropertySet.
 *
 * @link       http://atmoapps.com
 * @since      0.0.1
 *
 * @package    myFOSSIL
 * @subpackage myFOSSIL/PBDB
 */
namespace myFOSSIL\PBDB;

/**
 * PBDB PropertySet.
 *
 * This class defines a set of Properties.
 *
 * @since      0.0.1
 * @package    myFOSSIL
 * @subpackage myFOSSIL/PBDB
 * @author     Brandon Wood <bwood@atmoapps.com>
 */
class PropertySet extends BaseSet
{
    /**
     * Returns unique identifier used to determine hash in storage array.
     *
     * @var     Property    $prop   Property object to calculate hash with.
     * @see     \SplObjectStorage::getHash
     * @return  string      Identifier for property using PBDB vocabulary.
     */
    public function getHash( $prop ) {
        return $prop->pbdb;
    }
}
