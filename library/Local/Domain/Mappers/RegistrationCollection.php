<?php
/**
 * Registration Collection object definition
 * @package Mapper
 */
/**
 * include Collections interface
 */
require_once ("Interfaces/Collections.php");
/**
 * RegistrationCollection class
 * Operates on groups of Domain objects
 */
class Local_Domain_Mappers_RegistrationCollection extends Local_Domain_Collection implements RegistrationCollections
{
    /** Add to the collection
     *  @param object Registration
     */
    function add(Local_Domain_Models_Registration $Registration)
    {
        $this->doAdd($Registration);
    }
    /** Delete object from collection
     *  @param integer $pointer
     */
    function delete($pointer)
    {
        $this->doDelete($pointer);
    }
}
