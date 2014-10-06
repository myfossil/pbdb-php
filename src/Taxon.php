<?php
/**
 * Taxon.
 *
 * @link       http://atmoapps.com
 * @since      0.0.1
 *
 * @package    myFOSSIL_PBDB
 * @subpackage myFOSSIL_PBDB/includes/pbdb
 */
namespace myFOSSIL\PBDB;

/**
 * Taxon.
 *
 * This class defines all code necessary to interface with the PBDB API for Taxa.
 *
 * @since      0.0.1
 * @package    myFOSSIL_PBDB
 * @subpackage myFOSSIL_PBDB/includes/pbdb
 * @author     Brandon Wood <bwood@atmoapps.com>
 */
class Taxon extends Base
{
    /**
     * PBDB API url for Taxa.
     *
     * @since 0.0.1
     */
    protected $api_endpoint = 'taxa';

    /**
     * Define the core functionality of the PBDB Client for Taxon
     *
     * @since 0.0.1
     */
    public function __construct() {
        parent::__construct();
        $this->init();
    }

    /**
     * Initialize default Parameters for a Taxon.
     * 
     * @since   0.0.1
     * @access  private
     * @see     {@link http://www.paleobiodb.org/data1.1/taxa/single_doc.html}
     */
    private function initParameters() {
        // Reset all Parameters.
        $this->parameters->removeAllExcept( new \SplObjectStorage() );

        // {{{ List of Parameters for a Taxon
        $parameters = array( 
                array( 'name', null, true ),
                array( 'id', null, true ),
                array( 'show', null, false )
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
     * Initialize default Properties for a Taxon.
     * 
     * @since   0.0.1
     * @access  private
     * @see     {@link http://www.paleobiodb.org/data1.1/taxa/single_doc.html}
     * @see     \myFOSSIL\PBDB\Property
     */
    private function initProperties() {
        // Reset all Properties.
        $this->properties->removeAllExcept( new \SplObjectStorage() );

        // {{{ List of Properties for a Taxon
        /*
         * Each array item will serve as a set of arguments to a Property class,
         * supplying the bare essentials of what needs to be defined.
         *
         * PBDB vocab, compacted vocab, parent block (show block)
         */ 
        $properties = array(
                array('taxon_no', 'oid', 'basic'), 
                array('orig_no', 'gid', 'basic'), 
                array('record_type', 'typ', 'basic'), 
                array('rank', 'rnk', 'basic'), 
                array('taxon_name', 'nam', 'basic'), 
                array('common_name', 'nm2', 'basic'), 
                array('attribution', 'att', 'attr'), 
                array('pubyr', 'pby', 'attr'), 
                array('status', 'sta', 'basic'), 
                array('parent_no', 'par', 'basic'), 
                array('senior_no', 'snr', 'basic'), 
                array('reference_no', 'rid', 'basic'), 
                array('is_extant', 'ext', 'basic'), 
                array('firstapp_ea', 'fea', 'app'), 
                array('firstapp_la', 'fla', 'app'), 
                array('lastapp_ea', 'lea', 'app'), 
                array('lastapp_la', 'lla', 'app'), 
                array('size', 'siz', 'size'), 
                array('extant_size', 'exs', 'size'), 
                array('kingdom', 'kgl', 'phylo'), 
                array('phylum', 'phl', 'phylo'), 
                array('class', 'cll', 'phylo'), 
                array('order', 'odl', 'phylo'), 
                array('family', 'fml', 'phylo'), 
                array('parent_name', 'prl', 'nav'), 
                array('parent_rank', 'prr', 'nav'), 
                array('parent_txn', 'prt', 'nav'), 
                array('kingdom_no', 'kgn', 'nav'), 
                array('kingdom', 'kgl', 'nav'), 
                array('kingdom_txn', 'kgt', 'nav'), 
                array('phylum_no', 'phn', 'nav'), 
                array('phylum', 'phl', 'nav'), 
                array('phylum_txn', 'pht', 'nav'), 
                array('phylum_count', 'phc', 'nav'), 
                array('class_no', 'cln', 'nav'), 
                array('class', 'cll', 'nav'), 
                array('class_txn', 'clt', 'nav'), 
                array('class_count', 'clc', 'nav'), 
                array('order_no', 'odl', 'nav'), 
                array('order', 'odn', 'nav'), 
                array('order_txn', 'odt', 'nav'), 
                array('order_count', 'odc', 'nav'), 
                array('family_no', 'fmn', 'nav'), 
                array('family', 'fml', 'nav'), 
                array('family_txn', 'fmt', 'nav'), 
                array('family_count', 'fmc', 'nav'), 
                array('genus_count', 'gnc', 'nav'), 
                array('children', 'chl', 'nav'), 
                array('phylum_list', 'phs', 'nav'), 
                array('class_list', 'cls', 'nav'), 
                array('order_list', 'ods', 'nav'), 
                array('family_list', 'fms', 'nav'), 
                array('genus_list', 'gns', 'nav'), 
                array('subgenus_list', 'sgs', 'nav'), 
                array('species_list', 'sps', 'nav'), 
                array('subspecies_list', 'sss', 'nav'), 
                array('image_no', 'img', 'img'), 
                array('authorizer_no', 'ati', 'entname'), 
                array('enterer_no', 'eni', 'entname'), 
                array('modifier_no', 'mdi', 'entname'), 
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
    public function init() {
        return $this->initParameters() && $this->initProperties();
    }
}
