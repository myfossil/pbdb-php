<?php
/**
 * GeologicalTimeInterval.
 *
 * @link       http://atmoapps.com
 * @since      0.0.1
 *
 * @package    myFOSSIL
 * @subpackage myFOSSIL/PBDB
 */
namespace myFOSSIL\PBDB;

/**
 * GeologicalTimeInterval.
 *
 * This class defines all code necessary to interface with the PBDB API for Taxa.
 *
 * @since      0.0.1
 * @package    myFOSSIL
 * @subpackage myFOSSIL/PBDB
 * @author     Brandon Wood <bwood@atmoapps.com>
 */
class GeologicalTimeInterval extends Base implements BaseInterface
{
    /**
     * PBDB API url for Taxa.
     *
     * @since 0.0.1
     */
    protected $endpoint = 'intervals';

    /**
     * Define the core functionality of the PBDB Client for GeologicalTimeInterval
     *
     * @since 0.0.1
     */
    public function __construct() {
        parent::__construct();
        $this->init();
    }

    /**
     * Initialize default Parameters for a GeologicalTimeInterval.
     * 
     * @since   0.0.1
     * @access  private
     * @see     {@link http://www.paleobiodb.org/data1.1/taxa/single_doc.html}
     */
    private function initParameters() {

        // {{{ List of Parameters for a GeologicalTimeInterval
        $parameters = array( 
                array( 'id', null, false ),
            );
        // }}}

        foreach ( $parameters as $pargs ) {
            $this->addParameter( 
                    call_user_func_array( __NAMESPACE__ . '\Parameter::factory', $pargs )
                );
        }

        return true;
    }

    /**
     * Initialize default Properties for a GeologicalTimeInterval.
     * 
     * @since   0.0.1
     * @access  private
     * @see     {@link http://www.paleobiodb.org/data1.1/taxa/single_doc.html}
     * @see     \myFOSSIL\PBDB\Property
     */
    private function initProperties() {

        // {{{ List of Properties for a GeologicalTimeInterval
        /*
         * Each array item will serve as a set of arguments to a Property class,
         * supplying the bare essentials of what needs to be defined.
         *
         * PBDB vocab, compacted vocab, parent block (show block)
         */ 
        $properties = array(
                array('interval_no', 'oid', 'basic'), 
                array('record_type', 'typ', 'basic'), 
                array('scale_no', 'sca', 'basic'), 
                array('level', 'lvl', 'basic'), 
                array('interval_name', 'nam', 'basic'), 
                array('abbrev', 'abr', 'basic'), 
                array('parent_no', 'pid', 'basic'), 
                array('color', 'col', 'basic'), 
                array('late_age', 'lag', 'basic'), 
                array('early_age', 'eag', 'basic'), 
                array('reference_no', 'rid', 'basic'), 
            );
        // }}}

        foreach ( $properties as $pargs ) {
            $this->addProperty( 
                    call_user_func_array( __NAMESPACE__ . '\Property::factory', $pargs )
                );
        }

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
     * Retrieve GeologicalTimeInterval by a given identifier in PBDB.
     *
     * @since   0.0.1
     */
    public static function factory( $id ) {
        $time_interval = new GeologicalTimeInterval;
        $time_interval->parameters->id->value = $id;
        $time_interval->load();
        return $time_interval;
    }

}
