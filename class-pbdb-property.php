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
class PBDB_Property
{
    /**
     * Name of the Property for the 'pbdb' vocabulary.
     *
     * @since   0.0.1
     * @access  protected
     * @see     {@link http://paleobiodb.org/data1.1/formats}
     * @var     string  $pbdb;
     */
    protected $pbdb;

    /**
     * Name of the Property for the 'com' vocabulary.
     *
     * @since   0.0.1
     * @access  protected
     * @see     {@link http://paleobiodb.org/data1.1/formats}
     * @var     string  $compacted
     */
    protected $compacted;

    /**
     * Name of the Property for the 'dwc' vocabulary.
     *
     * @since   0.0.1
     * @access  protected
     * @see     {@link http://paleobiodb.org/data1.1/formats}
     * @var     string  $darwin_core;
     */
    protected $darwin_core;

    /**
     * Description of the Property.
     *
     * @since   0.0.1
     * @access  protected
     * @see     {@link http://paleobiodb.org/data1.1/formats}
     * @var     string  $description;
     */
    protected $description;

    /**
     * Construct PBDB_Property object.
     *
     * @since   0.0.1
     * @access  public
     * @var     string  $pbdb                       PaleoBioDatabase version of the property.
     * @var     string  $compacted                  Compacted version of the property.
     * @var     string  $block                      Parent block of property in API response.
     * @var     string  $darwin_core    Optional    Darwin Core version of the property.
     * @var     string  $description    Optional    Description of the property.
     * @see     {@link http://paleobiodb.org/data1.1} 
     */
    public function __construct($pbdb, $compacted, $block, $darwin_core=null, $description=null) {
        $this->pbdb = $pbdb;
        $this->compacted = $compacted;
        $this->darwin_core = $darwin_core;
        $this->description = $description;
    }
}
