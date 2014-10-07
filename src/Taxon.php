<?php
/**
 * Taxon.
 *
 * @link       http://atmoapps.com
 * @since      0.0.1
 */

namespace myFOSSIL\PBDB;

use myFOSSIL\PBDB\API;

/**
 * Taxon.
 *
 * This class defines all code necessary to interface with the PBDB API for Taxa.
 *
 * @since      0.0.1
 * @author     Brandon Wood <bwood@atmoapps.com>
 */
class Taxon extends API\Object implements API\ObjectInterface
{
    /**
     * PBDB API endpoint for Taxa.
     *
     * @since   0.0.1
     * @access  protected
     */
    protected $endpoint = 'taxa';

    /**
     * Define the core functionality of the PBDB PBDB for Taxon
     *
     * @since   0.0.1
     * @access  public
     */
    public function __construct() {
        parent::__construct();
        $this->init();
    }

    /**
     * Custom getter map to proxy between the API values.
     *
     * @since   0.0.1
     * @access  public
     */
    public function __get( $key ) {
        if ( property_exists( $this, $key ) )
            return $this->$key;

        switch ( $key ) {
            case 'oid':
                return $this->api->properties->taxon_no->value;
                break;
            case 'name':
                return $this->api->properties->taxon_name->value;
                break;
            case 'common_name':
                return $this->api->properties->common_name->value;
                break;
            case 'parent':
                return self::factory( $this->api->properties->parent_no->value );
                break;
            case 'extant':
                return (bool) $this->api->properties->is_extant->value;
                break;
            case 'taxon':
                $_key = !isset( $_key ) ? 'taxon_no' : $_key;
            case 'kingdom':
                $_key = !isset( $_key ) ? 'kingdom_no' : $_key;
            case 'phylum':
                $_key = !isset( $_key ) ? 'phylum_no' : $_key;
            case 'class':
                $_key = !isset( $_key ) ? 'class_no' : $_key;
            case 'order':
                $_key = !isset( $_key ) ? 'order_no' : $_key;
            case 'family':
                $_key = !isset( $_key ) ? 'family_no' : $_key;
                return self::factory( $this->api->properties->$_key->value );
                break;
            default:
                throw new \DomainException( 'Invalid property.' );
        }

        return null;
    }

    /**
     * Initialize default Parameters for a Taxon.
     * 
     * @since   0.0.1
     * @access  private
     * @see     {@link http://www.paleobiodb.org/data1.1/taxa/single_doc.html}
     */
    private function apiInitParameters() {

        // {{{ List of Parameters for a Taxon
        $parameters = array( 
                array( 'name', null, true ),
                array( 'id', null, true ),
                array( 'show', null, false )
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
     * Initialize default Properties for a Taxon.
     * 
     * @since   0.0.1
     * @access  private
     * @see     {@link http://www.paleobiodb.org/data1.1/taxa/single_doc.html}
     * @see     \myFOSSIL\PBDB\Property
     */
    private function apiInitProperties() {

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
                array('class', 'cll', array( 'phylo', 'nav' ) ),
                array('order', 'odl', array( 'phylo', 'nav' ) ),
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
     */
    private function init() {
        $this->api->endpoint = $this->endpoint;
        return $this->apiInitParameters() && $this->apiInitProperties();
    }

    /**
     * Return the parent Taxon, if available.
     *
     * @since   0.0.1
     * @access  public
     * @return  Taxon   Parent Taxon.
     */
    public function parent() {
        if ( empty( $this->api->properties->parent_no ) )
            $this->api->load();
        return self::factory( $this->api->properties->parent_no->value );
    }

    /**
     * Retrieve Taxon by a given identifier in PBDB.
     *
     * @since   0.0.1
     * @access  public
     * @param   int     $id     ID of the given Taxon to load from PBDB.
     */
    public static function factory( $id ) {
        $taxon = new Taxon;
        $taxon->api->parameters->id->value = $id;
        $taxon->api->load();
        return $taxon;
    }

}
