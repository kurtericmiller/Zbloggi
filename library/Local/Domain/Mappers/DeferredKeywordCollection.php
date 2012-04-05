<?php
/**
 * Deferred Keyword Collection object definition
 * @package Mapper
 */
/**
 * DeferredKeywordCollection class
 * Optimized (cached) object activity
 */
class Local_Domain_Mappers_DeferredKeywordCollection extends Local_Domain_Mappers_KeywordCollection
{
    /** Prepared statement handle
     *  @var string
     */
    private $stmt;
    /** Object property values
     *  @var array
     */
    private $valueArray;
    /** Mapper object
     *  @var object
     */
    private $mapper;
    /** Cached status flag
     *  @var boolean
     */
    private $run = false;
    /** Instantiate Deferred Collection
     *  @param object Mapper
     *  @param handle $stmt_handle
     *  @param array $valueArray
     */
    function __construct(Local_Domain_Mapper $mapper, $stmt_handle, $valueArray)
    {
        parent::__construct();
        $this->stmt = $stmt_handle;
        $this->valueArray = $valueArray;
        $this->mapper = $mapper;
    }
    /** Object not cached, retrieve from storage */
    function notifyAccess()
    {
        if (!$this->run) {
            $result = $this->mapper->doStatement($this->stmt, $this->valueArray);
            $this->init_db($result, $this->mapper);
        }
        $this->run = true;
    }
}
