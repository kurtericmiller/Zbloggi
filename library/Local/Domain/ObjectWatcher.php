<?php
/**
 * Domain Object Definition
 * @package Domain
 */
/**
 * ObjectWatcher class
 * Cache domain object operations.
 */
class Local_Domain_ObjectWatcher
{
  /** list of all cached objects
   *  @var array
   */
  private $all = array();
  /** list of objects to update
   *  @var array
   */
  private $new = array();
  /** list of objects to delete
   *  @var array
   */
  private $dirty = array();
  /** list of objects to add
   *  @var array
   */
  private $delete = array();
  /** singleton instance
   *  @var object
   */
  private static $instance;
  /** singleton - not instantiated */
  private function __construct()
  {
  }
  /** singleton - instantiate; return instance
   *  @return object $this
   */
  static function instance()
  {
    if (!self::$instance) {
      self::$instance = new Local_Domain_ObjectWatcher();
    }
    return self::$instance;
  }
  /** Create unique object key
   *  @param  object Local_Domain_DomainObject $obj
   *  @return string
   */
  function globalKey(Local_Domain_DomainObject $obj)
  {
    $key = get_class($obj) . "." . $obj->getId();
    return $key;
  }
  /** Add an existing object to 'all' list
   *  @param object Local_Domain_DomainObject
   */
  static function add(Local_Domain_DomainObject $obj)
  {
    $inst = self::instance();
    if (!isset($inst->new[$inst->globalKey($obj) ])) {
      $inst->all[$inst->globalKey($obj) ] = $obj;
    }
  }
  /** Add a new object to 'new' list
   *  @param object Local_Domain_DomainObject
   */
  static function addNew(Local_Domain_DomainObject $obj)
  {
    $inst = self::instance();
    $inst->new[$inst->globalKey($obj) ] = $obj;
  }
  /** Add an existing modified object to 'dirty' list
   *  @param object Local_Domain_DomainObject
   */
  static function addDirty(Local_Domain_DomainObject $obj)
  {
    $inst = self::instance();
    if (!isset($inst->new[$inst->globalKey($obj) ])) {
      $inst->dirty[$inst->globalKey($obj) ] = $obj;
    }
  }
  /** Add a deleted object to 'delete' list
   *  @param object Local_Domain_DomainObject
   */
  static function addDelete(Local_Domain_DomainObject $obj)
  {
    $inst = self::instance();
    $inst->delete[$inst->globalKey($obj) ] = $obj;
  }
  /** Remove an object from all pending activity lists
   *  @param object Local_Domain_DomainObject
   */
  static function addClean(Local_Domain_DomainObject $obj)
  {
    $inst = self::instance();
    unset($inst->new[$inst->globalKey($obj) ]);
    unset($inst->delete[$inst->globalKey($obj) ]);
    unset($inst->dirty[$inst->globalKey($obj) ]);
  }
  /** Return object cache status
   *  @param string $classname
   *  @param integer $id
   */
  static function exists($classname, $id)
  {
    $inst = self::instance();
    $key = "$classname.$id";
    if (isset($inst->all[$key])) {
      arsort($inst->all);
      return $inst->all[$key];
    }
    return null;
  }
  /** Process objects in cache
   */
  function clearPending()
  {
    try {
      foreach ($this->dirty as $key => $obj) {
        $result = $obj->finder()->update($obj);
      }
      foreach ($this->delete as $key => $obj) {
        $result = $obj->finder()->delete($obj);
      }
      foreach ($this->new as $key => $obj) {
        $result = $obj->finder()->insert($obj);
      }
      $this->new = array();
      $this->dirty = array();
      $this->delete = array();
    }
    catch(Exception $e) {
      throw new Local_Exceptions_SqlException(__METHOD__ . " says the DB is having problems. " . $e);
    }
  }
  /** Perform any cached operations upon garbage collection */
  function __destruct()
  {
    $this->clearPending();
  }
  /** Remove all cached operations (for testing purposes) */
  function clear()
  {
    $this->all = array();
    $this->new = array();
    $this->dirty = array();
    $this->delete = array();
  }
  /** Query cached operations (for testing purposes) */
  static function key_exists($cache, $classname, $id)
  {
    $inst = self::instance();
    $key = "$classname.$id";
    switch ($cache) {
    case "all":
      if (isset($inst->all[$key])) {
        return $inst->all[$key];
      }
      break;

    case "new":
      if (isset($inst->new[$key])) {
        return $inst->new[$key];
      }
      break;

    case "dirty":
      if (isset($inst->dirty[$key])) {
        return $inst->dirty[$key];
      }
      break;

    case "delete":
      if (isset($inst->delete[$key])) {
        return $inst->delete[$key];
      }
      break;
    }
    return null;
  }
}
?>
