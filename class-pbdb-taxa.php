<?php
/**
 * PBDB API client for Taxa
 *
 * @link       http://atmoapps.com
 * @since      0.0.1
 *
 * @package    myFOSSIL_PBDB
 * @subpackage myFOSSIL_PBDB/includes/pbdb
 */
namespace myFOSSIL\PBDB\Client;

/**
 * PBDB API client for Taxa.
 *
 * This class defines all code necessary to interface with the PBDB API for Taxa.
 *
 * @since      0.0.1
 * @package    myFOSSIL_PBDB
 * @subpackage myFOSSIL_PBDB/includes/pbdb
 * @author     Brandon Wood <bwood@atmoapps.com>
 */
class PBDB_Taxa extends PBDB_Client_Base 
{
    /**
     * PBDB API url for Taxa.
     *
     * @since 0.0.1
     */
    const API_ENDPOINT = "taxa"; 

    /**
     * Define the core functionality of the PBDB Client for Taxa.
     *
     * @since 0.0.1
     */
    public function __construct() {
        parent::__construct();
    }
}
