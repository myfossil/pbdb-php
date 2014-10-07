<?php
/**
 * PBDB API client
 *
 * @link       http://atmoapps.com
 * @since      0.0.1
 */

namespace myFOSSIL\PBDB;

/**
 * Base class for the PBDB API.
 *
 * This class defines all code necessary to interface with the PBDB API. It is
 * the foundation for objects available from the PBDB.
 *
 * @since      0.0.1
 * @author     Brandon Wood <bwood@atmoapps.com>
 */
class Base
{
    /**
     * The PBDB Client object.
     *
     * @since   0.0.1
     * @access  protected
     * @var     PBDB        $pbdb
     */
    public $pbdb;

    /**
     * Define the core functionality of the PBDB Client base.
     *
     * @since   0.0.1
     * @access  public
     */
    public function __construct() {
        $this->pbdb = new PBDB;
    }

    /**
     * Returns the PBDB API endpoint.
     *
     * @since   0.0.1
     * @access  public
     */
    public function endpoint() {
        return $this->endpoint;
    }

}
