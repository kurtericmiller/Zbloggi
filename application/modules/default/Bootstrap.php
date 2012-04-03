<?php
class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
  private $options;
  protected function _initOptions()
  {
    $this->options = $this->getOptions();
    Zend_Registry::set('config', $this->getOptions());
  }
  protected function _initActionHelpers()
  {
    Zend_Controller_Action_HelperBroker::addPath('Local/Helpers/Action', 'Action_Helper');
  }
  protected function _initDB()
  {
    $adapter = $this->options['resources']['db']['adapter'];
    $params = $this->options['resources']['db']['params'];
    $db = Zend_Db::factory($adapter, $params);
    Zend_Registry::set('db', $db);
    Zend_Db_Table_Abstract::setDefaultAdapter($db);
  }
  protected function _initLocal()
  {
    $sm = new Local_Domain_Mappers_SettingMapper();
    Zend_Registry::set('local', $sm->find($sm->getMaxId()));
  }
  protected function _initView()
  {
    $localReg = Zend_Registry::get('local');
    $view = new Zend_View();
    $view->doctype('HTML5');
    $view->setEncoding('UTF-8');
    $view->headTitle($localReg->get('site_title'));
    $view->headMeta()->appendHttpEquiv('Content-Type', 'text/html;charset=utf-8');
    $view->headMeta()->appendName('keywords', 'Zend Framework, PHP, Kurt Miller, San Francisco, Bay Area, CA, tutorials, programming');
    $view->headMeta()->appendName('description', 'A site for all things related to Zend Framework, PHP and programming in general');
    $view->headMeta()->appendName('robots', 'index,follow,noodb,noydir');
    $view->headLink()->appendStylesheet('http://fonts.googleapis.com/css?family=Jura:600')->appendStylesheet('/stylesheets/style.css');
    $view->headLink()->appendStylesheet('http://fonts.googleapis.com/css?family=Ubuntu:400')->appendStylesheet('/stylesheets/style.css');
    $view->headLink()->appendStylesheet('http://fonts.googleapis.com/css?family=Pontano+Sans:400')->appendStylesheet('/stylesheets/style.css');
    /*
    $view->headLink()->appendStylesheet('http://fonts.googleapis.com/css?family=Federo:400')->appendStylesheet('/stylesheets/style.css');
    $view->headLink()->appendStylesheet('http://fonts.googleapis.com/css?family=Marmelad:400')->appendStylesheet('/stylesheets/style.css');
    */
    $view->headLink(array('rel' => 'favicon', 'href' => '/favicon.ico', 'type' => 'image/icon'));
    $view->headLink(array('rel' => 'profile', 'href' => 'http://qmpg.org/xfn/11'));
    $view->headLink()->appendAlternate('http://www.ymozend.com/rss/', 'application/rss+xml', 'Your Moment of Zend » Feed');
    //$view->headLink(array(
    //        'rel' => 'canonical',
    //        'href' => 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']));
    $view->headLink(array('rel' => 'canonical', 'href' => 'http://www.ymozend.com/'));
    $view->headLink(array('rel' => 'prev', 'href' => 'http://www.ymozend.com/about/', 'title' => 'About'));
    $view->headLink(array('rel' => 'next', 'href' => 'http://www.ymozend.com/blog/', 'title' => 'Blog'));
    $view->addHelperPath(APPLICATION_ROOT . '/library/Local/Helpers/View', 'View_Helper');
    $view->addScriptPath(APPLICATION_ROOT . '/library/Local/Partials/');
    $viewRenderer = Zend_Controller_Action_HelperBroker::getStaticHelper('ViewRenderer');
    $viewRenderer->setView($view);
    return $view;
  }
  protected function _initForms()
  {
    $defaultForms = Zend_Controller_Action_HelperBroker::getStaticHelper('InitDefaultForms');
    Zend_Controller_Action_HelperBroker::addHelper($defaultForms);
  }
  protected function _initResource()
  {
    $resourceLoader = new Zend_Loader_Autoloader_Resource(array('namespace' => 'Error', 'basePath' => 'modules/error', 'namespace' => 'Auth', 'basePath' => 'modules/auth', 'namespace' => 'Admin', 'basePath' => 'modules/admin', 'namespace' => 'Blog', 'basePath' => 'modules/blog', 'namespace' => 'User', 'basePath' => 'modules/user', 'namespace' => 'Search', 'basePath' => 'modules/search', 'namespace' => 'Xmlrpc', 'basePath' => 'modules/xmlrpc', 'namespace' => 'Rss', 'basePath' => 'modules/rss'));
    return $resourceLoader;
  }
  protected function _initDbProfiler()
  {
    $this->bootstrap('db');
    $profiler = new Local_Db_Profiler();
    $profiler->setEnabled(true);
    Zend_Registry::get('db')->setProfiler($profiler);
  }
  protected function _initDojo()
  {
    // get view resource
    $this->bootstrap('view');
    $view = $this->getResource('view');
    Zend_Dojo::enableView($view);
    // ->setCdnBase(Zend_Dojo::CDN_BASE_GOOGLE)
    $view->dojo()->disable(); //        ->setLocalPath('/javascripts/dojo/dojo/dojo.js') //        ->addStyleSheetModule('dijit.themes.tundra') //        ->setDjConfigOption('parseOnLoad', true) //        ->setDjConfigOption('locale', 'en-US') //        ->setDjConfigOption('isDebug', true)
    //        ->setDjConfigOption('debugAtAllCosts', true);
    
  }
  protected function _initLogger()
  {
    // Create the Zend_Log object
    $logger = new Zend_Log();
    $stream = @fopen(APPLICATION_ROOT . '/logs/app.log', 'a');
    if ($stream) {
      $stdWriter = new Zend_Log_Writer_Stream($stream);
      $stdWriter->addFilter(Zend_Log::DEBUG);
      $stdWriter->addFilter(Zend_Log::INFO);
      $logger->addWriter($stdWriter);
    }
    // Create the Firebug writer - Development only
    if ($this->_application->getEnvironment() != 'production') {
      $writer = new Zend_Log_Writer_Firebug();
      $logger->addWriter($writer);
    }
    $logger = Zend_Registry::set('logger', $logger);
    return $logger;
  }
  protected function _initPlugins()
  {
    $objFront = Zend_Controller_Front::getInstance();
    $objFront->registerPlugin(new Local_Plugin_ErrorHandler(), 1);
    $objFront->registerPlugin(new Local_Plugin_ACL(), 2);
    $objFront->registerPlugin(new Local_Plugin_ModuleLayout(), 3);
    $objFront = Zend_Controller_Front::getInstance();
    return $objFront;
  }
  protected function _initRouting()
  {
    $router = Zend_Controller_Front::getInstance()->getRouter();
    $router->addRoute('faq', new Zend_Controller_Router_Route('/faq', array('module' => 'default', 'controller' => 'index', 'action' => 'faq')));
    $router->addRoute('credits', new Zend_Controller_Router_Route('/credits', array('module' => 'default', 'controller' => 'index', 'action' => 'credits')));
    $router->addRoute('about', new Zend_Controller_Router_Route('/about', array('module' => 'default', 'controller' => 'index', 'action' => 'about')));
    $router->addRoute('privacy', new Zend_Controller_Router_Route('/privacy', array('module' => 'default', 'controller' => 'index', 'action' => 'privacy')));
    $router->addRoute('terms', new Zend_Controller_Router_Route('/terms', array('module' => 'default', 'controller' => 'index', 'action' => 'terms')));
    $router->addRoute('books', new Zend_Controller_Router_Route('/books', array('module' => 'default', 'controller' => 'index', 'action' => 'books')));
    $router->addRoute('help', new Zend_Controller_Router_Route('/help', array('module' => 'default', 'controller' => 'index', 'action' => 'help')));
    $router->addRoute('tag', new Zend_Controller_Router_Route('/blog/tag', array('module' => 'blog', 'controller' => 'index', 'action' => 'tag')));
    $router->addRoute('author', new Zend_Controller_Router_Route('/blog/author', array('module' => 'blog', 'controller' => 'index', 'action' => 'author')));
    $router->addRoute('profile', new Zend_Controller_Router_Route('/profile/:user', array('module' => 'default', 'controller' => 'index', 'action' => 'profile')));
    $router->addRoute('sitemap', new Zend_Controller_Router_Route('/sitemap.xml', array('module' => 'xmlrpc', 'controller' => 'index', 'action' => 'sitemap')));
  }
}
