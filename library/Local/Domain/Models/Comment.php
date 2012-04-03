<?php
/**
 * User object definition
 * @package Domain
 */
/**
 * Comment class
 *
 * Contains table mappings and accessors
 */
class Local_Domain_Models_Comment extends Local_Domain_DomainObject
{
  private $_id;
  private $_user_id;
  private $_article_id;
  private $_comment_text;
  private $_created_at;
  private $_updated_at;
  function __construct($id = null, $user_id = null, $article_id = null, $comment_text = null, $created_at = null, $updated_at = null)
  {
    parent::__construct($id);
    $defaults = $this->getDefaults();
    $this->_user_id = is_null($user_id) ? $defaults['_user_id'] : $user_id;
    $this->_article_id = is_null($article_id) ? $defaults['_article_id'] : $article_id;
    $this->_comment_text = is_null($comment_text) ? $defaults['_comment_text'] : $comment_text;
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
