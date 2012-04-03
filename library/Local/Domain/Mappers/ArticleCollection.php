<?php
/**
 * Article Collection object definition
 * @package Mapper
 */
/**
 * include Collections interface
 */
require_once ("Interfaces/Collections.php");
/**
 * ArticleCollection class
 * Operates on groups of Domain objects
 */
class Local_Domain_Mappers_ArticleCollection extends Local_Domain_Collection implements ArticleCollections
{
  /** Add to the collection
   *  @param object Article
   */
  function add(Local_Domain_Models_Article $Article)
  {
    $this->doAdd($Article);
  }
  /** Delete object from collection
   *  @param integer $pointer
   */
  function delete($pointer)
  {
    $this->doDelete($pointer);
  }
}
