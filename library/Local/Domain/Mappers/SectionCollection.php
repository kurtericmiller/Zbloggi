<?php
/**
 * Section Collection object definition
 * @package Mapper
 */
/**
 * include Collections interface
 */
require_once ("Interfaces/Collections.php");
/**
 * SectionCollection class
 * Operates on groups of Domain objects
 */
class Local_Domain_Mappers_SectionCollection extends Local_Domain_Collection implements SectionCollections
{
  /** Add to the collection
   *  @param object Section
   */
  function add(Local_Domain_Models_Section $Section)
  {
    $this->doAdd($Section);
  }
  /** Delete object from collection
   *  @param integer $pointer
   */
  function delete($pointer)
  {
    $this->doDelete($pointer);
  }
}
