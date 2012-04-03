<?php
/**
 * Action Helper for pagination
 *
 * @uses Zend_Controller_Action_Helper_Abstract
 */
class Action_Helper_Pager extends Zend_Controller_Action_Helper_Abstract
{
  private $paginator;
  private $itemsPerPage;
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
  // Args: $counter: either a mapper or an integer
  //         $items: items per page
  public function pager($counter, $items)
  {
    if ($counter instanceof Local_Domain_Mapper) {
      $mapper = $counter;
      $total_items = $mapper->getCount();
    } else {
      $total_items = $counter;
    }
    $this->itemsPerPage = $items;
    $this->paginator = new Zend_Paginator(new Zend_Paginator_Adapter_Null($total_items));
    $this->paginator->setItemCountPerPage($items);
    return $this->paginator;
  }
  public function getLimit($page)
  {
    $p = $page == 1 ? 0 : $page - 1;
    $offset = $p * $this->itemsPerPage;
    $this->paginator->setCurrentPageNumber($page);
    return array('offset' => $offset, 'items' => $this->itemsPerPage);
  }
  /**
   * Strategy pattern: call helper as broker method
   *
   * @param  string $name
   * @param  array|Zend_Config $options
   * @return Zend_Form
   */
  public function direct($mapper, $items)
  {
    return $this->pager($mapper, $items);
  }
}
