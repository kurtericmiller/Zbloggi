<?php
class Action_Helper_SetArticleReadCount extends Zend_Controller_Action_Helper_Abstract
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
  public function SetArticleReadCount($article_id)
  {
    $ac = new Local_Domain_Mappers_ArticleMapper();
    $a = $ac->find($article_id);
    $a->set('read_count', $a->get('read_count') + 1);
    $ac->update($a);
  }
  public function direct($article_id)
  {
    $this->SetArticleReadCount($article_id);
  }
}
