<?php
/**
 * Mapper object definition
 * @package Mapper
 */
/**
 * include Finders interface
 */
require_once ("Interfaces/Finders.php");
/**
 * Mapper class
 * Map Domain objects to and from database
 */
abstract class Local_Domain_Mapper implements Finders
{
    /** DB handle */
    protected static $DB;
    /** Last object id created */
    protected $currentIds = array();
    /** Get DB connection */
    function __construct()
    {
        if (!self::$DB) {
            self::$DB = Zend_Registry::get('db');
        }
    }
    function getAdapter()
    {
        return self::$DB;
    }
    function load($result)
    {
        $loadArray = $result->fetchAll();
        $loadArray = array_shift($loadArray);
        if (!is_array($loadArray)) {
            return null;
        }
        $object = $this->loadArray($loadArray);
        return $object;
    }
    /** If object not cached, add object
     *  @param array $array
     *  @return object $obj
     */
    function loadArray($array)
    {
        if (isset($array['id'])) {
            $old = $this->getFromMap($array['id']);
            if ($old) {
                return $old;
            }
        }
        $obj = $this->doLoad($array);
        $this->addToMap($obj);
        $obj->markClean();
        return $obj;
    }
    /** Return object cache key
     *  @param integer $id
     *  @return mixed object key or null
     */
    function getFromMap($id)
    {
        return Local_Domain_ObjectWatcher::exists($this->targetClass(), $id);
    }
    /** Add object to cache
     *  @param object Local_Domain_DomainObject
     *  @return void
     */
    function addToMap(Local_Domain_DomainObject $obj)
    {
        return Local_Domain_ObjectWatcher::add($obj);
    }
    /** Locate object in cache or storage
     *  @param integer $id
     *  @return object Local_Domain_DomainObject
     */
    function find($id)
    {
        $old = $this->getFromMap($id);
        if (is_object($old)) {
            return $old;
        } else {
            $obj = $this->doFind($id);
            if (is_object($obj)) return $obj;
        }
        throw new Local_Exceptions_AppException(__METHOD__ . " says that " . $this->targetClass() . " find did not return an object");
    }
    /** Establish unique internal id for new objects.
     *  Actual row id generated by the db upon insert
     *  @return integer $id
     */
    function newId()
    {
        $table = strtolower($this->targetClass());
        $arrayKey = $table . '_' . 'id';
        while (true) {
            $id = SHA1(rand());
            if (array_key_exists($arrayKey, $this->currentIds)) {
                if ($id == $this->currentIds[$arrayKey]) {
                    continue;
                }
            }
            if ($this->getFromMap($id)) {
                continue;
            } else {
                break;
            }
        }
        $this->currentIds[$arrayKey] = $id;
        return $id;
    }
    /** Add object to storage
     *  @param object Local_Domain_DomainObject
     *  @return boolean
     */
    function insert(Local_Domain_DomainObject $obj)
    {
        $result = $this->doInsert($obj);
        $obj->markClean();
        return $result;
    }
    /** Update object in storage
     *  @param object Local_Domain_DomainObject
     *  @return boolean
     */
    function update(Local_Domain_DomainObject $obj)
    {
        $result = $this->doUpdate($obj);
        $obj->markClean();
        return $result;
    }
    /** Delete object from storage
     *  @param object Local_Domain_DomainObject
     *  @return boolean
     */
    function delete(Local_Domain_DomainObject $obj)
    {
        $result = $this->doDelete($obj);
        $obj->markClean();
        return $result;
    }
    /** Execute storage operation
     *  @param string $sql
     *  @param array $values
     *  @return boolean
     */
    function doStatement($sql, $values = null, $singleton = false)
    {
        try {
            if ($singleton) {
                $result = self::$DB->fetchOne($sql, $values);
            } elseif ($values) {
                $result = self::$DB->query($sql, $values);
            } else {
                $result = self::$DB->query($sql);
            }
            return $result;
        }
        catch(Exception $e) {
            $msg = __METHOD__ . " says the DB is having problems.\n\nThe query was:\n--------------\n$sql";
            if (isset($values)) {
                $msg.= " with " . count($values) . " values (";
                foreach ($values as $v) {
                    $msg.= "$v,";
                }
                $msg.= ")";
            } else {
                $msg.= "(no values were passed)\n";
            }
            throw new Local_Exceptions_SqlException($msg . " that triggered the $e");
        }
    }
    function getCount()
    {
        $tab = strtolower($this->targetClass()) . 's';
        return $this->doStatement("select count(*) from $tab", array(), SINGLETON);
    }
    function getInsertId()
    {
        return $this->doStatement('select last_insert_id()', array(), SINGLETON);
    }
    /** get defaults for tables
     *  @param string $table
     *  @return/cache array of defaults for table
     */
    function getTableDefaults()
    {
        $table = strtolower($this->targetClass()) . 's';
        $registry = Zend_Registry::getInstance();
        $config = $registry['config'];
        $dbname = $config['resources']['db']['params']['dbname'];
        if (isset($registry["$table.defaults"])) {
            return $registry["$table.defaults"];
        }
        $sql = "select column_name,column_default from information_schema.columns where table_schema = '" . $dbname . "' and table_name = ?";
        $result = $this->doStatement($sql, array($table));
        $values = $result->fetchAll();
        foreach ($values as $value) {
            $defaults["_" . $value["column_name"]] = is_null($value["column_default"]) ? 'NULL' : $value["column_default"];
        }
        $defaults['_created_at'] = NULL;
        $defaults['_updated_at'] = NULL;
        $registry["$table.defaults"] = $defaults;
        return $defaults;
    }
    protected abstract function doLoad($array);
    /** Concrete method implemented in object mapper class */
    protected abstract function doFind($id);
    /** Concrete method implemented in object mapper class */
    protected abstract function doInsert(Local_Domain_DomainObject $object);
    /** Concrete method implemented in object mapper class */
    protected abstract function doUpdate(Local_Domain_DomainObject $object);
    /** Concrete method implemented in object mapper class */
    protected abstract function doDelete(Local_Domain_DomainObject $object);
    /** Concrete method implemented in object mapper class */
    protected abstract function targetClass();
}
?>
