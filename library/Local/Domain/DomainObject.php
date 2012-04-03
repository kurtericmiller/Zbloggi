<?php
/**
 * Local_Domain Object Definition
 * @package Local_Domain
 */
/**
 * include Collections interface
 */
require_once ("Interfaces/Collections.php");
/**
 *  Create and modify domain objects.
 *  Every domain object has an associated mapper,
 *  finder, and collection. These are used to interface
 *  the object with a storage medium. All storage medium
 *  activity is cached via the ObjectWatcher to minimize
 *  and centralize calls to storage.  Not every application entity
 *  is necessarily a Local_Domain_DomainObject, only those with frequent activity
 *  or specialized retrieval and placement requirements.
 */
abstract class Local_Domain_DomainObject
{
  private $id;
  /** Instantiate a domain object.
   *  If an id is passed in, it references an existing object.
   *  Otherwise, an id is generated for a newly created object.
   *
   *  @param integer $id
   */
  function __construct($id = null)
  {
    $this->id = $id;
    if (!$this->id) {
      $this->id = $this->finder()->newId();
      $this->markNew();
    }
  }
  /** Return this object's id */
  function getId()
  {
    return $this->id;
  }
  /** Find a domain object */
  function finder()
  {
    return self::getFinder(get_class($this));
  }
  /** Return all objects of a given type */
  function collection()
  {
    return self::getCollection(get_class($this));
  }
  /** Resolve domain objects */
  static function getFinder($type)
  {
    return Local_Domain_HelperFactory::getFinder($type);
  }
  /** Resolve collection objects */
  static function getCollection($type)
  {
    return Local_Domain_HelperFactory::getCollection($type);
  }
  /** Cache the object for addition (table insert) */
  function markNew()
  {
    Local_Domain_ObjectWatcher::addNew($this);
  }
  /** Remove object from all pending activity lists. */
  function markClean()
  {
    Local_Domain_ObjectWatcher::addClean($this);
  }
  /** Cached object changes will be applied. */
  function markDirty()
  {
    Local_Domain_ObjectWatcher::addDirty($this);
  }
  /** Cached object will be deleted */
  function markDeleted()
  {
    Local_Domain_ObjectWatcher::addDelete($this);
  }
  /** Return id for the last db operation */
  function getLastId()
  {
    return $this->finder()->getInsertId();
  }
  /** Return the defaults settings for a db table */
  function getDefaults()
  {
    return $this->finder()->getTableDefaults();
  }
}
?>
