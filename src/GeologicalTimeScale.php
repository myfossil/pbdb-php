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
     * Define the core functionality of the PBDB Client for
     * GeologicalTimeScale.
     *
     * @since   0.0.1
     * @access  public
     */
    public function __construct() {
        parent::__construct();
        $this->endpoint = 'scales';
        $this->init();
    }

    /**
     * Custom getter map to proxy between the API values.
     *
     * @since   0.0.1
     * @access  public
     */
    public function __get( $key ) {
        $p = parent::__get( $key );
        if ( !is_null( $p ) ) {
            return $p;
        }

        switch ( $key ) {
            case 'oid':
                return $this->scale_no->value;
                break;
            case 'name':
                return $this->scale_name->value;
                break;
            case 'level':
                return $this->level_name->value;
                break;
            case 'start':
            case 't0':
                return $this->early_age->value;
                break;
            case 'end':
            case 't1':
            case 'tf':
                return $this->late_age->value;
                break;
            default:
                throw new \DomainException( sprintf( 'Invalid property %s', $key ) );
        }

        return null;
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
    protected function pbdbInitParameters() {
        parent::pbdbInitParameters();

        // {{{ List of Parameters for a GeologicalTimeScale
        $parameters = array( 
                array( 'id', null, false ),
            );
        // }}}

        foreach ( $parameters as $pargs ) {
            $this->addParameter( 
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
    protected function pbdbInitProperties() {
        parent::pbdbInitProperties();

        // {{{ List of Properties for a GeologicalTimeScale
        /*
         * Each array item will serve as a set of arguments to a Property class,
         * supplying the bare essentials of what needs to be defined.
         *
         * PBDB vocab, compacted vocab, parent block (show block)
         */ 
        $properties = array(
                array('scale_no', 'oid', null), 
                array('record_type', 'typ', null), 
                array('scale_name', 'nam', null), 
                array('num_levels', 'nlv', null), 
                array('level_list', 'lvs', null), 
                array('level', 'lvl', null), 
                array('level_name', 'nam', null), 
                array('early_age', 'eag', null), 
                array('late_age', 'lag', null), 
                array('reference_no', 'rid', null), 
            );
        // }}}

        foreach ( $properties as $pargs ) {
            $this->addProperty( 
                    call_user_func_array( 'myFOSSIL\PBDB\API\Property::factory', $pargs )
                );
        }

        return true;
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
        $time_scale->parameters->id = $id;
        return $time_scale;
    }

}
