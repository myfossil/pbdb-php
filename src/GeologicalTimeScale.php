<?php
/**
 * GeologicalTimeScale.
 *
 * @link       http://atmoapps.com
 * @since      0.0.1
 */

namespace myFOSSIL\PBDB;

use myFOSSIL\PBDB\API;

/**
 * GeologicalTimeScale.
 *
 * This class defines all code necessary to interface with the PBDB API for
 * geological time scales.
 *
 * @since      0.0.1
 * @author     Brandon Wood <bwood@atmoapps.com>
 */
class GeologicalTimeScale extends API\Object implements API\ObjectInterface
{
    /**
     * PBDB API endpoint for geological time scales.
     *
     * @since   0.0.1
     * @access  protected
     * @var     string      $endpoint   PBDB API endpoint for GeologicalTimeScales.
     */
    protected $endpoint = 'scales';

    /**
     * Define the core functionality of the PBDB Client for
     * GeologicalTimeScale.
     *
     * @since   0.0.1
     * @access  public
     */
    public function __construct() {
        parent::__construct();
        $this->init();
    }

    /**
     * Initialize default Parameters for a GeologicalTimeScale.
     * 
     * @since   0.0.1
     * @access  private
     * @return  bool        Returns true upon success, false upon failure.
     * @see     {@link http://www.paleobiodb.org/data1.1/taxa/single_doc.html}
     * @see     \myFOSSIL\PBDB\Parameter
     * @see     \myFOSSIL\PBDB\ParameterSet
     */
    private function apiInitParameters() {

        // {{{ List of Parameters for a GeologicalTimeScale
        $parameters = array( 
                array( 'id', null, false ),
            );
        // }}}

        foreach ( $parameters as $pargs ) {
            $this->api->addParameter( 
                    call_user_func_array( 'myFOSSIL\PBDB\API\Parameter::factory', $pargs )
                );
        }

        return true;
    }

    /**
     * Initialize default Properties for a GeologicalTimeScale.
     * 
     * @since   0.0.1
     * @access  private
     * @return  bool        Returns true upon success, false upon failure.
     * @see     {@link http://www.paleobiodb.org/data1.1/taxa/single_doc.html}
     * @see     \myFOSSIL\PBDB\Property
     * @see     \myFOSSIL\PBDB\PropertySet
     */
    private function apiInitProperties() {

        // {{{ List of Properties for a GeologicalTimeScale
        /*
         * Each array item will serve as a set of arguments to a Property class,
         * supplying the bare essentials of what needs to be defined.
         *
         * PBDB vocab, compacted vocab, parent block (show block)
         */ 
        $properties = array(
                array('scale_no', 'oid', 'basic'), 
                array('record_type', 'typ', 'basic'), 
                array('scale_name', 'nam', 'basic'), 
                array('num_levels', 'nlv', 'basic'), 
                array('level_list', 'lvs', 'basic'), 
                array('level', 'lvl', 'basic'), 
                array('level_name', 'nam', 'basic'), 
                array('early_age', 'eag', 'basic'), 
                array('late_age', 'lag', 'basic'), 
                array('reference_no', 'rid', 'basic'), 
            );
        // }}}

        foreach ( $properties as $pargs ) {
            $this->api->addProperty( 
                    call_user_func_array( 'myFOSSIL\PBDB\API\Property::factory', $pargs )
                );
        }

        return true;
    }

    /**
     * Initialize default Parameters and Properties.
     * 
     * @since   0.0.1
     * @access  private
     * @return  bool        Returns true upon success, false upon failure.
     */
    private function init() {
        $this->api->endpoint = $this->endpoint;
        return $this->apiInitParameters() && $this->apiInitProperties();
    }

    /**
     * Retrieve GeologicalTimeScale by a given identifier in PBDB.
     *
     * @since   0.0.1
     * @access  public
     * @param   int         $id         ID of the PBDB time scale.
     * @return  GeologicalTimeScale     Returns GeologicalTimeScale object with given properties from PBDB.
     */
    public static function factory( $id ) {
        $time_scale = new GeologicalTimeScale;
        $time_scale->api->parameters->id->value = $id;
        $time_scale->api->load();
        return $time_scale;
    }

}
