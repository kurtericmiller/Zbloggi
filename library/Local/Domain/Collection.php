<?php
/**
 * Collection object definition
 * @package Mapper
 */
/**
 * include Collections interface
 */
require_once ("Interfaces/Collections.php");
/**
 * Collection class
 * Operates on groups of Domain objects
 */
abstract class Local_Domain_Collection
{
    /** object mapper
     * @var object $mapper
     */
    private $mapper;
    /** query result
     * @var array $result
     */
    private $result;
    /** total number rows in result
     * @var integer $total
     */
    private $total = 0;
    /** iterator pointer
     * @var integer $pointer
     */
    private $pointer = 0;
    /** list of objects
     * @var array $objects
     */
    private $objects = array();
    /** rows from result set
     * @var array $raw
     */
    private $raw = array();
    /** Instantiate collection object
     *  @param array $result
     *  @param object Mapper
     */
    function __construct($result = null, $mapper = null)
    {
        if ($result && $mapper) {
            $this->init_db($result, $mapper);
        }
    }
    /** Retrieve rows
     *  @param array $result
     *  @param object Mapper
     */
    protected function init_db($result, Local_Domain_Mapper $mapper)
    {
        $this->result = $result;
        $this->mapper = $mapper;
        foreach ($this->result as $row) {
            $this->total++;
            $this->raw[] = $row;
        }
    }
    /** Add an object to the collection
     *  @param object Local_Domain_DomainObject
     */
    protected function doAdd(Local_Domain_DomainObject $object)
    {
        $this->notifyAccess();
        $this->objects[$this->total] = $object;
        $this->total++;
    }
    /** Delete an object from collection
     *  @param integer $pointer
     */
    protected function doDelete($pointer)
    {
        $this->deleteObjectAt($pointer);
    }
    /** Stub function */
    protected function notifyAccess()
    {
        // deliberately left blank!
        
    }
    /** Retrieve object from collection
     *  @param integer $num
     *  @return object Local_Domain_DomainObject
     */
    private function getObjectAt($num)
    {
        $this->notifyAccess();
        if ($num >= $this->total || $num < 0) {
            return null;
        }
        if (array_key_exists($num, $this->objects)) {
            return $this->objects[$num];
        }
        if (array_key_exists($num, $this->raw)) {
            $this->objects[$num] = $this->mapper->loadArray($this->raw[$num]);
            return $this->objects[$num];
        }
    }
    /** Delete collection object
     *  @param integer $num
     *  @return mixed boolean/null
     */
    private function deleteObjectAt($num)
    {
        if ($num >= $this->total || $num < 0) {
            return null;
        }
        if (array_key_exists($num, $this->objects)) {
            $this->objects[$num]->markDeleted();
            return true;
        }
    }
    /** Return total number of collection objects
     *  @return integer
     */
    public function count()
    {
        $this->notifyAccess();
        return $this->total;
    }
    /** Reset pointer to first object */
    public function rewind()
    {
        $this->pointer = 0;
    }
    /** Return current object
     *  @return object Local_Domain_DomainObject
     */
    public function current()
    {
        return $this->getObjectAt($this->pointer);
    }
    /** Return object key
     *  @return integer
     */
    public function key()
    {
        return $this->pointer;
    }
    /** Move pointer to next object in collection
     *  @return Local_Domain_DomainObject
     */
    public function next()
    {
        $row = $this->getObjectAt($this->pointer);
        if ($row) {
            $this->pointer++;
        }
        return $row;
    }
    /** Return status of current pointer
     *  @return Local_Domain_DomainObject
     */
    public function valid()
    {
        return (!is_null($this->current()));
    }
}
?>
