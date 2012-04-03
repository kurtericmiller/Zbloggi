<?php
/**
 * User object definition
 * @package Domain
 */
/**
 * Profile class
 *
 * Contains table mappings and accessors
 */
class Local_Domain_Models_Profile extends Local_Domain_DomainObject
{
  private $_id;
  private $_user_id;
  private $_first;
  private $_last;
  private $_middle;
  private $_occupation;
  private $_website;
  private $_bio_text;
  private $_avatar;
  private $_created_at;
  private $_updated_at;
  function __construct($id = null, $user_id = null, $first = null, $last = null, $middle = null, $occupation = null, $website = null, $bio_text = null, $avatar = null, $created_at = null, $updated_at = null)
  {
    parent::__construct($id);
    $defaults = $this->getDefaults();
    $this->_user_id = is_null($user_id) ? $defaults['_user_id'] : $user_id;
    $this->_first = is_null($first) ? $defaults['_first'] : $first;
    $this->_last = is_null($last) ? $defaults['_last'] : $last;
    $this->_middle = is_null($middle) ? $defaults['_middle'] : $middle;
    $this->_occupation = is_null($occupation) ? $defaults['_occupation'] : $occupation;
    $this->_website = is_null($website) ? $defaults['_website'] : $website;
    $this->_bio_text = is_null($bio_text) ? $defaults['_bio_text'] : $bio_text;
    $this->_avatar = is_null($avatar) ? $defaults['_avatar'] : $avatar;
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
