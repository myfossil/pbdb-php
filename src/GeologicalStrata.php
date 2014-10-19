<?php
/**
 * GeologicalStrata.
 *
 * @link       http://atmoapps.com
 * @since      0.0.2
 * @author Brandon Wood <bwood@atmoapps.com>
 * @package myFOSSIL
 */


namespace myFOSSIL\PBDB;

use myFOSSIL\PBDB\API;

/**
 * GeologicalStrata.
 *
 * This class defines all code necessary to interface with the PBDB API for
 * GeologicalStrata.
 *
 * @since      0.0.2
 * @author     Brandon Wood <bwood@atmoapps.com>
 */
class GeologicalStrata extends API\Object implements API\ObjectInterface
{

    /**
     * Define the core functionality of the PBDB PBDB for GeologicalStrata.
     *
     * @since   0.0.2
     * @access  public
     */
    public function __construct()
    {
        parent::__construct();
        $this->endpoint = 'strata';
        $this->init();
    }

    /**
     * Initialize default Parameters for a GeologicalStrata.
     *
     * @since   0.0.2
     * @access  protected
     * @see     {@link http://paleobiodb.org/data1.1/strata/list_doc.html}
     * @return unknown
     */
    protected function pbdbInitParameters()
    {
        parent::pbdbInitParameters();

        // {{{ List of Parameters for a GeologicalStrata
        $parameters = array(
            array( 'name', null, false ),
            array( 'rank', null, false ),
            array( 'lngmin', null, false ),
            array( 'lngmax', null, false ),
            array( 'latmin', null, false ),
            array( 'latmax', null, false ),
            array( 'loc', null, false )
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
     * Initialize default Properties for a GeologicalStrata.
     *
     * @since   0.0.2
     * @access  private
     * @see     {@link http://www.paleobiodb.org/data1.1/taxa/single_doc.html}
     * @see     \myFOSSIL\PBDB\Property
     * @return unknown
     */
    protected function pbdbInitProperties()
    {
        parent::pbdbInitProperties();

        // {{{ List of Properties for a GeologicalStrata
        /*
         * Each array item will serve as a set of arguments to a Property class,
         * supplying the bare essentials of what needs to be defined.
         *
         * PBDB vocab, compacted vocab, parent block (show block), value, description
         */
        $properties = array(
            array( 'record_type' , 'typ' , 'basic' ) ,
            array( 'name'        , 'nam' , 'basic' ) ,
            array( 'rank'        , 'rnk' , 'basic' ) ,
            array( 'n_colls'     , 'nco' , 'basic', null, "The number of
                    fossil collections in the database that are associated with
                    this stratum. Note that if your search is limited to a
                    particular geographic area, then only collections within
                    the selected area are counted." ) ,
            array( 'n_occs'      , 'noc' , 'basic', null, "The number of
                    fossil occurrences in the database that are associated with
                    this stratum. The above note about geographic area
                    selection also applies." ) ,
        );
        // }}}

        foreach ( $properties as $pargs ) {
            $this->addProperty(
                call_user_func_array( 'myFOSSIL\PBDB\API\Property::factory', $pargs )
            );
        }

        return true;
    }

}
