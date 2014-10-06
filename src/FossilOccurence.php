<?php
/**
 * FossilOccurence.
 *
 * @link       http://atmoapps.com
 * @since      0.0.1
 *
 * @package    myFOSSIL
 * @subpackage myFOSSIL/PBDB
 */
namespace myFOSSIL\PBDB;

/**
 * FossilOccurence.
 *
 * This class defines all code necessary to interface with the PBDB API for Taxa.
 *
 * @since      0.0.1
 * @package    myFOSSIL
 * @subpackage myFOSSIL/PBDB
 * @author     Brandon Wood <bwood@atmoapps.com>
 */
class FossilOccurence extends Base implements BaseInterface
{
    /**
     * PBDB API url for Taxa.
     *
     * @since 0.0.1
     */
    protected $endpoint = 'occs';

    /**
     * Define the core functionality of the PBDB Client for FossilOccurence
     *
     * @since 0.0.1
     */
    public function __construct() {
        parent::__construct();
        $this->init();
    }

    /**
     * Initialize default Parameters for a FossilOccurence.
     * 
     * @since   0.0.1
     * @access  private
     * @see     {@link http://www.paleobiodb.org/data1.1/taxa/single_doc.html}
     */
    private function initParameters() {

        // {{{ List of Parameters for a FossilOccurence
        $parameters = array( 
                array( 'id', null, true ),
                array( 'show', null, false ),
                array( 'order', null, false )
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
     * Initialize default Properties for a FossilOccurence.
     * 
     * @since   0.0.1
     * @access  private
     * @see     {@link http://www.paleobiodb.org/data1.1/taxa/single_doc.html}
     * @see     \myFOSSIL\PBDB\Property
     */
    private function initProperties() {

        // {{{ List of Properties for a FossilOccurence
        /*
         * Each array item will serve as a set of arguments to a Property class,
         * supplying the bare essentials of what needs to be defined.
         *
         * PBDB vocab, compacted vocab, parent block (show block)
         */ 
        $properties = array(
                array('occurrence_no', 'oid', 'basic'), 
                array('record_type', 'typ', 'basic'), 
                array('reid_no', 'eid', 'basic'), 
                array('superceded', 'sps', 'basic'), 
                array('collection_no', 'cid', 'basic'), 
                array('taxon_name', 'tna', 'basic'), 
                array('taxon_rank', 'rnk', 'basic'), 
                array('taxon_no', 'tid', 'basic'), 
                array('matched_name', 'mna', 'basic'), 
                array('matched_rank', 'mra', 'basic'), 
                array('matched_no', 'mid', 'basic'), 
                array('early_interval', 'oei', 'basic'), 
                array('late_interval', 'oli', 'basic'), 
                array('early_age', 'eag', 'basic'), 
                array('late_age', 'lag', 'basic'), 
                array('reference_no', 'rid', 'basic'), 
                array('lng', 'lng', 'coords'), 
                array('lat', 'lat', 'coords'), 
                array('genus_name', 'idt', 'ident'), 
                array('genus_reso', 'rst', 'ident'), 
                array('subgenus_name', 'idf', 'ident'), 
                array('subgenus_reso', 'rsf', 'ident'), 
                array('species_name', 'ids', 'ident'), 
                array('species_reso', 'rss', 'ident'), 
                array('family', 'fml', 'phylo'), 
                array('family_no', 'fmn', 'phylo'), 
                array('order', 'odn', 'phylo'), 
                array('order_no', 'odl', 'phylo'), 
                array('class', 'cll', 'phylo'), 
                array('class_no', 'cln', 'phylo'), 
                array('phylum', 'phl', 'phylo'), 
                array('phylum_no', 'phn', 'phylo'), 
                array('cc', 'cc2', 'loc'), 
                array('state', 'sta', 'loc'), 
                array('county', 'cny', 'loc'), 
                array('geogscale', 'gsc', 'loc'), 
                array('paleomodel', 'pm1', 'paleoloc'), 
                array('paleolng', 'pln', 'paleoloc'), 
                array('paleolat', 'pla', 'paleoloc'), 
                array('geoplate', 'gpl', 'paleoloc'), 
                array('paleomodel2', 'pm2', 'paleoloc'), 
                array('paleolng2', 'pn2', 'paleoloc'), 
                array('paleolat2', 'pa2', 'paleoloc'), 
                array('geoplate2', 'gp2', 'paleoloc'), 
                array('cc', 'cc2', 'prot'), 
                array('protected', 'ptd', 'prot'), 
                array('early_age', 'eag', 'time'), 
                array('late_age', 'lag', 'time'), 
                array('cx_int_no', 'cxi', 'time'), 
                array('early_int_no', 'ein', 'time'), 
                array('late_int_no', 'lin', 'time'), 
                array('formation', 'sfm', 'strat'), 
                array('stratgroup', 'sgr', 'strat'), 
                array('member', 'smb', 'strat'), 
                array('stratscale', 'ssc', 'stratext'), 
                array('zone', 'szn', 'stratext'), 
                array('localsection', 'sls', 'stratext'), 
                array('localbed', 'slb', 'stratext'), 
                array('localorder', 'slo', 'stratext'), 
                array('regionalsection', 'srs', 'stratext'), 
                array('regionalbed', 'srb', 'stratext'), 
                array('regionalorder', 'sro', 'stratext'), 
                array('stratcomments', 'scm', 'stratext'), 
                array('lithdescript', 'ldc', 'lith'), 
                array('lithology1', 'lt1', 'lith'), 
                array('lithadj1', 'la1', 'lithext'), 
                array('lithification1', 'lf1', 'lith'), 
                array('minor_lithology1', 'lm1', 'lith'), 
                array('fossilsfrom1', 'ff1', 'lithext'), 
                array('lithology2', 'lt2', 'lith'), 
                array('lithadj2', 'la2', 'lithext'), 
                array('lithification2', 'lf2', 'lith'), 
                array('minor_lithology2', 'lm2', 'lith'), 
                array('fossilsfrom2', 'ff2', 'lithext'), 
                array('environment', 'env', 'geo'), 
                array('tectonic_setting', 'tec', 'geo'), 
                array('geology_comments', 'gcm', 'geo'), 
                array('collection_aka', 'crm', 'rem'), 
                array('primary_reference', 'ref', 'ref'), 
                array('authorizer_no', 'ati', 'ent, entname'), 
                array('enterer_no', 'eni', 'ent, entname'), 
                array('modifier_no', 'mdi', 'ent, entname'), 
                array('authorizer', 'ath', 'entname'), 
                array('enterer', 'ent', 'entname'), 
                array('modifier', 'mdf', 'entname'), 
                array('created', 'dcr', 'crmod'), 
                array('modified', 'dmd', 'crmod')
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
     * Retrieve FossilOccurence by a given identifier in PBDB.
     *
     * @since   0.0.1
     */
    public static function factory( $id ) {
        $fossil = new FossilOccurence;
        $fossil->parameters->id->value = $id;
        $fossil->load();
        return $fossil;
    }

}
