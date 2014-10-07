<?php
/**
 * PBDB Parameter.
 *
 * @link       http://atmoapps.com
 * @since      0.0.1
 */

namespace myFOSSIL\PBDB\API;

/**
 * PBDB Parameter.
 *
 * This class defines all information relating to a parameter of a PBDB object.
 *
 * @since      0.0.1
 * @author     Brandon Wood <bwood@atmoapps.com>
 */
class Parameter 
{
    /**
     * Name of the Parameter.
     *
     * @since   0.0.1
     * @access  public 
     * @see     {@link http://paleobiodb.org/data1.1/formats}
     * @var     string      $name
     */
    public $name;

    /**
     * Value or argument supplied to PBDB for this parameter.
     *
     * @since   0.0.1
     * @access  public 
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
     * Construct Parameter object.
     *
     * @since   0.0.1
     * @access  public
     * @param   string  $name                       PaleoBioDatabase name of the Parameter.
     * @param   string  $description    Optional    Description of the parameter.
     * @param   string  $value          Optional    Value of the given parameter.
     * @param   bool    $optional       Optional    Whether or not the parameter is optional to PBDB.
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
     * @param   string  $name                   Name of the parameter.
     * @param   mixed   $value                  Value of the parameter.
     * @param   string  $optional   Optional    Whether the Parameter is optional, default true.
     */
    public static function factory( $name, $value, $optional=true ) {
        return new Parameter( $name, $value, $optional );
    }

    /**
     * Render the Parameter and its arguments into a URL query string partial.
     *
     * @since   0.0.1
     * @access  public
     * @param   bool    $validate           Optional    Whether to validate prior to rendering, default true.
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
     * @param   string      $name   Given name of the Parameter to validate.
     * @return  bool                Returns true if valid, false if invalid.
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
     * @param   mixed       $value  Given value of the Parameter to validate.
     * @return  bool                Returns true if valid, false if invalid.
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

}
