<?php
/**
 * PBDB Parameter.
 *
 * @link       http://atmoapps.com
 * @since      0.0.1
 *
 * @package    myFOSSIL_PBDB
 * @subpackage myFOSSIL_PBDB/includes/pbdb
 */
namespace myFOSSIL\PBDB;

/**
 * PBDB Parameter.
 *
 * This class defines all information relating to a parameter of a PBDB object.
 *
 * @since      0.0.1
 * @package    myFOSSIL_PBDB
 * @subpackage myFOSSIL_PBDB/includes/pbdb
 * @author     Brandon Wood <bwood@atmoapps.com>
 */
class Parameter 
{
    /**
     * Name of the Parameter.
     *
     * @since   0.0.1
     * @access  protected
     * @see     {@link http://paleobiodb.org/data1.1/formats}
     * @var     string      $name
     */
    public $name;

    /**
     * Value or argument supplied to PBDB for this parameter.
     *
     * @since   0.0.1
     * @access  protected
     * @see     {@link http://paleobiodb.org/data1.1/formats}
     * @var     mixed   $value
     */
    public $value;

    /**
     * Whether the Parameter is optional when making requests of the PBDB API.
     *
     * @since   0.0.1
     * @access  protected
     * @var     bool        $optional
     */
    protected $optional;

    /**
     * Description of the Parameter.
     *
     * @since   0.0.1
     * @access  protected
     * @see     {@link http://paleobiodb.org/data1.1/formats}
     * @var     string      $description
     */
    protected $description;

    /**
     * Rendering template for producing URL arguments for the API.
     *
     * @since   0.0.1
     * @access  protected
     * @var     string  $tpl
     */
    protected $tpl = '%s=%s';

    /**
     * Supported types of values.
     *
     * @since   0.0.1
     * @access  protected
     * @var     array       $valid_types
     * @see     PBDB_Parameter::valid()
     */
    protected $valid_types = array( 'array', 'boolean', 'integer', 'string' );

    /**
     * Supported values of values.
     *
     * @since   0.0.1
     * @access  protected
     * @var     array       $valid_values
     * @see     PBDB_Parameter::valid()
     */
    protected $valid_values = array();

    /**
     * Construct PBDB_Parameter object.
     *
     * @since   0.0.1
     * @access  public
     * @var     string  $name                       PaleoBioDatabase name of the Parameter.
     * @var     string  $description    Optional    Description of the parameter.
     * @see     {@link http://paleobiodb.org/data1.1} 
     */
    public function __construct($name, $value=null, $optional=true, $description=null) {
        $this->name = $name;
        $this->value = $value;
        $this->optional = $optional;
        $this->description = $description;
    }

    /**
     * Create a new Parameter object.
     *
     * @since   0.0.1
     * @var     string  $name
     * @var     mixed   $value
     * @var     string  $optional   Optional    default true
     */
    public static function factory( $name, $value, $optional=true ) {
        return new Parameter( $name, $value, $optional );
    }

    /**
     * Render the Parameter and its arguments into a URL query string partial.
     *
     * @since   0.0.1
     * @access  public
     * @var     bool    $validate           Optional    Whether to validate prior to rendering, default true.
     * @return  string                                  Rendered template string.
     */
    public function render( $validate=true ) {
        if ( $validate && !$this->valid() )
            return null;

        if ( !isset( $this->value ) || empty( $this->value ) )
            return null;

        switch ( gettype( $this->value ) ) {
            case 'string':
            case 'integer':
                $_rendered_value = (string) $this->value;
                break;
            case 'array':
                $_rendered_value = implode( ',', $this->value );
                break;
            case 'boolean':
                $_rendered_value = $this->value ? (string) 1 : (string) 0;
                break;
            default:
                return null;
                break;
        }

        return sprintf( $this->tpl, $this->name, $_rendered_value );
    }

    /**
     * Returns whether a given name is valid for this Parameter.
     *
     * @since   0.0.1
     * @access  private 
     * @return  bool                        Returns true if valid, false if invalid.
     */
    private function validName( $name ) {
        if ( !isset( $name ) || empty( $name ) ) {
            return false;
        } elseif ( !is_string( $name ) ) {
            return false;
        }

        return true;
    }

    /**
     * Returns whether a given variable is valid for this Parameter.
     *
     * @since   0.0.1
     * @access  private 
     * @return  bool                        Returns true if valid, false if invalid.
     */
    private function validValue( $value ) {
        if ( !in_array( gettype( $value ), $this->valid_types ) ) 
            return false;

        if ( is_array( $this->valid_values ) && count( $this->valid_values ) )
            if ( !in_array( $value, $this->valid_values ) ) 
                return false;

        return true;
    }

    /**
     * Validate that all properties of this object are valid.
     *
     * @since   0.0.1
     * @access  public
     * @throws  RuntimeException            If Parameter cannot be rendered due to value issues.
     * @throws  UnexpectedValueException    If Parameter cannot be rendered due to typing issues.
     * @return  bool                        Returns true if valid, false if invalid.
     * @see     {@link http://php.net/manual/en/function.gettype.php}
     */ 
    public function valid() {
        if ( isset( $this->value ) && !empty( $this->value ) )
            return $this->validName( $this->name) && $this->validValue( $this->value );

        return $this->validName( $this->name );
    }

    /**
     * Set the name.
     *
     * @since   0.0.1
     * @access  public
     * @var     string  name of Parameter 
     * @return  bool    trupe upon success, false upon failure.
     */
    public function setName( string $name ) {
        if ( !$this->validName( $name ) )
            return false;
        $this->name = $name;
        return true;
    }

    /**
     * Get the parameter's name
     *
     * @since   0.0.1
     * @access  public
     * @return  string  Template string for sprintf
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Set the value.
     *
     * @since   0.0.1
     * @access  public
     * @var     mixed   value(s) of Parameter, can be anything in $this->valid_values with type $this->valid_types
     * @return  bool    trupe upon success, false upon failure.
     */
    public function setValue( $value ) {
        if ( !$this->validValue( $value ) )
            return false;
        $this->value = $value;
        return true;
    }

    /**
     * Add another value to the running list of values.
     *
     * @since   0.0.1
     * @access  public
     * @var     mixed   $value              value(s) to add to values list
     * @return  bool                        true upon success, false upon failure.
     */
    public function addValue( $value ) {
        if ( !$this->validValue( $value ) || !is_array( $this->value ) )
            return false;
    
        if ( !is_array( $value ) ) {
            $this->value[] = $value;
        } else {
            $this->value += $value;
        }
        
        return count( $this->value ) > 0;
    }

    /**
     * Get the value.
     *
     * @since   0.0.1
     * @access  public
     * @return  mixed
     */
    public function getValue() {
        return $this->value;
    }

    /**
     * Set the rendering template.
     *
     * @since   0.0.1
     * @access  public
     * @var     string  Template string for sprintf
     * @return  bool    trupe upon success, false upon failure.
     * @see     sprintf
     */
    public function setTemplate( string $tpl ) {
        if ( !is_string( $tpl ) ) return false;
        $this->tpl = $tpl;
        return true;
    }

    /**
     * Get the rendering template.
     *
     * @since   0.0.1
     * @access  public
     * @return  string  Template string for sprintf
     * @see     sprintf
     */
    public function getTemplate() {
        return $this->tpl;
    }

}
