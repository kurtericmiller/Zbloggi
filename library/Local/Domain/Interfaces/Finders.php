<?php
/**
 * Finders Interface Definition
 * @package Domain
 *
 */
/** Methods to manipulate individual domain objects. */
interface Finders {
  function find($id);
  function findAll($options=null);
  function newId();
  function update(Local_Domain_DomainObject $obj);
  function insert(Local_Domain_DomainObject $obj);
  function delete(Local_Domain_DomainObject $obj);
}
interface BookFinder extends Finders
{
}
interface KeywordFinder extends Finders
{
}
interface SettingFinder extends Finders
{
}
interface ProfileFinder extends Finders
{
}
interface CommentFinder extends Finders
{
}
interface ArticleFinder extends Finders
{
}
interface AvatarFinder extends Finders
{
}
interface SectionFinder extends Finders
{
}
interface RegistrationFinder extends Finders
{
}
interface MenuFinder extends Finders
{
}
interface UserFinder extends Finders
{
}
