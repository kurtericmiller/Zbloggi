<?php
/**
 * Setting Collection object definition
 * @package Mapper
 */
/**
 * include Collections interface
 */
require_once ("Interfaces/Collections.php");
/**
 * SettingCollection class
 * Operates on groups of Domain objects
 */
class Local_Domain_Mappers_SettingCollection extends Local_Domain_Collection implements SettingCollections
{
  /** Add to the collection
   *  @param object Setting
   */
  function add(Local_Domain_Models_Setting $Setting)
  {
    $this->doAdd($Setting);
  }
  /** Delete object from collection
   *  @param integer $pointer
   */
  function delete($pointer)
  {
    $this->doDelete($pointer);
  }
}
