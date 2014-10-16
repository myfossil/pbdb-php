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
     * myFOSSIL UUID
     *
     * @since   0.0.1
     * @access  public
     */
    public $uuid;

    /**
     * Cache
     */
    protected $_cache;

    /**
     * Define the core functionality of the PBDB Client base.
     *
     * @since   0.0.1
     * @access  public
     */
    public function __construct() {
        $this->api = new Client;
        $this->_cache = new \stdClass;
    }

    /**
     * Custom getter map to proxy between the API values.
     *
     * @since   0.0.1
     * @access  public
     */
    public function __get( $key ) {
        if ( property_exists( $this, $key ) )
            return $this->$key;

        if ( property_exists( $this->_cache, $key ) 
                && isset( $this->_cache->{ $key } ) 
                && !empty( $this->_cache->{ $key } ) 
                && !is_null( $this->_cache->{ $key } ) )
            return $this->_cache->$key;

        return null;
    }

}
