<?php
/**
 * PBDB Property.
 *
 * @link       http://atmoapps.com
 * @since      0.0.1
 *
 * @package    myFOSSIL_PBDB
 * @subpackage myFOSSIL_PBDB/includes/pbdb
 */
namespace myFOSSIL\PBDB;

/**
 * PBDB Property.
 *
 * This class defines all information relating to a property of a PBDB object.
 *
 * @since      0.0.1
 * @package    myFOSSIL_PBDB
 * @subpackage myFOSSIL_PBDB/includes/pbdb
 * @author     Brandon Wood <bwood@atmoapps.com>
 */
class Property
{
    /**
     * Name of the Property for the 'pbdb' vocabulary.
     *
     * @since   0.0.1
     * @access  protected
     * @see     {@link http://paleobiodb.org/data1.1/formats}
     * @var     string      $pbdb;
     */
    protected $pbdb;

    /**
     * Name of the Property for the 'com' vocabulary.
     *
     * @since   0.0.1
     * @access  protected
     * @see     {@link http://paleobiodb.org/data1.1/formats}
     * @var     string      $compacted
     */
    protected $compacted;

    /**
     * Name of the parent Property block used in queries.
     *
     * @since   0.0.1
     * @access  protected
     * @var     string      $block
     */
    protected $block;

    /**
     * Name of the Property for the 'dwc' vocabulary.
     *
     * @since   0.0.1
     * @access  protected
     * @see     {@link http://paleobiodb.org/data1.1/formats}
     * @var     string      $darwin_core;
     */
    protected $darwin_core;

    /**
     * Description of the Property.
     *
     * @since   0.0.1
     * @access  protected
     * @var     string      $description
     */
    protected $description;

    /**
     * Construct Property object.
     *
     * @since   0.0.1
     * @access  public
     * @var     string  $pbdb                       PBDB vocab of the property.
     * @var     string  $compacted                  Compacted vocab of the property.
     * @var     string  $block                      Parent block of property in API response.
     * @var     string  $darwin_core    Optional    Darwin Core version of the property.
     * @var     string  $description    Optional    Description of the property.
     * @see     {@link http://paleobiodb.org/data1.1} 
     */
    public function __construct($pbdb, $compacted, $block, $description=null, $darwin_core=null) {
        $this->pbdb = $pbdb;
        $this->compacted = $compacted;
        $this->block = $block;
        $this->darwin_core = $darwin_core;
        $this->description = $description;
    }

    /**
     * Create a new Property object.
     *
     * @since   0.0.1
     * @var     string  $pbdb
     * @var     string  $compacted
     * @var     string  $block
     */
    public static function factory( $pbdb, $compacted, $block ) {
        return new Property( $pbdb, $compacted, $block );
    }
}
