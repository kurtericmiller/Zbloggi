<?php
/**
 * Action Helper for generating random strings
 *
 * @uses Zend_Controller_Action_Helper_Abstract
 */
class Action_Helper_RandString extends Zend_Controller_Action_Helper_Abstract
{
  /**
   * @var Zend_Loader_PluginLoader
   */
  public $pluginLoader;
  /**
   * Constructor: initialize plugin loader
   *
   * @return void
   */
  public function __construct()
  {
    $this->pluginLoader = new Zend_Loader_PluginLoader();
  }
  /**
   * Generate random string
   *
   * @param  int $length
   * @param  bool $numbers
   * @param  bool $upper
   * @return string
   */
  public function rand_string($length = 8, $numbers = true, $upper = true)
  {
    if (1 > $length) $length = 8;
    $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $numChars = 62;
    if (!$numbers) {
      $numChars = 52;
      $chars = substr($chars, 10, $numChars);
    }
    if (!$upper) {
      $numChars-= 26;
      $chars = substr($chars, 0, $numChars);
    }
    $string = '';
    for ($i = 0; $i < $length; $i++) {
      $string.= $chars[mt_rand(0, $numChars - 1) ];
    }
    return $string;
  }
  /**
   * Strategy pattern: call helper as broker method
   *
   * @param  int $length
   * @param  bool $numbers
   * @param  bool $upper
   * @return string
   */
  public function direct($length = 8, $numbers = true, $upper = true)
  {
    return $this->rand_string($length, $numbers, $upper);
  }
}
