<?php
class Rss_IndexController extends Zend_Rest_Controller
{
  private $_apiBaseUrl;
  // disable layouts and rendering
  public function init()
  {
    $this->_apiBaseUrl = 'http://ymozend.com/blog';
    $this->_helper->layout->disableLayout();
    $this->getHelper('viewRenderer')->setNoRender(true);
  }
  public function indexAction()
  {
    // set feed elements
    $output = array('title' => 'Your Moment of Zend articles', 'link' => $this->_apiBaseUrl, 'author' => 'ymozend API/1.0', 'charset' => 'UTF-8', 'entries' => array());
    // get records from database
    $am = new Local_Domain_Mappers_ArticleMapper();
    $options['where'] = 'published = 1';
    $ac = $am->findAll($options);
    // set entry elements
    foreach ($ac as $a) {
      $output['entries'][] = array('title' => $a->get('article_title'), 'link' => $this->_apiBaseUrl . '/comment?id=' . $a->get('id'), 'description' => 'This is an article.', 'content' => $this->view->shortText($a->get('article_text')), 'lastUpdate' => strtotime($a->get('created_at')), 'updated' => strtotime($a->get('updated_at')));
    }
    // import array into atom feed
    // send to client
    $feed = Zend_Feed::importArray($output, 'rss');
    $feed->send();
    exit;
  }
  // forward to indexAction
  public function listAction()
  {
    return $this->_forward('index');
  }
  public function getAction()
  {
    // get entry record from database
    $id = $this->_getParam('id');
    // get records from database
    $am = new Local_Domain_Mappers_ArticleMapper();
    $ac = $am->find($id);
    // if record available
    // set entry elements
    if (count($ac) == 1) {
      // set feed elements
      $output = array('title' => 'YMOZend article for ID: ' . $id, 'link' => $this->_apiBaseUrl . '/comment?id=' . $id, 'author' => 'ymozend API/1.0', 'charset' => 'UTF-8', 'entries' => array());
      // set entry elements
      $output['entries'][0] = array('title' => $ac->get('article_title'), 'link' => $this->_apiBaseUrl . '/comment?id=' . $id, 'description' => 'This is an article.', 'created' => strtotime($ac->get('created_at')), 'updated' => strtotime($ac->get('updated_at')));
      // import array into atom feed
      $feed = Zend_Feed::importArray($output, 'rss');
      Zend_Feed::registerNamespace('ymozend', 'http://ymozend.com');
      // set custom namespaced elements
      $feed->rewind();
      $entry = $feed->current();
      if ($entry) {
        $entry->{'ymozend:id'} = $ac->get('id');
        $entry->{'ymozend:title'} = $ac->get('article_title');
        $entry->{'ymozend:description'} = 'This is an article.';
        $entry->{'ymozend:content'} = $ac->get('article_text');
        $entry->{'ymozend:created'} = strtotime($ac->get('created_at'));
        $entry->{'ymozend:updated'} = strtotime($ac->get('updated_at'));
      }
      // output to client
      $feed->send();
      exit;
    } else {
      $this->getResponse()->setHttpResponseCode(404);
      echo 'Invalid record identifier';
      exit;
    }
  }
  public function postAction()
  {
    // read POST parameters and save to database
    //    $item = new Square_Model_Item;
    //    $item->fromArray($this->getRequest()->getPost());
    //    $item->RecordDate = date('Y-m-d', mktime());
    //    $item->DisplayStatus = 0;
    //    $item->DisplayUntil = null;
    //    $item->save();
    //    $id = $item->RecordID;
    //
    //    // set response code to 201
    //    // send ID of newly-created record
    //    $this->getResponse()->setHttpResponseCode(201);
    //    $this->getResponse()->setHeader('Location', $this->_apiBaseUrl . '/' . $id);
    //    echo $this->_apiBaseUrl . '/' . $id;
    //    exit;
    
  }
  public function putAction()
  {
    // handle PUT requests
    
  }
  public function deleteAction()
  {
    // handle DELETE requests
    
  }
}
