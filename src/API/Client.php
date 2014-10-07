<?php
/**
 * PBDB Client class.
 *
 * @link       http://atmoapps.com
 * @since      0.0.1
 */

namespace myFOSSIL\PBDB\API;

/**
 * PBDB Client class.
 *
 * @since      0.0.1
 * @author     Brandon Wood <bwood@atmoapps.com>
 */
class Client
{
    /**
     * The PBDB base URL for API requests.
     *
     * @since   0.0.1
     * @var     string      BASE_URL
     */
    const BASE_URL = 'http://paleobiodb.org/data1.1';

    /**
     * PBDB API endpoint.
     *
     * @since   0.0.1
     * @access  protected
     */
    public $endpoint;

    /**
     * The \GuzzleHttp\Client object used to make requests.
     *
     * @since   0.0.1
     * @access  protected
     * @var     \GuzzleHttp\Client   $_http   The \GuzzleHttp\Client instance to handle all API requests. 
     */
    protected $http;

    /**
     * ParameterSet instance containing Parameter objects.
     *
     * These parameters will be used when constructing a query.
     *
     * @since   0.0.1
     * @access  public
     * @see     {@link http://paleobiodb.org/data1.1/formats}
     * @var     ParameterSet    $parameters
     */
    public $parameters;

    /**
     * PropertySet instance containing Property objects.
     *
     * These properties will be returned from a query.
     *
     * @since   0.0.1
     * @access  public
     * @see     {@link http://paleobiodb.org/data1.1/formats}
     * @var     PropertySet     $properties
     */
    public $properties;


    /**
     * Define the core functionality of the PBDB Client base.
     *
     * @since   0.0.1
     * @access  public
     */
    public function __construct( $endpoint=null ) {
        $this->endpoint = $endpoint;
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
     * @param   Parameter   $param  PBDB Parameter to add to query set.
     */
    public function addParameter( $param ) {
        $this->parameters->attach( $param );
    }

    /**
     * Add a Property object to the properties list for this PBDB Client.
     *
     * @since   0.0.1
     * @access  public
     * @param   Property    $prop   PBDB Property of the given object.
     */
    public function addProperty( $prop ) {
        $this->properties->attach( $prop );
    }

    /**
     * Initialize default Parameters for a Taxon.
     *
     * This function is called at instantiation, and sets default parameters
     * against the PBDB API.
     * 
     * @since   0.0.1
     * @access  private
     */
    private function pbdbInitParameters() {
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
     * Because Base classes have no properties, this function simply returns
     * true.
     *
     * @since   0.0.1
     * @access  private
     */
    private function pbdbInitProperties() {
        return true;
    }

    /**
     * Initialize default Parameters and Properties.
     * 
     * @since   0.0.1
     * @access  private
     * @see     self::pbdbInitParameters
     * @see     self::pbdbInitProperties
     */
    private function init() {
        return $this->pbdbInitParameters() && $this->pbdbInitProperties();
    }

    /**
     * Retrieve response from PBDB with HTTP GET request.
     *
     * @since   0.0.1
     * @access  public
     * @param   string  $url    URL of the PBDB API endpoint to GET.
     * @throws  DomainException If $verb supplied is not supported.
     * @return  mixed           Parsed JSON response from the server.
     */
    public function request( $url ) {
        return $this->http->get( $url )->json();
    }

    /**
     * Load data from the PBDB.
     *
     * @since   0.0.1
     * @access  public
     * @param   string  $type       Optional    PBDB API endpoint type (default 'single').
     * @param   string  $format     Optional    PBDB API response format (default 'json').
     * @throws  RuntimeException                If attempted to be loaded without an identifier.
     * @return  mixed                           Class instantiation with associated properties.
     */
    public function load( $type='single', $format='json' ) {
        if ( empty( $this->parameters->id->value ) )
            throw new RuntimeException( "Cannot load without id" );

        $url = sprintf( '%s/%s/%s.%s?%s', self::BASE_URL, $this->endpoint,
                $type, $format, $this->parameters->render() );

        $this->properties->load( $this->request( $url ) );
        return $this;
    }

}
