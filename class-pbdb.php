<?php
/**
 * PBDB API client
 *
 * @link       http://atmoapps.com
 * @since      0.0.1
 *
 * @package    myFOSSIL_PBDB
 * @subpackage myFOSSIL_PBDB/includes/pbdb
 */
namespace myFOSSIL\PBDB;

/**
 * PBDB API client.
 *
 * This class defines all code necessary to interface with the PBDB API.
 *
 * @since      0.0.1
 * @package    myFOSSIL_PBDB
 * @subpackage myFOSSIL_PBDB/includes/pbdb
 * @author     Brandon Wood <bwood@atmoapps.com>
 */
class PBDB_Client_Base 
{
    /**
     * The PBDB base URL for API requests.
     *
     * @since   0.0.1
     * @var     string      BASE_URL
     */
    const BASE_URL = 'http://paleobiodb.org/data1.1';

    /**
     * The PBDB API response format requested.
     *
     * @since   0.0.1
     * @var     string      RESPONSE_FORMAT
     */
    const RESPONSE_FORMAT = 'json';

    /**
     * The PBDB API default vocabulary.
     *
     * @since   0.0.1
     * @var     string      VOCABULARY
     * @see     {@link http://paleobiodb.org/data1.1/formats}
     */
    const VOCABULARY = 'com';

    /**
     * The PBDB API default line endings.
     *
     * @since   0.0.1
     * @var     string      LINE_BREAK
     * @see     {@link http://paleobiodb.org/data1.1/common_doc.html}
     */
    const LINE_BREAK = 'crlf';

    /**
     * The PBDB API default limit of the number of results.
     *
     * @since   0.0.1
     * @var     mixed   RESULTS_LIMIT
     * @see     {@link http://paleobiodb.org/data1.1/common_doc.html}
     */
    const RESULTS_LIMIT = 500;

    /**
     * The PBDB API default for whether to return only the count.
     *
     * @since   0.0.1
     * @var     bool    SHOW_COUNT
     * @see     {@link http://paleobiodb.org/data1.1/common_doc.html}
     */
    const SHOW_COUNT = false;

    /**
     * The PBDB API default for whether to set the content type to 'text/plain'.
     *
     * @since   0.0.1
     * @var     bool    TEXT_RESULT
     * @see     {@link http://paleobiodb.org/data1.1/common_doc.html}
     */
    const TEXT_RESULT = false;

    /**
     * The PBDB API default for whether to markup references with <b> and <i> tags.
     *
     * @since   0.0.1
     * @var     bool    MARK_REFERENCES
     * @see     {@link http://paleobiodb.org/data1.1/common_doc.html}
     */
    const MARK_REFERENCES = false;

    /**
     * The PBDB API default for whether include source information in the response header.
     *
     * @since   0.0.1
     * @var     bool    HEADER_SOURCES
     * @see     {@link http://paleobiodb.org/data1.1/common_doc.html}
     */
    const HEADER_SOURCES = false;

    /**
     * The PBDB API default for whether return the header field with field names.
     *
     * @since   0.0.1
     * @var     bool    HEADER_FIELDNAMES
     * @see     {@link http://paleobiodb.org/data1.1/common_doc.html}
     */
    const HEADER_FIELDNAMES = true;

    /**
     * The GuzzleHttp\Client object used to make requests.
     *
     * @since   0.0.1
     * @access  protected
     * @var     GuzzleHttp\Client   $_http   The GuzzleHttp\Client instance to handle all API requests. 
     */
    protected $http;

    /**
     * SplObjectStorage instance containing PBDB_Parameter's.
     *
     * These parameters will be used when constructing a query.
     *
     * @since   0.0.1
     * @access  protected
     * @see     {@link http://paleobiodb.org/data1.1/formats}
     * @var     SplObjectStorage    $parameters
     */
    protected $parameters;

    /**
     * SplObjectStorage instance containing PBDB_Property's.

     * These properties will be returned from a query.
     *
     * @since   0.0.1
     * @access  protected
     * @see     {@link http://paleobiodb.org/data1.1/formats}
     * @var     SplObjectStorage    $properties
     */
    protected $properties;


    /**
     * Define the core functionality of the PBDB Client base.
     *
     * @since 0.0.1
     */
    public function __construct() {
        $this->_check_config();
        $this->http = new GuzzleHttp\Client( ['base_url' => self::BASE_URL] );
    }

    /**
     * Check that this class instance is configured correctly.
     *
     * @throws  DomainException
     */
    protected function _check_config() {
        if ( self::RESPONSE_FORMAT !== "json" ) {
            throw new DomainException("Currently only the JSON response format is supported.");
            return false;
        }

        if ( self::VOCABULARY !== "com" ) {
            throw new DomainException("Currently only the compact vocabulary is supported.");
            return false;
        }

        return true;
    }
}
