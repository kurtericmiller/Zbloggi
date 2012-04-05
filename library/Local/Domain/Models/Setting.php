<?php
/**
 * User object definition
 * @package Domain
 */
/**
 * Setting class
 *
 * Contains table mappings and accessors
 */
class Local_Domain_Models_Setting extends Local_Domain_DomainObject
{
    private $_id;
    private $_site_title;
    private $_site_tagline;
    private $_site_url;
    private $_headlineId;
    private $_articleCount;
    private $_bookCount;
    private $_latestArticleCount;
    private $_amazonLU;
    private $_admArtCnt;
    private $_admComCnt;
    private $_admUserCnt;
    private $_defemail;
    private $_created_at;
    private $_updated_at;
    function __construct($id = null, $site_title = null, $site_tagline = null, $site_url = null, $headlineId = null, $articleCount = null, $bookCount = null, $latestArticleCount = null, $amazonLU = null, $admArtCnt = null, $admComCnt = null, $admUserCnt = null, $defemail = null, $created_at = null, $updated_at = null)
    {
        parent::__construct($id);
        $defaults = $this->getDefaults();
        $this->_site_title = is_null($site_title) ? $defaults['_site_title'] : $site_title;
        $this->_site_tagline = is_null($site_tagline) ? $defaults['_site_tagline'] : $site_tagline;
        $this->_site_url = is_null($site_url) ? $defaults['_site_url'] : $site_url;
        $this->_headlineId = is_null($headlineId) ? $defaults['_headlineId'] : $headlineId;
        $this->_articleCount = is_null($articleCount) ? $defaults['_articleCount'] : $articleCount;
        $this->_bookCount = is_null($bookCount) ? $defaults['_bookCount'] : $bookCount;
        $this->_latestArticleCount = is_null($latestArticleCount) ? $defaults['_latestArticleCount'] : $latestArticleCount;
        $this->_amazonLU = is_null($amazonLU) ? $defaults['_amazonLU'] : $amazonLU;
        $this->_admArtCnt = is_null($admArtCnt) ? $defaults['_admArtCnt'] : $admArtCnt;
        $this->_admComCnt = is_null($admComCnt) ? $defaults['_admComCnt'] : $admComCnt;
        $this->_admUserCnt = is_null($admUserCnt) ? $defaults['_admUserCnt'] : $admUserCnt;
        $this->_defemail = is_null($defemail) ? $defaults['_defemail'] : $defemail;
        $this->_created_at = is_null($created_at) ? $defaults['_created_at'] : $created_at;
        $this->_updated_at = is_null($updated_at) ? $defaults['_updated_at'] : $updated_at;
    }
    /** Set valid property to value (not null)
     *
     * @param string $property
     * @param mixed $value
     * @throws Exception for invalid property
     */
    function set($property, $value)
    {
        $property = '_' . $property;
        if (key_exists($property, get_object_vars($this))) {
            if (isset($value)) {
                $this->$property = $value;
            }
            $this->markDirty();
        } else {
            throw new Local_Exceptions_AppException(__METHOD__ . " says there was a call to the (set) method on a non-existent property: [ {$property} ]");
        }
    }
    /** Get valid property value
     *
     * @param string $property
     * @param mixed $value
     * @throws Exception for invalid property
     */
    function get($property)
    {
        $property = '_' . $property;
        if (key_exists($property, get_object_vars($this))) {
            return $this->$property;
        } else {
            throw new Local_Exceptions_AppException(__METHOD__ . "says there was a call to the (get) method on a non-existent property: [ {$property} ]");
        }
    }
}
?>
