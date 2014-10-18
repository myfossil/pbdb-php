<?php
/**
 * GeologicalTimeInterval.
 *
 * @link       http://atmoapps.com
 * @since      0.0.1
 */

namespace myFOSSIL\PBDB;

use myFOSSIL\PBDB\API;

/**
 * GeologicalTimeInterval.
 *
 * This class defines all code necessary to interface with the PBDB API for Taxa.
 *
 * @since      0.0.1
 * @author     Brandon Wood <bwood@atmoapps.com>
 */
class GeologicalTimeInterval extends API\Object implements API\ObjectInterface
{

    /**
     * Define the core functionality of the PBDB Client for GeologicalTimeInterval
     *
     * @since   0.0.1
     * @access  public
     */
    public function __construct() {
        parent::__construct();
        $this->endpoint = 'intervals';
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
            case 'pbdbid':
                return $this->interval_no;
                break;
            case 'name':
                return $this->interval_name;
                break;
            case 'abbreviation':
                return $this->abbrev;
                break;
            case 'parent':
                $this->_cache->{ $key } = self::factory( $this->parent_no );
                return $this->_cache->{ $key };
                break;
            case 'color':
                return $this->color;
                break;
            case 'scale':
                $this->_cache->{ $key } = GeologicalTimeScale::factory( $this->scale_no );
                return $this->_cache->{ $key };
                break;
            case 'start':
            case 't0':
                return $this->early_age;
                break;
            case 'end':
            case 't1':
            case 'tf':
                return $this->late_age;
                break;
            default:
                throw new \DomainException( sprintf( 'Invalid property %s', $key ) );
        }

        return null;
    }

    /**
     * Initialize default Parameters for a GeologicalTimeInterval.
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

        // {{{ List of Parameters for a GeologicalTimeInterval
        $parameters = array( 
                array( 'id', null, false ),
            );
        // }}}

        foreach ( $parameters as $pargs ) {
            $this->addParameter( 
                    call_user_func_array( 'myfossil\PBDB\API\Parameter::factory', $pargs )
                );
        }

        return true;
    }

    /**
     * Initialize default Properties for a GeologicalTimeInterval.
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

        // {{{ List of Properties for a GeologicalTimeInterval
        /*
         * Each array item will serve as a set of arguments to a Property class,
         * supplying the bare essentials of what needs to be defined.
         *
         * PBDB vocab, compacted vocab, parent block (show block)
         */ 
        $properties = array(
                array('interval_no', 'oid', null), 
                array('record_type', 'typ', null), 
                array('scale_no', 'sca', null), 
                array('level', 'lvl', null), 
                array('interval_name', 'nam', null), 
                array('abbrev', 'abr', null), 
                array('parent_no', 'pid', null), 
                array('color', 'col', null), 
                array('late_age', 'lag', null), 
                array('early_age', 'eag', null), 
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
     * Retrieve GeologicalTimeInterval by a given identifier in PBDB.
     *
     * @since   0.0.1
     * @access  public
     * @param   int     $id     Identifier of the given GeologicalTimeInterval in PBDB.
     */
    public static function factory( $id ) {
        $time_interval = new GeologicalTimeInterval;
        $time_interval->parameters->id = $id;
        return $time_interval;
    }

}
