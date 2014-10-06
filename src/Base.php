<?php
/**
 * PBDB API client
 *
 * @link       http://atmoapps.com
 * @since      0.0.1
 *
 * @package    myFOSSIL
 * @subpackage myFOSSIL/PBDB
 */
namespace myFOSSIL\PBDB;

/**
 * PBDB API client.
 *
 * This class defines all code necessary to interface with the PBDB API.
 *
 * @since      0.0.1
 * @package    myFOSSIL
 * @subpackage myFOSSIL/PBDB
 * @author     Brandon Wood <bwood@atmoapps.com>
 */
class Base
{
    /**
     * The PBDB base URL for API requests.
     *
     * @since   0.0.1
     * @var     string      BASE_URL
     */
    const BASE_URL = 'http://paleobiodb.org/data1.1';

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
    public $parameters;

    /**
     * SplObjectStorage instance containing PBDB_Property's.

     * These properties will be returned from a query.
     *
     * @since   0.0.1
     * @access  protected
     * @see     {@link http://paleobiodb.org/data1.1/formats}
     * @var     SplObjectStorage    $properties
     */
    public $properties;


    /**
     * Define the core functionality of the PBDB Client base.
     *
     * @since 0.0.1
     */
    public function __construct() {
        $this->http = new \GuzzleHttp\Client( ['base_url' => self::BASE_URL] );
        $this->parameters = new ParameterSet();
        $this->properties = new PropertySet();
        $this->init();
    }

    /**
     * Add a Parameter object to the parameters list for this PBDB Client.
     *
     * @since   0.0.1
     * @access  public
     * @var     myFOSSIL\PBDB\Parameter
     */
    public function addParameter( Parameter $param ) {
        $this->parameters->attach( $param );
    }

    /**
     * Add a Property object to the properties list for this PBDB Client.
     *
     * @since   0.0.1
     * @access  public
     * @var     myFOSSIL\PBDB\Property  $prop   The \myFOSSIl\PBDB\Property to add.
     */
    public function addProperty( Property $prop ) {
        $this->properties->attach( $prop );
    }

    /**
     * Initialize default Parameters for a Taxon.
     * 
     * @since   0.0.1
     */
    private function initParameters() {
        // PBDB API default vocabulary.
        $this->parameters->attach( new Parameter( 'vocab', 'pbdb' ) );

        // PBDB API default line endings.
        $this->parameters->attach( new Parameter( 'linebreak', null ) );

        // PBDB API default limit of the number of results.
        $this->parameters->attach( new Parameter( 'limit', null ) );

        // PBDB API default for whether to return only the count.
        $this->parameters->attach( new Parameter( 'count', null ) );

        // PBDB API default for whether to set the content type to
        // 'text/plain'.
        $this->parameters->attach( new Parameter( 'textresult', null ) );

        // PBDB API default for whether to markup references with <b> and <i>
        // tags.
        $this->parameters->attach( new Parameter( 'markrefs', null ) );

        // PBDB API default for whether include source information in the
        // response header.
        $this->parameters->attach( new Parameter( 'showsource', null ) );

        // PBDB API default for whether return the header field with field
        // names.
        $this->parameters->attach( new Parameter( 'noheader', null ) );

        return true;
    }

    /**
     * Initialize default Properties for a Taxon.
     * 
     * @since   0.0.1
     * @access  private
     */
    private function initProperties() {
        return true;
    }

    /**
     * Initialize default Parameters and Properties.
     * 
     * @since   0.0.1
     * @access  private
     * @see     initParameters
     * @see     initProperties
     */
    private function init() {
        return $this->initParameters() && $this->initProperties();
    }

    /**
     * Retrieve response from PBDB with HTTP GET request.
     *
     * @since   0.0.1
     * @access  public
     * @var     string  $url
     * @var     bool    $json   Optional Whether the response should be returned as JSON decoded data. Default true.
     * @throws  DomainException If $verb supplied is not supported.
     * @return  string  String response from the server.
     */
    public function request( $url, $json=true ) {
        return $this->http->get( $url )->json();
    }
}
