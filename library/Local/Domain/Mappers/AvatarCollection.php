<?php
/**
 * Avatar Collection object definition
 * @package Mapper
 */
/**
 * include Collections interface
 */
require_once ("Interfaces/Collections.php");
/**
 * AvatarCollection class
 * Operates on groups of Domain objects
 */
class Local_Domain_Mappers_AvatarCollection extends Local_Domain_Collection implements AvatarCollections
{
    /** Add to the collection
     *  @param object Avatar
     */
    function add(Local_Domain_Models_Avatar $Avatar)
    {
        $this->doAdd($Avatar);
    }
    /** Delete object from collection
     *  @param integer $pointer
     */
    function delete($pointer)
    {
        $this->doDelete($pointer);
    }
}
