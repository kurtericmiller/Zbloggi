<?php
/**
 * User Collection object definition
 * @package Mapper
 */
/**
 * include Collections interface
 */
require_once ("Interfaces/Collections.php");
/**
 * UserCollection class
 * Operates on groups of Domain objects
 */
class Local_Domain_Mappers_UserCollection extends Local_Domain_Collection implements UserCollections
{
    /** Add to the collection
     *  @param object User
     */
    function add(Local_Domain_Models_User $User)
    {
        $this->doAdd($User);
    }
    /** Delete object from collection
     *  @param integer $pointer
     */
    function delete($pointer)
    {
        $this->doDelete($pointer);
    }
}
