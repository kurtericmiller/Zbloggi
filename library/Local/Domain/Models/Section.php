<?php
/**
 * User object definition
 * @package Domain
 */
/**
 * Section class
 *
 * Contains table mappings and accessors
 */

class Local_Domain_Models_Section extends Local_Domain_DomainObject {
  private $_id;
  private $_published;
  private $_section_title;
  private $_section_text;
  private $_created_at;
  private $_updated_at;

  function __construct (
    $id = null,
    $published = null,
    $section_title = null,
    $section_text = null,
    $created_at = null,
    $updated_at = null
  ) { parent::__construct($id);
      $defaults = $this->getDefaults();
      $this->_published = is_null($published) ? $defaults['_published'] : $published;
      $this->_section_title = is_null($section_title) ? $defaults['_section_title'] : $section_title;
      $this->_section_text = is_null($section_text) ? $defaults['_section_text'] : $section_text;
      $this->_created_at = is_null($created_at) ? $defaults['_created_at'] : $created_at;
      $this->_updated_at = is_null($updated_at) ? $defaults['_updated_at'] : $updated_at;
    }

  /** Set valid property to value (not null)
   *
   * @param string $property
   * @param mixed $value
   * @throws Exception for invalid property
   */
  function set($property, $value) {
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
  function get($property) {
    $property = '_' . $property;
    if (key_exists($property, get_object_vars($this))) {
      return $this->$property;
    } else {
      throw new Local_Exceptions_AppException(__METHOD__ . "says there was a call to the (get) method on a non-existent property: [ {$property} ]");
    }
  }
}
?>
