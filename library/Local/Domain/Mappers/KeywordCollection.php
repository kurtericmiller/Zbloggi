<?php
/**
 * Keyword Collection object definition
 * @package Mapper
 */
/**
 * include Collections interface
 */
require_once ("Interfaces/Collections.php");
/**
 * KeywordCollection class
 * Operates on groups of Domain objects
 */
class Local_Domain_Mappers_KeywordCollection extends Local_Domain_Collection implements KeywordCollections
{
    /** Add to the collection
     *  @param object Keyword
     */
    function add(Local_Domain_Models_Keyword $Keyword)
    {
        $this->doAdd($Keyword);
    }
    /** Delete object from collection
     *  @param integer $pointer
     */
    function delete($pointer)
    {
        $this->doDelete($pointer);
    }
}
