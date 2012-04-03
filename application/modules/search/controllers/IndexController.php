<?php
class Search_IndexController extends Zend_Controller_Action
{
  public function indexAction()
  {
    $form = new Search_Form_Search();
    $this->view->searchForm = $form;
    // get items matching search criteria
    if ($form->isValid($this->getRequest()->getParams())) {
      $input = $form->getValues();
      if (!empty($input['search_text'])) {
        $config = $this->getInvokeArg('bootstrap')->getOption('indexes');
        $index = Zend_Search_Lucene::open($config['indexPath']);
        $results = $index->find(Zend_Search_Lucene_Search_QueryParser::parse($input['search_text']));
        $this->view->results = $results;
      }
    }
  }
}
