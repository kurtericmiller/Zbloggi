<?php
/**
 * Profile Collection object definition
 * @package Mapper
 */
/**
 * include Collections interface
 */
require_once ("Interfaces/Collections.php");
/**
 * ProfileCollection class
 * Operates on groups of Domain objects
 */
class Local_Domain_Mappers_ProfileCollection extends Local_Domain_Collection implements ProfileCollections
{
  /** Add to the collection
   *  @param object Profile
   */
  function add(Local_Domain_Models_Profile $Profile)
  {
    $this->doAdd($Profile);
  }
  /** Delete object from collection
   *  @param integer $pointer
   */
  function delete($pointer)
  {
    $this->doDelete($pointer);
  }
}
