<?php
/**
 * Menu Collection object definition
 * @package Mapper
 */
/**
 * include Collections interface
 */
require_once ("Interfaces/Collections.php");
/**
 * MenuCollection class
 * Operates on groups of Domain objects
 */
class Local_Domain_Mappers_MenuCollection extends Local_Domain_Collection implements MenuCollections
{
  /** Add to the collection
   *  @param object Menu
   */
  function add(Local_Domain_Models_Menu $Menu)
  {
    $this->doAdd($Menu);
  }
  /** Delete object from collection
   *  @param integer $pointer
   */
  function delete($pointer)
  {
    $this->doDelete($pointer);
  }
}
