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
class Object extends Client
{
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
        parent::__construct();
        $this->_cache = new \stdClass;
    }

    /**
     * Custom getter map to proxy between the API values.
     *
     * @since   0.0.1
     * @access  public
     */
    public function __get( $key ) {
        // See if we have a local property called this
        if ( property_exists( $this, $key ) )
            return $this->$key;

        // Try to pull it from the cache
        if ( property_exists( $this->_cache, $key ) 
                && isset( $this->_cache->{ $key } ) 
                && !empty( $this->_cache->{ $key } ) 
                && !is_null( $this->_cache->{ $key } ) )
            return $this->_cache->$key;

        // If not a local property, try loading from PBDB
        if ( is_null( $this->properties->{ $key } ) )
            $this->load( $this->properties->block( $key ) );

        // Return whatever we get
        return $this->properties->{ $key };

    }

    /**
     * Custom setter map to proxy between the API values.
     *
     * @since   0.0.1
     * @access  public
     */
    public function __set( $key, $value ) {
        if ( property_exists( $this, $key ) )
            return $this->$key = $value;

        switch ( $key ) {
            case 'pbdbid':
                $this->parameters->id = $value;
                break;
            default:
                throw new \DomainException( 'Invalid property ' . $key );
        }
    }
}
