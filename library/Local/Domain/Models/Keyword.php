<?php
/**
 * User object definition
 * @package Domain
 */
/**
 * Keyword class
 *
 * Contains table mappings and accessors
 */
class Local_Domain_Models_Keyword extends Local_Domain_DomainObject
{
    private $_id;
    private $_keyword;
    private $_created_at;
    private $_updated_at;
    function __construct($id = null, $keyword = null, $created_at = null, $updated_at = null)
    {
        parent::__construct($id);
        $defaults = $this->getDefaults();
        $this->_keyword = is_null($keyword) ? $defaults['_keyword'] : $keyword;
        $this->_created_at = is_null($created_at) ? $defaults['_created_at'] : $created_at;
        $this->_updated_at = is_null($updated_at) ? $defaults['_updated_at'] : $updated_at;
    }
    /** Set valid property to value (not null)
     *
     * @param string $property
     * @param mixed $value
     * @throws Exception for invalid property
     */
    function set($property, $value)
    {
        $property = '_' . $property;
        if (key_exists($property, get_object_vars($this))) {
            if (isset($value)) {
                $this->$property = $value;
            }
            $this->markDirty();
        } else {
            throw new Local_Exceptions_AppException(__METHOD__ . " says there was a call to the (set) method on a non-existent property: [ {$property} ]");
        }
    }
    /** Get valid property value
     *
     * @param string $property
     * @param mixed $value
     * @throws Exception for invalid property
     */
    function get($property)
    {
        $property = '_' . $property;
        if (key_exists($property, get_object_vars($this))) {
            return $this->$property;
        } else {
            throw new Local_Exceptions_AppException(__METHOD__ . "says there was a call to the (get) method on a non-existent property: [ {$property} ]");
        }
    }
}
?>
