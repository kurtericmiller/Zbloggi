<?php
/**
 * Collections Interface Definition
 * @package Domain
 *
 */
/** Collections interface.
 *  Methods to manipulate groups of domain objects
 */
interface UserCollections extends Iterator {
    function add(Local_Domain_Models_User $obj);
    function delete($pointer);
}
interface RegistrationCollections extends Iterator
{
    function add(Local_Domain_Models_Registration $obj);
    function delete($pointer);
}
interface ArticleCollections extends Iterator
{
    function add(Local_Domain_Models_Article $obj);
    function delete($pointer);
}
interface ProfileCollections extends Iterator
{
    function add(Local_Domain_Models_Profile $obj);
    function delete($pointer);
}
interface SettingCollections extends Iterator
{
    function add(Local_Domain_Models_Setting $obj);
    function delete($pointer);
}
interface SectionCollections extends Iterator
{
    function add(Local_Domain_Models_Section $obj);
    function delete($pointer);
}
interface KeywordCollections extends Iterator
{
    function add(Local_Domain_Models_Keyword $obj);
    function delete($pointer);
}
interface BookCollections extends Iterator
{
    function add(Local_Domain_Models_Book $obj);
    function delete($pointer);
}
interface AvatarCollections extends Iterator
{
    function add(Local_Domain_Models_Avatar $obj);
    function delete($pointer);
}
interface CommentCollections extends Iterator
{
    function add(Local_Domain_Models_Comment $obj);
    function delete($pointer);
}
interface MenuCollections extends Iterator
{
    function add(Local_Domain_Models_Menu $obj);
    function delete($pointer);
}
