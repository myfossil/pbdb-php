<?php
/**
 * PBDB Property.
 *
 * @link       http://atmoapps.com
 * @since      0.0.1
 */

namespace myFOSSIL\PBDB\API;

/**
 * PBDB Property.
 *
 * This class defines all information relating to a property of a PBDB object.
 *
 * @since      0.0.1
 * @author     Brandon Wood <bwood@atmoapps.com>
 */
class Property
{
    /**
     * Name of the Property for the 'pbdb' vocabulary.
     *
     * @since   0.0.1
     * @access  public
     * @see     {@link http://paleobiodb.org/data1.1/formats}
     * @var     string      $pbdb;
     */
    public $pbdb;

    /**
     * Name of the Property for the 'com' vocabulary.
     *
     * @since   0.0.1
     * @access  public 
     * @see     {@link http://paleobiodb.org/data1.1/formats}
     * @var     string      $compacted
     */
    public $compacted;

    /**
     * Name of the parent Property block used in queries.
     *
     * @since   0.0.1
     * @access  public 
     * @var     array   $block
     */
    public $block;

    /**
     * Name of the Property for the 'dwc' vocabulary.
     *
     * @since   0.0.1
     * @access  public 
     * @see     {@link http://paleobiodb.org/data1.1/formats}
     * @var     string      $darwin_core;
     */
    public $darwin_core;

    /**
     * Description of the Property.
     *
     * @since   0.0.1
     * @access  public
     * @var     string      $description
     */
    public $description;

    /**
     * Value of the Property.
     *
     * @since   0.0.1
     * @access  public
     * @var     string      $value
     */
    public $value;

    /**
     * Construct Property object.
     *
     * @since   0.0.1
     * @access  public
     * @param   string  $pbdb                       PBDB vocab of the property.
     * @param   string  $compacted      Optional    Compacted vocab of the property.
     * @param   array   $block          Optional    Parent block of property in API response.
     * @param   string  $value          Optional    Value of the given Property.
     * @param   string  $description    Optional    Description of the property.
     * @param   string  $darwin_core    Optional    Darwin Core version of the property.
     * @see     {@link http://paleobiodb.org/data1.1} 
     */
    public function __construct($pbdb, $compacted=null, $block=array(),
            $value=null, $description=null, $darwin_core=null) {
        $this->pbdb = $pbdb;
        $this->value = $value;
        $this->compacted = $compacted;
        if ( is_array( $block ) ) {
            $this->block = $block;
        } else {
            $this->block = array( $block );
        }
        $this->darwin_core = $darwin_core;
        $this->description = $description;
    }

    public function __toString() {
        return sprintf( "%s => %s", $this->pbdb, $this->value );
    }

    /**
     * Create a new Property object.
     *
     * @since   0.0.1
     * @access  public
     * @param   string  $pbdb
     * @param   string  $compacted
     * @param   string  $block
     */
    public static function factory( $pbdb, $compacted, $block ) {
        return new Property( $pbdb, $compacted, $block );
    }

}
