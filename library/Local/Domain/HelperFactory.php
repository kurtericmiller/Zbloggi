<?php
/**
 * Helper Factory Definition
 * @package Domain
 */
/**
 * include Collections interface
 */
require_once ("Interfaces/Collections.php");
/** 
 * Helper class to supply concrete helper classes
 */
class Local_Domain_HelperFactory
{
  /** Return the appropriate finder (mapper) object
   *
   *  @param string $type
   *  @return object $mapper
   */
  static function getFinder($type)
  {
    //Tweak the PEAR path from Models to Mappers
    //Since the directory structure will trip
    //up the mapping to the correct directory
    //for locating the various mapper classes
    $pearSegments = explode('_', $type);
    $pearSegments[2] = "Mappers";
    $tweakedType = implode('_', $pearSegments);
    $mapper = "{$tweakedType}Mapper";
    if (class_exists($mapper)) {
      return new $mapper();
    }
    throw new Local_Exceptions_AppException(__METHOD__ . " says that we have an unknown mapper: $mapper");
  }
  /**
   * Return the appropriate collection object
   *
   * @param string $type
   * @return object $collection
   */
  static function getCollection($type)
  {
    $collection = "{$type}Collection";
    $pearSegments = explode('_', $type);
    $pearSegments[2] = "Mappers";
    $tweakedType = implode('_', $pearSegments);
    $collection = "{$tweakedType}Collection";
    if (class_exists($collection)) {
      return new $collection();
    }
    throw new Local_Exceptions_AppException(__METHOD__ . " says that we have an unknown collection: $collection");
  }
}
?>
