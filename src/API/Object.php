<?php
/**
 * PBDB API client
 *
 * @link       http://atmoapps.com
 * @since      0.0.1
 */

namespace myFOSSIL\PBDB\API;

/**
 * Base class for the PBDB API.
 *
 * This class defines all code necessary to interface with the PBDB API. It is
 * the foundation for objects available from the PBDB.
 *
 * @since      0.0.1
 * @author     Brandon Wood <bwood@atmoapps.com>
 */
class Object
{
    /**
     * The PBDB Client object.
     *
     * @since   0.0.1
     * @access  protected
     * @var     Client      $api
     */
    public $api;

    /**
     * Define the core functionality of the PBDB Client base.
     *
     * @since   0.0.1
     * @access  public
     */
    public function __construct() {
        $this->api = new Client;
    }

}
