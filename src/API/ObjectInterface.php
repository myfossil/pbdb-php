<?php
/**
 * PBDB API Interface
 *
 * @link       http://atmoapps.com
 * @since      0.0.1
 * @author Brandon Wood <bwood@atmoapps.com>
 * @package myFOSSIL
 */


namespace myFOSSIL\PBDB\API;

/**
 * PBDB API Interface
 *
 * @since      0.0.1
 * @author     Brandon Wood <bwood@atmoapps.com>
 */
interface ObjectInterface
{

    /**
     * Returns instance of class, loaded with given id.
     *
     * @since   0.0.1
     * @access  public
     * @param int     $id ID of the object to create and load.
     */
    public static function factory( $id );

    /**
     * Loads a given class instance from PBDB with a given id.
     *
     * @since   0.0.1
     * @access  public
     */
    //public function load();
}
