<?php
/**
 * Comment Collection object definition
 * @package Mapper
 */
/**
 * include Collections interface
 */
require_once ("Interfaces/Collections.php");
/**
 * CommentCollection class
 * Operates on groups of Domain objects
 */
class Local_Domain_Mappers_CommentCollection extends Local_Domain_Collection implements CommentCollections
{
  /** Add to the collection
   *  @param object Comment
   */
  function add(Local_Domain_Models_Comment $Comment)
  {
    $this->doAdd($Comment);
  }
  /** Delete object from collection
   *  @param integer $pointer
   */
  function delete($pointer)
  {
    $this->doDelete($pointer);
  }
}
