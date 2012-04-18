<?php
/**
 * Book Collection object definition
 * @package Mapper
 */
/**
 * include Collections interface
 */
require_once ("Interfaces/Collections.php");
/**
 * BookCollection class
 * Operates on groups of Domain objects
 */
class Local_Domain_Mappers_BookCollection extends Local_Domain_Collection implements BookCollections
{
  /** Add to the collection
   *  @param object Book
   */
  function add(Local_Domain_Models_Book $Book)
  {
    $this->doAdd($Book);
  }
  /** Delete object from collection
   *  @param integer $pointer
   */
  function delete($pointer)
  {
    $this->doDelete($pointer);
  }
}
