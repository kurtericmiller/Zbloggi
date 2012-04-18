<?php
/**
 * User object definition
 * @package Domain
 */
/**
 * Article class
 *
 * Contains table mappings and accessors
 */

class Local_Domain_Models_Article extends Local_Domain_DomainObject {
  private $_id;
  private $_user_id;
  private $_published;
  private $_read_count;
  private $_article_title;
  private $_article_text;
  private $_created_at;
  private $_updated_at;

  function __construct (
    $id = null,
    $user_id = null,
    $published = null,
    $read_count = null,
    $article_title = null,
    $article_text = null,
    $created_at = null,
    $updated_at = null
  ) { parent::__construct($id);
      $defaults = $this->getDefaults();
      $this->_user_id = is_null($user_id) ? $defaults['_user_id'] : $user_id;
      $this->_published = is_null($published) ? $defaults['_published'] : $published;
      $this->_read_count = is_null($read_count) ? $defaults['_read_count'] : $read_count;
      $this->_article_title = is_null($article_title) ? $defaults['_article_title'] : $article_title;
      $this->_article_text = is_null($article_text) ? $defaults['_article_text'] : $article_text;
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
