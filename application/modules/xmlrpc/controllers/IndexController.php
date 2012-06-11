<?php
class Xmlrpc_IndexController extends Zend_Controller_Action
{
    public function indexAction()
    {
        Zend_XmlRpc_Server_Fault::attachFaultException('Local_Api_Exception');
        // disable layouts and rendering
        $this->_helper->layout->disableLayout();
        $this->getHelper('viewRenderer')->setNoRender(true);
        $server = new Zend_XmlRpc_Server();
        $server->setClass('Local_Api_MetaWeblog', 'metaWeblog');
        $server->setClass('Local_Api_Blogger', 'blogger');
        $server->setClass('Local_Api_Wp', 'wp');
        $response = $server->handle();
        $request = $server->getRequest();
        if (false) {
            $log = new Zend_Log();
            $stream = @fopen(APPLICATION_ROOT . '/logs/xmlrpc.log', 'a');
            if ($stream) {
                $stdWriter = new Zend_Log_Writer_Stream($stream);
                $log->addWriter($stdWriter);
                $log->info("Request:\n$request");
                $log->info("Response:\n$response");
                $log->info("PHPInput:\n" . file_get_contents('php://input'));
            }
        }
        echo $response;
    }
    public function sitemapAction()
    {
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender("true");
        $pages = array();
        // generate the pages array somehow
        // $someservice = new My_Service_PageGenerator();
        $pages = $this->fetchAllMyWebsitePages();
        // generate sitemap xml
        $xml = $this->generateSitemapXml($pages);
        $response = $this->getResponse();
        $response->setHeader('Cache-Control', 'public', true);
        $response->setHeader('Content-Type', 'text/xml', true);
        $response->appendBody($xml);
    }
    private function generateSitemapXml($pages)
    {
        $sitemap = new Zend_View_Helper_Navigation_Sitemap();
        $sitemap->setView($this->view);
        $sitemap->setUseSitemapValidators(true);
        // this messes up A2
        //$sitemap->setUseSchemaValidation(true);
        $sitemap->setFormatOutput(true);
        $sitemap->setMinDepth(0);
        $sitemap->setMaxDepth(0);
        $container = new Zend_Navigation();
        $container->addPages($pages);
        $sitemap->setContainer($container);
        return $sitemap;
    }
    private function fetchAllMyWebsitePages()
    {
        $am = new Local_Domain_Mappers_ArticleMapper();
        $sm = new Local_Domain_Mappers_SectionMapper();
        $mm = new Local_Domain_Mappers_MenuMapper();
        $options['where'] = 'published = 1';
        $options['offset'] = '0';
        $options['limit'] = '20';
        $ac = $am->findAll($options);
        $sc = $sm->findAll($options);
        $options['where'] = 'menu = "main"';
        $mc = $mm->findAll($options);
        $pages = array();
        foreach ($mc as $m) {
            $page = new Zend_Navigation_Page_Uri();
            $page->uri = $m->get('link');
            array_push($pages, $page);
        }
        foreach ($ac as $a) {
            $page = new Zend_Navigation_Page_Uri();
            $page->uri = '/blog/comment?id=' . $a->get('id');
            array_push($pages, $page);
        }
        foreach ($sc as $s) {
            $page = new Zend_Navigation_Page_Uri();
            $page->uri = '/' . strtolower($s->get('section_title'));
            array_push($pages, $page);
        }
        return $pages;
    }
}
