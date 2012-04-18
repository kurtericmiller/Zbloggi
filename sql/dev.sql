
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


DROP TABLE IF EXISTS `articles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `read_count` int(11) NOT NULL DEFAULT '0',
  `article_title` varchar(150) NOT NULL,
  `article_text` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;


LOCK TABLES `articles` WRITE;
/*!40000 ALTER TABLE `articles` DISABLE KEYS */;
INSERT INTO `articles` VALUES (33,14,1,225,'FlashMessenger Namespacing with Multiple Forms','<p><img style=\"float: left; margin: 10px;\" src=\"http://framework.zend.com/images/logo_small.gif\" alt=\"Zend, baby!\" width=\"123\" height=\"23\" />I ran into the situation where I had two forms on a page, each of which needed to have some FlashMessenger feedback. Unfortunately, even though I changed each of the view variable names to use for assigning the messages to, each of them made the same call to the getMessages() method so whatever message was in queue would display in both places.</p>\r\n<p>Not what I was looking for. But don\'t despair, FlashMessenger namespacing comes to the rescue.</p>\r\n<p><!--more--></p>\r\n<p>In my controller I previously used the following:</p>\r\n<pre class=\"brush: php\">$this-&gt;_helper-&gt;getHelper(\'FlashMessenger\')-&gt;addMessage(\'Some message.\');</pre>\r\n<p>and then sent it to the view thusly:</p>\r\n<pre class=\"brush: php\">$this-&gt;view-&gt;messages = $this-&gt;_helper-&gt;getHelper(\'FlashMessenger\')-&gt;getMessages();</pre>\r\n<p>Partitioning the messages into their own namespace turns out to be ridiculously easy.</p>\r\n<pre class=\"brush: php\">$flasher = $this-&gt;_helper-&gt;getHelper(\'FlashMessenger\');\r\n$flasher-&gt;setNameSpace(\'config\');\r\n$flasher-&gt;addMessage(\'Some message.\');</pre>\r\n<p>and</p>\r\n<pre class=\"brush: php\">$this-&gt;view-&gt;messages = $flasher-&gt;getMessages();</pre>\r\n<p>Short and sweet.</p>','2012-03-09 20:28:33','2012-03-19 18:48:07'),(35,14,1,119,'And So It Begins','<p><a title=\"Your Moment of Zend\" href=\"/images/uploads/zendgarden.jpg\"><img style=\"float: left; margin: 7px;\" src=\"/images/uploads/zendgardenSM.jpg\" alt=\"Your Moment of Zend\" /></a></p>\r\n<h3><em>\"What is this \'moment of Zend\' of which you speak?\"</em></h3>\r\n<p>I\'m glad you asked.</p>\r\n<p>Hi, I\'m User1, one of the co-conspirators bringing you YMOZ. Since this is my maiden post I\'ll try to be gentle and not end up sending you screaming for your mama with vows of complete Zend abstinence spilling from you lips.</p>\r\n<p>Yeah, that\'s right, it\'s not one of those Zend sites where all is praise and drooling sycophancy over the merits and virtues of the <a title=\"Zend Framework\" href=\"http://framework.zend.com/\" target=\"_blank\">Zend Framework</a> and why all roads begin, end and circumambulate at the PHP Mecca that is ZF. No, not one of those sites at all.</p><p><!--more--></p><p>Don\'t get me wrong, this entire site was built using ZF. And while the site has perhaps&nbsp;more than it\'s fair share of wonkiness that can hardly be laid at the feet of the ZF team. No, the PHP programming world is much better off with it than without it. But it\'s definitely a two-edged sword, like a fine piece of equipment you bring home from the hardware store that has \"some assembly required\" only to find out the instructions are in Swazi. Powerful, yes, but not without its warts and unprotected sharp edges. \'Caveat scriptor\' as the bard always says.</p>\r\n<p>Which brings us back to \'Your Moment of Zend,\' a site we hope will give you a chance to learn, comment, vent, contribute and generally become more enlightened regarding that 500 pound gorilla browbeating the other simians in the PHP pool.</p>\r\n<p>So, I\'ll take you gently on the nickle tour and talk about what YMOZ is, what you can expect and where we hope to be headed if things go well. (I know, that\'s why I said \'hope\'.)</p>\r\n<h3>That YMOZ thingy</h3>\r\n<p>YMOZ is actually several things at once: a blog (hopefully obviously) first and foremost, but to us it\'s also a calling card, a proof of concept, a marketing device, a sandbox, a workshop, a place to give back to the community and various and sundry other things that I\'ll refrain from boring you with. Just let it be said that its purpose is manifold.</p>\r\n<p>Pretty ambitious for a venue (blogs) that\'s supposed to be dead, eh?</p>\r\n<h3>Setting Expectations</h3>\r\n<p>That\'s what it is to us. What you can expect of YMOZ, hopefully, is a place where you can share your love/hate relationship with the platform we\'ve all come to know and love, Zend Framework. We\'ll be posting rants (when deemed justified,) insights that we\'ve picked up putting this beasty together, links to other helpful sites and articles, and other germane items that strike our fancy as time permits.</p>\r\n<p>You have to register to comment but it\'s fairly painless (and besides, we needed to show we knew how to do the \'captcha\' thing, as vilified as the practice is, and to get an email response process working.) Comments are moderated at this point but we\'ve got Akismet turned up pretty high so that could change in a heartbeat. If you\'d like to submit articles or become an author just let us know. No&nbsp;guarantees&nbsp;but if it\'s just us the output will be pretty meager so contributors are welcome.</p>\r\n<h3>Welcome To The Future (now go home)</h3>\r\n<p>THE SITE WILL CHANGE! YMOZ is not for the faint of heart. Things will get added, other things will go away, links will magically appear while pages will mysteriously disappear. This is a working site so don\'t get too comfy. And if shit breaks hopefully it won\'t be the contact form and you can send us nasty-grams.</p>\r\n<p>The future will bring things like the site code being available on <a title=\"github\" href=\"https://github.com/kurtericmiller\" target=\"_blank\">github.com</a>. Not sure when but it should be soon and we\'ll let you know when it is. Then you can really plow into us. Fun, neh?</p>\r\n<p>As the more observant amongst you will have noticed the site can generously be described as being unencumbered with an overabundance of JavaScript. That\'s a direct result of the good old design paradigm of HTML, CSS, JavaScript, in that order. The first two are fairly well covered while the latter is on a back burner but it\'s creeping up even as you read this.</p>\r\n<p>And not to be left in the digital dust, design ruminations on how to make the site available in the mobile realm are already stirring in our febrile minds.</p>\r\n<h3>This Way To See The Mighty Egress</h3>\r\n<p>Meanwhile, click around, read a good book (available on our handy <a title=\"Store\" href=\"/store\">Store</a> page,) and let us know what you think.</p>','2012-03-09 20:25:33','2012-03-19 18:48:07'),(36,14,1,63,'Zend Bootstrap PhpUnit Testing Errors','<p><a title=\"Sisyphus\" href=\"http://en.wikipedia.org/wiki/Sisyphus\" target=\"_blank\"><img style=\"float: left;\" src=\"/images/uploads/sysiphus.png\" alt=\"Sisyphus Ahead\" /></a></p>\r\n<h3>An Uphill Battle</h3>\r\n<p>Granted, I\'m new to Zend Framework, PHP and PHPUnit but, really, does it have to be such a grind to discover the solutions to what seem like fundamental problems? If you\'ve encountered similar problems and know of slicker solutions please don\'t hesitate to comment. I can always use the help.</p>\r\n<p>In my case it was missing default routes and the bootstrap parameter not getting set in the front controller, both, I suspect, artifacts from <span style=\"font-family: monospace;\">$aplication-&gt;bootstrap()-&gt;run()</span> not being run but that\'s just a guess on my part. More informed opinions are welcome.</p>\r\n<p>Read on for information on how we got around these annoying errors.</p>\r\n<p><!--more--></p>\r\n<h3>No Bootstrap? How Can It Be?</h3>\r\n<p>This one was a real head-scratcher. The test was for a controller plugin that made the following call:</p>\r\n<pre>$front = Zend_Controller_Front::getInstance();<br />$layout = $front-&gt;getParam(\'bootstrap\')-&gt;getResource(\'layout\');</pre>\r\n<p>When the test runs it completely craps out with \"Fatal error: Call to a member function getResource() on a non-object in ...\" and points right to the $layout assignment above. It took a considerable amount of sleuthage to determine the problem was that, in fact, the frontcontroller\'s \'bootstrap\' parameter was not being set at any time during the test run. What?</p>\r\n<p>To me this was like telling a 4-year-old that Santa Claus was a complete fabrication, a mere fantasy, a phantasm, a pernicious plot perpetrated by parents to practice mind control on 4-year-olds. Disturbing, to say the least. I thought that \'bootstrap\' was intrinsic to the frontcontroller. Not in the least as it turns out.</p>\r\n<p>To cut to the chase, I ended up adding it manually in the setUp() function.</p>\r\n<pre class=\"brush: php\">    public function setUp()\r\n    {\r\n        $this-&gt;bootstrap = new Zend_Application(\r\n            APPLICATION_ENV, \r\n            APPLICATION_PATH . \'/configs/application.ini\');\r\n        parent::setUp();\r\n        $frontController = $this-&gt;getFrontController();\r\n        $frontController\r\n            -&gt;setParam(\'bootstrap\', $this\r\n            -&gt;bootstrap\r\n            -&gt;getBootstrap());\r\n    }\r\n</pre>\r\n<p>(You\'ll notice no callback function in the $this-&gt;boostrap assignment, a la the <a title=\"Zend Framework Testing Documentation\" href=\"http://framework.zend.com/manual/en/zend.test.phpunit.html\" target=\"_blank\">Zend Framework documentation</a>. I think that unless you have something specific you want to accomplish you should just keep it simple and the above seems pretty straight forward.)</p>\r\n<p>This did the trick but if you know of a more elegant solution please leave it in the comments.</p>\r\n<h3>Those Pesky Missing Default Routes</h3>\r\n<p>Something that might catch you unawares (it certainly did me) is the fact that default routes don\'t seem to load in the normal course of PHPUnit testing. I started receiving the following error and had a really enlightening time figuring out what the hell was going on:</p>\r\n<ul>\r\n<li>\"Zend_Controller_Router_Exception: Route default is not defined\"</li>\r\n</ul>\r\n<p>No default routes getting loaded? Yet another precious preconceived notion getting smashed upon the cruel rocks of empirical data. One more addition to our friendly setUp() method resolved things for me.</p>\r\n<pre class=\"brush: php\">    public function setUp()\r\n    {\r\n        $this-&gt;bootstrap = new Zend_Application(\r\n            APPLICATION_ENV, \r\n            APPLICATION_PATH . \'/configs/application.ini\');\r\n        parent::setUp();\r\n        $frontController = $this-&gt;getFrontController();\r\n        $frontController\r\n            -&gt;setParam(\'bootstrap\', $this\r\n            -&gt;bootstrap\r\n            -&gt;getBootstrap());\r\n        $router = $frontController-&gt;getRouter();\r\n        $router-&gt;addDefaultRoutes();\r\n    }\r\n</pre>\r\n<p>The above is strung out over several lines for clarity\'s sake and of course can be strung into one, long, indecipherable call depending on your needs.</p>\r\n<h3>Is There A Better Way?</h3>\r\n<p>These fixes work for me. Just FYI, as far as I can tell these need to be added after the parent::setup() call. YMMV.</p>\r\n<p>Is there a better way? I\'m sure there is. We\'re talking about PHP 5+ here where there\'s 10 ways to do everything. As I said if you want to pitch in your 2&cent; feel free to do so at length in the comments.</p>','2012-03-11 18:29:06','2012-03-19 18:48:07'),(40,14,1,19,'How To: Zend, XMLRPC and metaWeblog - Part 2','<p><img style=\"vertical-align: middle; margin: 5px;\" src=\"/images/uploads/metaWeblog.JPG\" alt=\"metaWeblog API\" /></p>\r\n<h3>A metaWeblog API class</h3>\r\n<p>This is part two of a three part series on putting together an XMLRPC remote blogging server. In part one we covered the factors leading up to selecting the metaWeblog API for implementation and laid the groundwork for building a Zend XMLRPC server and testing client. It\'s recommended that you give the first part, <a title=\"Zend, XmlRpc and metaWeblog - Part 1\" href=\"http://ymozend.com/blog/comment?id=39\" target=\"_blank\">How To: Zend, XMLRPC and metaWeblog - Part 1</a>, the once over before continuing further in this article.</p>\r\n<p>All caught up? Let\'s dig in.<!--more--></p>\r\n<h3>Anatomy of a blogging API</h3>\r\n<p>Though \"finalized\" several years ago, the spec for the metaWeblog API has been liberally bent, pushed, prodded and generally abused by whomever decided to use it and decided it didn\'t quite come up to snuff, vis-a-vis, their current requirements for a remote blogging service API.</p>\r\n<p>Originally it was meant as an adjuct to Blogger\'s rather paltry methods. It has three entry point methods and three helper methods.</p>\r\n<p>The original Blogger methods (which any well heeled metaWeblog API seems required to implement though that is never specifically stated that I can find) are:</p>\r\n<ul>\r\n<li>blogger.deletePost</li>\r\n<li>blogger.getUserInfo</li>\r\n<li>blogger.getUsersBlogs</li>\r\n</ul>\r\n<p>The entry point methods are:</p>\r\n<ul>\r\n<li>metaWeblog.newPost</li>\r\n<li>metaWeblog.editPost</li>\r\n<li>metaWeblog.getPost</li>\r\n</ul>\r\n<p>The helpers are:</p>\r\n<ul>\r\n<li>metaWeblog.newMediaObject</li>\r\n<li>metaWeblog.getCategories</li>\r\n<li>metaWeblog.getRecentPosts</li>\r\n</ul>\r\n<p>During my Google-due-diligence I found <a title=\"MSDN metaWeblog API definition\" href=\"http://blogs.msdn.com/metablog.ashx\" target=\"_blank\">this site</a> which implies that a specific WordPress method should also be included in your server:</p>\r\n<ul>\r\n<li>wp.getTags</li>\r\n</ul>\r\n<p>There may be other methods that clients expect to be present in a well rounded metaWeblog API but most of them are shy about exposing their expectations and the above methods were all I could dig up. If you know of others feel free to discuss them in the comments.</p>\r\n<p>Enough foreplay. Let\'s code.</p>\r\n<h3>An XMLRPC Server Update</h3>\r\n<p>FYI - A great source for overall PHP/XMLRPC goodness is the <a title=\"XML-RPC for PHP\" href=\"http://phpxmlrpc.sourceforge.net/\" target=\"_blank\">XML-RPC for PHP</a> project on SourceForge. It\'s only focused on the XMLRPC side of the equation but can be quite informative when you seem to be banging your head on some strange responses coming from either the client or server sides.</p>\r\n<p>You\'ll notice that each of the methods listed above are prefaced with their API name. This is basic namespacing and the Zend XMLRPC server handles this beautifully.</p>\r\n<p>If you recall from <a title=\"Zend, XmlRpc and metaWeblog - Part 1\" href=\"http://ymozend.com/blog/comment?id=39\" target=\"_blank\">Part 1</a>, we loaded the server instance with a processing class called \"Local_Api_MetaWeblog\" which we assigned the namespace \"metaWeblog\" to. Now, when requests are received, which are always prefaced with a namespace, we\'re assured that the right processing class is handling the request. As you can see above there are actually three different namespaces being referenced in the metaWeblog API: blogger, metaWeblog and wp. In the application I\'ve created three different classes to handle these requests and updated the server \'setClass\' calls to load them. Here\'s the new XMLRPC server code:</p>\r\n<pre class=\"brush: php\">&lt;?php\r\nclass Xmlrpc_IndexController extends Zend_Controller_Action\r\n{\r\n    public function indexAction()\r\n    {\r\n        // custom exception handling\r\n        Zend_XmlRpc_Server_Fault::attachFaultException(\'Local_Api_Exception\');\r\n\r\n        // disable layouts and rendering\r\n        $this-&gt;_helper-&gt;layout-&gt;disableLayout();\r\n        $this-&gt;getHelper(\'viewRenderer\')-&gt;setNoRender(true);\r\n\r\n        // setup the server\r\n        $server = new Zend_XmlRpc_Server();\r\n        $server-&gt;setClass(\'Local_Api_MetaWeblog\', \'metaWeblog\');\r\n        $server-&gt;setClass(\'Local_Api_Blogger\', \'blogger\');\r\n        $server-&gt;setClass(\'Local_Api_Wp\', \'wp\');\r\n\r\n        // spit out the output\r\n        echo $server-&gt;handle();\r\n    }\r\n}</pre>\r\n<p>As long as I was here I also added the code for handling custom exceptions. The class, \"Local_Api_Exception,\" will be listed below.</p>\r\n<p>And with that we\'re ready for the APIs.</p>\r\n<h3>XMLRPC APIs, Zend Style</h3>\r\n<p>Pay careful attention to the Conventions section of the <a title=\"Zend XMLRPC Server docs\" href=\"http://framework.zend.com/manual/1.11/en/zend.xmlrpc.server.html#zend.xmlrpc.server.conventions\" target=\"_blank\">Zend XmlRpc Server documentation</a>.&nbsp;The part about hinting in docblocks is critical and will mess you up if you don\'t adhere to the guidelines. You\'ll see docblocks included in the following code. Just refer to the documentation if you have questions about what it all means.</p>\r\n<h4>Local_Api_MetaWeblog</h4>\r\n<p>Our API classes are all defined under APPLICATION_ROOT/library/Local/Api in the files, MetaWeblog.php, Blogger.php and Wp.php. We\'ll start with MetaWeblog.php.</p>\r\n<p>Every method call includes a user name and password for authentication so the first thing I created was a private log-in function to handle this routine task. I\'ll include mine here but implement yours to suit your needs.</p>\r\n<pre class=\"brush: php\">&lt;?php\r\nclass Local_Api_MetaWeblog\r\n{\r\n  protected $_user;\r\n  /**\r\n   * This is the function login\r\n   *\r\n   * @param string $username\r\n   * @param string $password\r\n   * @return boolean\r\n   */\r\n  private function login($username, $password)\r\n  {\r\n    $dbAdapter = Zend_Db_Table::getDefaultAdapter();\r\n    $adapter = new Zend_Auth_Adapter_DbTable($dbAdapter);\r\n    $opts = Zend_Registry::getInstance();\r\n    $salt = $opts[\'config\'][\'salt\'];\r\n    $adapter-&gt;setTableName(\'users\')-&gt;setIdentityColumn(\'email\')-&gt;setCredentialColumn(\'password\')-&gt;setCredentialTreatment(\"SHA1(CONCAT(?,\'\" . $salt . \"\'))\");\r\n    $adapter-&gt;setIdentity($username);\r\n    $adapter-&gt;setCredential($password);\r\n    $auth = Zend_Auth::getInstance();\r\n    $result = $auth-&gt;authenticate($adapter);\r\n    if ($result-&gt;isValid()) {\r\n      $user = $adapter-&gt;getResultRowObject();\r\n      $this-&gt;_user = $user;\r\n      return true;\r\n    } else {\r\n      throw new Local_Api_Exception(\'Authorization failed\', 401);\r\n    }\r\n  }\r\n  /**\r\n   * This is the metaWeblog function test\r\n   *\r\n   * @return boolean\r\n   */\r\n  public function test()\r\n  {\r\n    return true;\r\n  }\r\n}</pre>\r\n<p>A few things to notice here. Even though the login function is private I\'ve still included the docblock with hinting just the same as any other public function. The method introspection is handled by the Zend Reflection class and that thing can dig pretty deep. Better safe than sorry in my book. You can also see that if authentication turns out to be invalid the else side of the if test throws a new exception called Local_Api_Exception. I\'ll be showing how to implement this later in this article.</p>\r\n<p>If the authentication is valid then the protected local variable, $_user, gets set so that various properties, such as name and role, can be accessed in the call methods. Since our ACL setup is based on routing we need this info to see if specific users can edit particular posts and such.</p>\r\n<p>The last item is the public function, test(). All it does is return true but is a handy way to see if your server is talking at all.</p>\r\n<p>Next I\'ll go through the metaWeblog.getRecentPosts method since it has most of the elements one needs to deal with in the other methods.</p>\r\n<pre class=\"brush: php\">  /**\r\n   * This is the metaWeblog function getRecentPosts\r\n   *\r\n   * @param string $blogid\r\n   * @param string $username\r\n   * @param string $password\r\n   * @param integer $numberOfPosts\r\n   * @return array of struct Post\r\n   */\r\n  public function getRecentPosts($blogid, $username, $password, $numberOfPosts)\r\n  {\r\n    $posts = array();\r\n    if (!$this-&gt;login($username, $password)) {\r\n      return $posts;\r\n    }\r\n    switch ($this-&gt;_user-&gt;role) {\r\n    case (\"author\"):\r\n      $where = \"user_id = \" . $this-&gt;_user-&gt;id;\r\n      break;\r\n\r\n    case (\"admin\"):\r\n      $where = \"id &gt; 0\";\r\n      break;\r\n\r\n    default:\r\n      throw new Local_Api_Exception(\'Bad permissions for request\', 401);\r\n      return $posts;\r\n    }\r\n    $am = new Local_Domain_Mappers_ArticleMapper();\r\n    $options[\'where\'] = $where;\r\n    $options[\'sort\'] = \'created_at desc\';\r\n    $options[\'offset\'] = \'0\';\r\n    $options[\'count\'] = $numberOfPosts;\r\n    $ac = $am-&gt;findAll($options);\r\n    foreach ($ac as $a) {\r\n      $ct = strtotime($a-&gt;get(\'created_at\'));\r\n      $xdt = new Zend_XmlRpc_Value_DateTime($ct);\r\n      $post = array(\r\n             \'dateCreated\' =&gt; $xdt, \r\n             \'title\' =&gt; $a-&gt;get(\'article_title\'), \r\n             \'description\' =&gt; $a-&gt;get(\'article_text\'), \r\n             \'categories\' =&gt; $am-&gt;getKeywords($a), \r\n             \'userid\' =&gt; $a-&gt;get(\'user_id\'), \r\n             \'postid\' =&gt; $a-&gt;get(\'id\'));\r\n      $result[] = $post;\r\n    }\r\n    return $result;\r\n  }\r\n</pre>\r\n<p>Here\'s the run down:</p>\r\n<p>docblock with parameter and return value hinting. Check.</p>\r\n<p>Authenticate request. Since an exception is thrown if it fails the \"return $posts;\" is&nbsp;superfluous.</p>\r\n<p>The \'switch\' checks the user\'s role to set the where clause for the upcoming database select or reject the request if the role is not of a sufficient level.</p>\r\n<p>Setting up for the retrieval of the requested posts. (Very ZBloggi specific; just posit that by the time you get to the \'foreach\' your data set is ready to go)</p>\r\n<p>Now here\'s a tricky bit. In the \'foreach\' loop you\'ll see some date&nbsp;shenanigans. First, the date as retrieved from the MySQL database needs to be converted to a PHP datetime type using \'strtotime()\' since MySQL stores the data as a string. Next is where it gets interesting. XMLRPC knows nothing of PHP datetime types and needs to have datetimes cast specifically to the XMLRPC datetime type \'dateTime.iso8601\' even though it\'s actually just a string. But try passing just the formatted string and you\'ll see just how snarky XMLRPC can be about typing. Well, thanks to Zend, that\'s not a problem. The call to \'new Zend_XmlRpc_Value_DateTime()\' does the cast and insures that the field is properly typed in the response body. This same process can be used on any of the data types that don\'t map directly from PHP. You can find out more about the Zend_XmlRpc_Value objects in the <a title=\"Xend XMLRPC Client docs\" href=\"http://framework.zend.com/manual/1.11/en/zend.xmlrpc.client.html#zend.xmlrpc.value.parameters\" target=\"_blank\">Zend_XmlRpc_Client</a> documentation.</p>\r\n<p>Once the data is properly massaged it\'s a simple matter of using \'return\' to send it on its way. But be careful, determining the proper way to paste all the data together when you need to return an array of structures with internal arrays can be daunting. This is where the documentation tends to become vendor specific and seeing rock-solid examples is perhaps the best solution.</p>\r\n<p>Here are the rest of the metaWeblog methods.</p>\r\n<pre class=\"brush: php\">  /** This is the metaWeblog function getPost\r\n   *\r\n   * @param string $postid\r\n   * @param string $username\r\n   * @param string $password\r\n   * @return struct Post\r\n   */\r\n  public function getPost($postid, $username, $password)\r\n  {\r\n    $post = array();\r\n    if (!$this-&gt;login($username, $password)) {\r\n      return $post;\r\n    }\r\n    switch ($this-&gt;_user-&gt;role) {\r\n    case (\"author\"):\r\n      $where = \"user_id = \" . $this-&gt;_user-&gt;id . \" and id = \" . $postid;\r\n      break;\r\n\r\n    case (\"admin\"):\r\n      $where = \"id = \" . $postid;\r\n      break;\r\n\r\n    default:\r\n      throw new Local_Api_Exception(\'Bad permissions for request\', 401);\r\n      return $post;\r\n    }\r\n    $am = new Local_Domain_Mappers_ArticleMapper();\r\n    $ac = $am-&gt;findAll($options);\r\n    // if record available\r\n    // set entry elements\r\n    foreach ($ac as $a) {\r\n      $ct = strtotime($a-&gt;get(\'created_at\'));\r\n      $xdt = new Zend_XmlRpc_Value_DateTime($ct);\r\n      $post = array(\'dateCreated\' =&gt; $xdt, \'title\' =&gt; $a-&gt;get(\'article_title\'), \'description\' =&gt; $a-&gt;get(\'article_text\'), \'categories\' =&gt; $am-&gt;getKeywords($a), \'userid\' =&gt; $a-&gt;get(\'user_id\'), \'postid\' =&gt; $a-&gt;get(\'id\'));\r\n    }\r\n    $result[\'struct\'][] = $post;\r\n    return $result;\r\n  }\r\n  /**\r\n   * This is the metaWeblog function newPost\r\n   *\r\n   * @param string $blogid\r\n   * @param string $username\r\n   * @param string $password\r\n   * @param struct $content\r\n   * @param boolean $publish\r\n   * @return string postId\r\n   */\r\n  public function newPost($blogid, $username, $password, $content, $publish)\r\n  {\r\n    $article_id = \'\';\r\n    if (!$this-&gt;login($username, $password)) {\r\n      return $article_id;\r\n    }\r\n    switch ($this-&gt;_user-&gt;role) {\r\n    case (\"author\"):\r\n      $pub = 0;\r\n      break;\r\n\r\n    case (\"admin\"):\r\n      $pub = $publish;\r\n      break;\r\n\r\n    default:\r\n      throw new Local_Api_Exception(\'Bad permissions for request\', 401);\r\n      return $article_id;\r\n    }\r\n    $article = new Local_Domain_Models_Article();\r\n    $article-&gt;set(\'article_title\', $content[\'title\']);\r\n    $article-&gt;set(\'article_text\', $content[\'description\']);\r\n    $article-&gt;set(\'user_id\', $this-&gt;_user-&gt;id);\r\n    $article-&gt;set(\'published\', $pub);\r\n    $article-&gt;finder()-&gt;insert($article);\r\n    $article_id = $article-&gt;getLastId();\r\n    $keywords = \'\';\r\n    while (count($content[\'categories\']) &gt; 0) {\r\n      $word = array_pop($content[\'categories\']);\r\n      $keywords = $word . \' \' . $keywords;\r\n    }\r\n    $km = new Local_Domain_Mappers_KeywordMapper();\r\n    $km-&gt;addKeywords($article_id, explode(\' \', $keywords));\r\n    return $article_id;\r\n  }\r\n  /**\r\n   * This is the metaWeblog function editPost\r\n   *\r\n   * @param string $postid\r\n   * @param string $username\r\n   * @param string $password\r\n   * @param struct $content\r\n   * @param boolean $publish\r\n   * @return boolean\r\n   */\r\n  public function editPost($postid, $username, $password, $content, $publish)\r\n  {\r\n    $result = true;\r\n    if (!$this-&gt;login($username, $password)) {\r\n      return $result;\r\n    }\r\n    if ($this-&gt;_user-&gt;role === \"author\" &amp;&amp; $this-&gt;_user-&gt;id != $content[\'userid\']) {\r\n      throw new Local_Api_Exception(\'Bad permissions for request\', 401);\r\n      return $result;\r\n    }\r\n    switch ($this-&gt;_user-&gt;role) {\r\n    case (\"author\"):\r\n    case (\"admin\"):\r\n      $pub = $publish;\r\n      break;\r\n\r\n    default:\r\n      throw new Local_Api_Exception(\'Bad permissions for request\', 401);\r\n      return $result;\r\n    }\r\n    $am = new Local_Domain_Mappers_ArticleMapper();\r\n    $article = $am-&gt;find($postid);\r\n    $article-&gt;set(\'article_title\', $content[\'title\']);\r\n    $article-&gt;set(\'article_text\', $content[\'description\']);\r\n    $article-&gt;set(\'user_id\', $content[\'userid\']);\r\n    $article-&gt;set(\'published\', $pub);\r\n    $article-&gt;finder()-&gt;update($article);\r\n    $km = new Local_Domain_Mappers_KeywordMapper();\r\n    $km-&gt;addKeywords($article-&gt;getId(), explode(\' \', $content[\'categories\']));\r\n    return $result;\r\n  }\r\n  /**\r\n   * This is the metaWeblog function getCategories\r\n   *\r\n   * @param string $blogid\r\n   * @param string $username\r\n   * @param string $password\r\n   * @return array of struct\r\n   */\r\n  public function getCategories($blogid, $username, $password)\r\n  {\r\n    $categories = array();\r\n    if (!$this-&gt;login($username, $password)) {\r\n      return $categories;\r\n    }\r\n    $km = new Local_Domain_Mappers_KeywordMapper();\r\n    $kc = $km-&gt;findAll();\r\n    foreach ($kc as $k) {\r\n      $category = array(\'title\' =&gt; $k-&gt;get(\'keyword\'), \'description\' =&gt; $k-&gt;get(\'keyword\'), \'htmlUrl\' =&gt; \'http://ymozend.com/blog/tag?tag=\' . $k-&gt;get(\'keyword\'), \'rssUrl\' =&gt; \'\', \'categoryName\' =&gt; $k-&gt;get(\'keyword\'), \'categoryId\' =&gt; $k-&gt;get(\'id\'));\r\n      $categories[] = $category;\r\n    }\r\n    return $categories;\r\n  }\r\n  /**\r\n   * This is the metaWeblog function newMediaObject\r\n   *\r\n   * @param string $blogid\r\n   * @param string $username\r\n   * @param string $password\r\n   * @param struct $mObj\r\n   * @return struct\r\n   */\r\n  public function newMediaObject($blogid, $username, $password, $mo)\r\n  {\r\n    if (!$this-&gt;login($username, $password)) {\r\n      return $mediaObjectInfo = array(\'url\' =&gt; \'blank\');\r\n    }\r\n    $good_types = array(\'image/jpeg\', \'image/gif\', \'image/png\');\r\n    $upload_dest = $_SERVER[\'DOCUMENT_ROOT\'] . \'/images/uploads\';\r\n    $file_name = $mo[\'name\'];\r\n    $file_type = $mo[\'type\'];\r\n    $file_content = $mo[\'bits\'];\r\n    $upload_file = $upload_dest . \'/\' . $file_name;\r\n    while (file_exists($upload_file)) {\r\n      $file_name = substr(sha1(rand()), 0, 5) . $file_name;\r\n      $upload_file = $upload_dest . \'/\' . $file_name;\r\n    }\r\n    if (in_array($file_type, $good_types)) {\r\n      $handle = fopen($upload_file, \'wb\');\r\n      stream_filter_append($fp, \'convert.base64-decode\');\r\n      fwrite($handle, $file_content);\r\n      fclose($handle);\r\n      $mediaObjectInfo = array(\'url\' =&gt; \'http://\' . $_SERVER[\'SERVER_NAME\'] . \'/images/uploads/\' . $file_name);\r\n    } else {\r\n      throw new Local_Api_Exception(\'Bad file type, jpeg/gif/png only\', 415);\r\n      return $mediaObjectInfo = array(\'url\' =&gt; \'problem_writing\');\r\n    }\r\n    return $mediaObjectInfo;\r\n  }\r\n</pre>\r\n<p>The last one, metaWeblog.newMediaObject, is really just a routine PHP file upload which allows users to upload images remotely. The full \"http://hostname.com/imageUploadDir\" needs to be specified, not just a relative url.</p>\r\n<h4>Taking Exception</h4>\r\n<p>As promised, here\'s the code for your own custom exception handling:</p>\r\n<pre class=\"brush: php\">&lt;?php\r\n/**\r\n *   Exception class for Local_Api\r\n *\r\n *   @category    Exceptions\r\n *   @package     Local_Api\r\n *   @author      Kao Saelee &lt;me AT kaosaelee DOT com&gt;, mods by User1 Findleton\r\n *   @license     http://www.gnu.org/copyleft/lesser.html  LGPL License 2.1\r\n */\r\nclass Local_Api_Exception extends Exception\r\n{\r\n  public function __construct($message = null, $code = 0)\r\n  {\r\n    parent::__construct($message, $code);\r\n  }\r\n}</pre>\r\n<p>I know. Pretty daunting but, somehow, I know you\'ll cope.</p>\r\n<h3>Conclusion</h3>\r\n<p>It\'s been a long haul but hopefully enlightening. In Part 3 we\'ll flesh out the Blogger and WP classes and discuss various testing and debugging strategies. Until then, relax, breath deep and enjoy Your Moment of Zend.</p>\r\n<p>&nbsp;</p>\r\n<p><a name=\"references\"></a></p>\r\n<h3>References:</h3>\r\n<h4>metaWeblog API</h4>\r\n<p><a title=\"XMLRPC spec\" href=\"http://xmlrpc.scripting.com/spec.html\" target=\"_blank\">XML-RPC spec</a></p>\r\n<p><a title=\"metaWeblog spec\" href=\"http://xmlrpc.scripting.com/metaWeblogApi.html\" target=\"_blank\">metaWeblog spec</a></p>\r\n<p><a title=\"LnBlog\" href=\"http://lnblog.skepticats.com/documentation/files/metaweblog-php.html\" target=\"_blank\">LnBlog\'s take on metaWeblog</a></p>\r\n<p><a title=\"asp.net metaWeblog API\" href=\"http://weblogs.asp.net/metablog.ashx\" target=\"_blank\">asp.net\'s take on metaWeglog</a> (old)</p>\r\n<p><a title=\"MSDN metaWeblog API\" href=\"http://blogs.msdn.com/metablog.ashx\" target=\"_blank\">asp.net\'s take on metaWeglog</a> (new)</p>\r\n<p><a name=\"clients\"></a></p>\r\n<h4>Desktop Blogging Software</h4>\r\n<p><a title=\"hongkiat.com\" href=\"http://www.hongkiat.com/blog/desktop-blogging-clients-the-ultimate-list\" target=\"_blank\">hongkiat.com\'s \"Ultimate List\"</a></p>\r\n<p><a title=\"Ceps Ibo\" href=\"http://www.cepsibo.us/2012/01/desktop-blogging-software.html\" target=\"_blank\">Ceps Ibo\'s list</a></p>\r\n<p>&nbsp;</p>','2012-03-31 19:22:49','2012-03-31 19:22:49'),(41,14,1,12,'How To: Zend, XMLRPC and metaWeblog - Part 3','<p><img style=\"vertical-align: middle; margin: 5px;\" src=\"/images/uploads/metaWeblog.JPG\" alt=\"metaWeblog API\" /></p>\r\n<h3>Rounding out the metaWeblog API</h3>\r\n<p>This is part three of a three part series on putting together an XMLRPC remote blogging server. In part one we covered the factors leading up to selecting the metaWeblog API for implementation and laid the groundwork for building a Zend XMLRPC server and testing client. In part two we got down to coding the actual API. In this part we\'ll wrap things up by coding the remaining API elements and then tackle the tricky task of testing and debugging to make sure all is as it seems. It\'s recommended that you give <a title=\"Zend, XmlRpc and metaWeblog - Part 1\" href=\"/blog/comment?id=39\" target=\"_blank\">part one</a> and <a title=\"Zend, XmlRpc and metaWeblog - Part 2\" href=\"/blog/comment?id=40\" target=\"_blank\">part two</a> a good perusal before continuing further in this article.</p>\r\n<p>(Note: You can find a link to the source code used in this How To at the end of the article)</p>\r\n<p>If you\'re ready let\'s wrap things up.<!--more--></p>\r\n<h3>Local_Api_Blogger</h3>\r\n<p>As mentioned previously the metaWeblog API appears to be incomplete without the inclusion of the original Blogger API methods. So here\'s the Local_Api_Blogger class that looks a lot like the Local_Api_MetaWeblog class we saw in the last article. In fact the first two methods, login() and test() are copied straight from the latter. Non-optimal, I\'ll admit but we\'ll discuss that later. For the sake of brevity I\'ve elided the login() code in the examples below. Just cut and paste from Local_Api_MetaWeblog to flesh it out.</p>\r\n<pre class=\"brush: php\">&lt;?php\r\nclass Local_Api_Blogger\r\n{\r\n    protected $_user;\r\n    /**\r\n     * This is the function login\r\n     *\r\n     * @param string $username\r\n     * @param string $password\r\n     * @return boolean\r\n     */\r\n    private function login($username, $password)\r\n    {\r\n        .\r\n        .\r\n        .\r\n        .\r\n    }\r\n    /**\r\n     * This is the Blogger function test\r\n     *\r\n     * @return boolean\r\n     */\r\n    public function test()\r\n    {\r\n        return true;\r\n    }\r\n    /**\r\n     * This is the Blogger function getUsersBlogs\r\n     *\r\n     * @param string $appkey\r\n     * @param string $username\r\n     * @param string $password\r\n     * @return array of struct\r\n     */\r\n    public function getUsersBlogs($appkey, $username, $password)\r\n    {\r\n        $blogInfo = array();\r\n        if (!$this-&gt;login($username, $password)) {\r\n            return $blogInfo;\r\n        }\r\n        $bi = array(\r\n            \'blogid\' =&gt; \'YMOZ\',\r\n            \'xmlrpc\' =&gt; \'http://ymozend.com/xmlrpc\',\r\n            \'url\' =&gt; \'http://ymozend.com\',\r\n            \'blogName\' =&gt; \'Your Moment of Zend\'\r\n        );\r\n        $blogInfo[] = $bi;\r\n        return $blogInfo;\r\n    }\r\n    /**\r\n     * This is the Blogger function getUserInfo\r\n     *\r\n     * @param string $appkey\r\n     * @param string $username\r\n     * @param string $password\r\n     * @return struct\r\n     */\r\n    public function getUserInfo($appkey, $username, $password)\r\n    {\r\n        $userInfo = array();\r\n        if (!$this-&gt;login($username, $password)) {\r\n            return $userInfo;\r\n        }\r\n        $firstname = \'\';\r\n        $lastname = \'\';\r\n        $pm = new Local_Domain_Mappers_ProfileMapper();\r\n        $p = $pm\r\n            -&gt;findByUser($this\r\n            -&gt;_user\r\n            -&gt;id);\r\n        if ($p !== null) {\r\n            $firstname = $p-&gt;get(\'first\');\r\n            $lastname = $p-&gt;get(\'last\');\r\n        }\r\n        $userInfo = array(\r\n            \'userid\' =&gt; $this\r\n                -&gt;_user\r\n                -&gt;id,\r\n            \'firstname\' =&gt; $firstname,\r\n            \'lastname\' =&gt; $lastname,\r\n            \'nickname\' =&gt; $this\r\n                -&gt;_user\r\n                -&gt;username,\r\n            \'email\' =&gt; $this\r\n                -&gt;_user\r\n                -&gt;email,\r\n            \'url\' =&gt; \'http://ymozend.com/profile/\' . $this\r\n                -&gt;_user\r\n                -&gt;id\r\n        );\r\n        return $userInfo;\r\n    }\r\n    /**\r\n     * This is the Blogger function deletePost\r\n     *\r\n     * @param string $appkey\r\n     * @param string $postid\r\n     * @param string $username\r\n     * @param string $password\r\n     * @param boolean $publish\r\n     * @return boolean\r\n     */\r\n    public function deletePost($appkey, $postid, $username, $password, $publish)\r\n    {\r\n        if (!$this-&gt;login($username, $password)) {\r\n            return false;\r\n        }\r\n        $am = new Local_Domain_Mappers_ArticleMapper();\r\n        $options[\'field\'] = \'id\';\r\n        $options[\'value\'] = $postid;\r\n        if ($am\r\n            -&gt;exists($options)) {\r\n            $article = $am-&gt;find($postid);\r\n            $article\r\n                -&gt;finder()\r\n                -&gt;delete($article);\r\n        }\r\n        return true;\r\n    }\r\n}</pre>\r\n<p>Nothing too exceptional here but the first two API methods illustrate well how to return structures and arrays of structures.</p>\r\n<h3>Local_Api_Wp</h3>\r\n<p>Finalizing our API is this apparently stray method that <a title=\"MSDN metaWeblog API definition\" href=\"http://blogs.msdn.com/metablog.ashx\" target=\"_blank\">MSDN</a> seems to think is required to complete the metaWeblog API and who am I to balk at the&nbsp;accumulated&nbsp;wisdom of MSDN? Nobody, that\'s who. So, for the sake of completeness, here you go. (FYI - The same thing about the login() method as mentioned above applies here)</p>\r\n<p>&nbsp;</p>\r\n<pre class=\"brush: php\">&lt;?php\r\nclass Local_Api_Wp\r\n{\r\n    protected $_user;\r\n    /**\r\n     * This is the function login\r\n     *\r\n     * @param string $username\r\n     * @param string $password\r\n     * @return boolean\r\n     */\r\n    private function login($username, $password)\r\n    {\r\n        .\r\n        .\r\n        .\r\n        .\r\n    }\r\n    /**\r\n     * This is the wp function test\r\n     *\r\n     * @return boolean\r\n     */\r\n    public function test()\r\n    {\r\n        return true;\r\n    }\r\n    /**\r\n     * This is the wp function getTags\r\n     *\r\n     * @param string $blogid\r\n     * @param string $username\r\n     * @param string $password\r\n     * @return array of struct\r\n     */\r\n    public function getTags($blogid, $username, $password)\r\n    {\r\n        $tags = array();\r\n        if (!$this-&gt;login($username, $password)) {\r\n            return $tags;\r\n        }\r\n        $km = new Local_Domain_Mappers_KeywordMapper();\r\n        $kc = $km-&gt;findAll();\r\n        $kw = $km-&gt;countKeyword();\r\n        foreach ($kw as $k) {\r\n            $keyword = $k[\'keyword\'];\r\n            $count = $k[\'rank\'];\r\n            $id = $km-&gt;findByKeyword($keyword);\r\n            $tag = array(\r\n                \'tag_id\' =&gt; new Zend_XmlRpc_Value_Integer($$id) ,\r\n                \'name\' =&gt; $keyword,\r\n                \'slug\' =&gt; $keyword,\r\n                \'html_url\' =&gt; \'http://ymozend.com/blog/tag?tag=\' . $keyword,\r\n                \'rss_url\' =&gt; \'\',\r\n                \'count\' =&gt; new Zend_XmlRpc_Value_Integer($count)\r\n            );\r\n            $tags[] = $tag;\r\n        }\r\n        return $tags;\r\n    }\r\n}</pre>\r\n<p>And that\'s a wrap! One metaWeblog API, signed, sealed and delivered.</p>\r\n<h3>But WAIT! There\'s more!</h3>\r\n<p>So, great, there it is, you just plug it in and everything works. Except it doesn\'t. Now what?</p>\r\n<p>Now we go to <em>great lengths</em> to figure out exactly what\'s going on in the time honored tradition of testing and debugging. Which, though a bit involved, really isn\'t going to that <em>great</em> of <em>lengths</em>, it just sounds a lot more dramatic that way.</p>\r\n<h4>Debugging</h4>\r\n<p>The first thing we\'re going to do is add some logging capability to the server. This doesn\'t require setting environmental variables or modifying the application.ini file or anything, it\'s just a chunk of code that you switch on or off as you need it. Here\'s the final server code.</p>\r\n<pre class=\"brush: php\">&lt;?php\r\nclass Xmlrpc_IndexController extends Zend_Controller_Action\r\n{\r\n    public function indexAction()\r\n    {\r\n        // catch and throw custom exceptions\r\n        Zend_XmlRpc_Server_Fault::attachFaultException(\'Local_Api_Exception\');\r\n\r\n        // disable layouts and rendering\r\n        $this-&gt;_helper-&gt;layout-&gt;disableLayout();\r\n        $this-&gt;getHelper(\'viewRenderer\')-&gt;setNoRender(true);\r\n\r\n        // setup the server\r\n        $server = new Zend_XmlRpc_Server();\r\n        $server-&gt;setClass(\'Local_Api_MetaWeblog\', \'metaWeblog\');\r\n        $server-&gt;setClass(\'Local_Api_Blogger\', \'blogger\');\r\n        $server-&gt;setClass(\'Local_Api_Wp\', \'wp\');\r\n\r\n        // capture the request and response\r\n        $response = $server-&gt;handle();\r\n        $request = $server-&gt;getRequest();\r\n\r\n        // set to true to generate a log\r\n        if (false) {\r\n            $log = new Zend_Log();\r\n            $stream = @fopen(APPLICATION_ROOT . \'/logs/xmlrpc.log\', \'a\');\r\n            if ($stream) {\r\n                $stdWriter = new Zend_Log_Writer_Stream($stream);\r\n                $log-&gt;addWriter($stdWriter);\r\n                $log-&gt;info(\"Request:\\n$request\");\r\n                $log-&gt;info(\"Response:\\n$response\");\r\n                $log-&gt;info(\"PHPInput:\\n\" . file_get_contents(\'php://input\'));\r\n            }\r\n        }\r\n\r\n        // spit out the response\r\n        echo $response;\r\n    }\r\n}</pre>\r\n<p>Things to note:</p>\r\n<p>Rather than a simple \"echo $server-&gt;handle()\" call we capture the response instead and then grab the request that generated it for good measure.</p>\r\n<p>Logging is pretty straight forward; open a log and then write to it. We write the request, then the response, and then what? What\'s this \'php://input\' thingy? You can <a title=\"php:// docs\" href=\"http://php.net/manual/en/wrappers.php.php\" target=\"_blank\">go here</a> for the straight skinny but in a nutshell, \'php://input\' contains the raw data from the request body. This, as it turns out, can be really helpful since just the request and response don\'t always tell the full story. Almost all of this output has, of course, been through the XMLRPC server mill so being able to parse xml is a fairly important skill that you\'ll need, if you don\'t already have it, to understand what\'s going on.</p>\r\n<p>Finally, we \"echo $response\" to close the loop.</p>\r\n<h4>Testing</h4>\r\n<p>The final piece of the puzzle is how to test this whole mess. Grabbing as many blogging clients as you can and bashing them against your server while scanning the logs and using whatever network traffic analysis tools you\'ve got at your disposal is definitely part of it but sometimes you need a more controlled environment and that\'s where your own testing client comes in.</p>\r\n<p>The bare bones of the client were laid out in Part 1 to help illustrate just how easy it is to get a Zend XMLRPC client up and running. Two lines of code basically. Easy peasy. Getting it to actually do something is a touch more involved. I\'m just going to lay this down and touch on a few key points that will hopefully be enough to get you started doing your own testing.</p>\r\n<pre class=\"brush: php\">&lt;?php\r\nclass Xmlrpc_ClientController extends Zend_Controller_Action\r\n{\r\n    public function indexAction()\r\n    {\r\n        $client = new Zend_XmlRpc_Client(\'http://yourhost.com/xmlrpc/\');\r\n        try {\r\n            // preload some testing data\r\n            $post = array(\r\n                \'title\' =&gt; \'Just Another Test Post\',\r\n                \'dateCreated\' =&gt; \'2011-01-01 12:34:56\',\r\n                \'description\' =&gt; \'&lt;h3&gt;Test Header&lt;/h3&gt;&lt;p&gt;Test body. That should do it.&lt;/p&gt;\',\r\n                \'categories\' =&gt; array(\r\n                    \'new\',\r\n                    \'key\',\r\n                    \'words\'\r\n                ) ,\r\n                \'userid\' =&gt; \'11\'\r\n            );\r\n            $bits = new Zend_XmlRpc_Value_Base64(\'/9j/4QAYRXhpZgAASUkqAAgAAAAAAAAAAAAAAP/sABFEdWNreQABAAQAAAA8AAD/7gAOQWRvYmUAZMAAAAAB/9sAhAAGBAQEBQQGBQUGCQYFBgkLCAYGCAsMCgoLCgoMEAwMDAwMDBAMDg8QDw4MExMUFBMTHBsbGxwfHx8fHx8fHx8fAQcHBw0MDRgQEBgaFREVGh8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx//wAARCAAeAAEDAREAAhEBAxEB/8QATAABAQAAAAAAAAAAAAAAAAAAAAcBAQEAAAAAAAAAAAAAAAAAAAADEAEAAAAAAAAAAAAAAAAAAAAAEQEAAAAAAAAAAAAAAAAAAAAA/9oADAMBAAIRAxEAPwCDpJAAAP/Z\');\r\n            $mob1 = array(\r\n                \'name\' =&gt; \'test.jpg\',\r\n                \'type\' =&gt; \'image/jpeg\',\r\n                \'bits\' =&gt; $bits\r\n            );\r\n\r\n            // the tests\r\n\r\n            $data = $client-&gt;call(\'metaWeblog.test\');\r\n\r\n//            $data = $client-&gt;call(\'metaWeblog.getRecentPosts\', array(\r\n//                \'0\',\r\n//                \'yourname@yourhost.com\',\r\n//                \'yourpassword\',\r\n//                2\r\n//            ));\r\n//            $data = $client-&gt;call(\'metaWeblog.getPost\', array(\r\n//                \'36\',\r\n//                \'yourname@yourhost.com\',\r\n//                \'yourpassword\'\r\n//            ));\r\n//            $data = $client-&gt;call(\'metaWeblog.newPost\', array(\r\n//                \'YMOZ\',\r\n//                \'yourname@yourhost.com\',\r\n//                \'yourpassword\',\r\n//                $post,\r\n//                1\r\n//            ));\r\n//            $data = $client-&gt;call(\'metaWeblog.editPost\', array(\r\n//                \'46\',\r\n//                \'yourname@yourhost.com\',\r\n//                \'yourpassword\',\r\n//                $post,\r\n//                1\r\n//            ));\r\n//            $data = $client-&gt;call(\'metaWeblog.getCategories\', array(\r\n//                \'0\',\r\n//                \'yourname@yourhost.com\',\r\n//                \'yourpassword\'\r\n//            ));\r\n//            $data = $client-&gt;call(\'metaWeblog.newMediaObject\', array(\r\n//                \'0\',\r\n//                \'yourname@yourhost.com\',\r\n//                \'yourpassword\',\r\n//                $mob1\r\n//            ));\r\n//            $data = $client-&gt;call(\'blogger.getUsersBlogs\', array(\r\n//                \'0\',\r\n//                \'yourname@yourhost.com\',\r\n//                \'1p1eqtw\'\r\n//            ));\r\n//            $data = $client-&gt;call(\'wp.getTags\', array(\r\n//                \'YMOZ\',\r\n//                \'yourname@yourhost.com\',\r\n//                \'yourpassword\'\r\n//            ));\r\n//            $data = $client-&gt;call(\'blogger.getUserInfo\', array(\r\n//                \'YMOZ\',\r\n//                \'yourname@yourhost.com\',\r\n//                \'yourpassword\'\r\n//            ));\r\n//            $data = $client-&gt;call(\'blogger.deletePost\', array(\r\n//                \'YMOZ\',\r\n//                \'256\',\r\n//                \'yourname@yourhost.com\',\r\n//                \'yourpassword\',\r\n//                true\r\n//            ));\r\n\r\n            $this-&gt;view-&gt;data = var_dump($data);\r\n        }\r\n        catch(Zend_XmlRpc_Client_HttpException $e) {\r\n            require_once \'Zend/Exception.php\';\r\n            throw new Zend_Exception($e);\r\n        }\r\n        catch(Zend_XmlRpc_Client_FaultException $e) {\r\n            require_once \'Zend/Exception.php\';\r\n            throw new Zend_Exception($e);\r\n        }\r\n    }\r\n}\r\n</pre>\r\n<p>Here\'s the 20,000 ft view of what\'s going on:</p>\r\n<p>The first line creates the client with the server\'s XMLRPC endpoint given as an arguement. Modify for your installation as needed.</p>\r\n<p>I\'ve wrapped the test in \'try/catch\' blocks so it could be somewhat civilized about exceptions when they occur.</p>\r\n<p>Next I pre-load some variables that get used in various tests that are commented out at the moment. Why? Because it\'s a pain to comment and uncomment these pieces as needed and leaving them in is cheap. It\'s not like we\'re performing performance metrics on the the client so let them get assigned says I.</p>\r\n<p>Finally comes the first test: metaWeblog.test. Not groundbreaking, admittedly, but at least you can tell that every thing is up and running and talking to each other. If you included the view script mentioned in Part 1 you should see something like this when you enter the url, \"http://yourhost.com/xmlrpc/client\":</p>\r\n<p><img style=\"margin-top: 5px; margin-bottom: 5px; vertical-align: top;\" src=\"/images/uploads/xmlrpc_testing.JPG\" alt=\"XMLRPC testing\" /></p>\r\n<p>If you don\'t see \"boolean true\" on the screen somewhere it means going back to the drawing board since until this works nothing else is going to do much good.</p>\r\n<p>Once you got your client and server talking to each other you can comment out that particular test and uncomment one of the others to test particular methods.</p>\r\n<h4>NOTE: Uncomment only one test at a time or your results will be... interesting.</h4>\r\n<p>With that caveat out of the way you can now run each test individually and see what the server is actually sending back for each request. Pay particular attention to the&nbsp;arguments&nbsp;you pass to each method and make sure they\'re tailored to your environment otherwise it is all for naught and you\'ll get a first hand lesson in <a title=\"Garbage In, Garbage Out\" href=\"http://en.wikipedia.org/wiki/Garbage_in,_garbage_out\" target=\"_blank\">GIGO</a>.</p>\r\n<p>And with that you should be well on your way to implementing your own Zend XMLRPC metaWeblog API server.</p>\r\n<h3>/**<br />&nbsp; *<br /> &nbsp; * @TODO<br /> &nbsp; *<br /> &nbsp; */</h3>\r\n<p>As you peruse the code you\'ll notice several things that could use some attention. The duplication of the login() function in the various classes is the most glaring. You may already have your auth system&nbsp;compartmentalized&nbsp;into a handy plugin or some such that does exactly what you need and so replacing the calls in the classes should just be minor tweaks for you. We, on the other hand, would need some major refactoring to&nbsp;accommodate&nbsp;such a thing though now that the need has arisen it is definitely on the TODO list.</p>\r\n<p>Another item would be more stringent error checking on database transactions. Currently if a bogus article ID or such is passed to a method it will just kind of blow up and leave you with the less than forthcoming exception that you\'ll see all too often,&nbsp;\'Failed to <em>parse</em> response.\' Not helpful. All I can say in my defense is that currently we have exactly one (1) user (Kurt) and if he gets less-than-helpful error messages popping up in his client of choice, well, he knows where to reach me. Another item on the TODO list.</p>\r\n<p>Since we\'re dealing with Zend and PHP here there are innumerable ways to implement the processing classes so you can certainly rework them to meet your particular needs. Hopefully the code listed here will get you moving down the path to your own implementation.</p>\r\n<h3>Conclusion</h3>\r\n<p>And with that our tour is complete. I hope this has helped open the door to you for using Zend\'s XMLRPC services for not only remote blogging but for any other remote processing requirements. The handy thing is that the Zend_XmlRpc_(Server/Client) classes are like a gateway drug to other easily implemented services like SOAP and JSON and others. Handy, indeed.</p>\r\n<h3>Source Code</h3>\r\n<p>You can download the source code for these articles by <a title=\"Source code\" href=\"/attachments/zend_xmlrpc.zip\">clicking here</a>.</p>\r\n<p>&nbsp;</p>\r\n<p><a name=\"references\"></a></p>\r\n<h3>References:</h3>\r\n<h4>metaWeblog API</h4>\r\n<p><a title=\"XMLRPC spec\" href=\"http://xmlrpc.scripting.com/spec.html\" target=\"_blank\">XML-RPC spec</a></p>\r\n<p><a title=\"metaWeblog spec\" href=\"http://xmlrpc.scripting.com/metaWeblogApi.html\" target=\"_blank\">metaWeblog spec</a></p>\r\n<p><a title=\"LnBlog\" href=\"http://lnblog.skepticats.com/documentation/files/metaweblog-php.html\" target=\"_blank\">LnBlog\'s take on metaWeblog</a></p>\r\n<p><a title=\"asp.net metaWeblog API\" href=\"http://weblogs.asp.net/metablog.ashx\" target=\"_blank\">asp.net\'s take on metaWeglog</a> (old)</p>\r\n<p><a title=\"MSDN metaWeblog API\" href=\"http://blogs.msdn.com/metablog.ashx\" target=\"_blank\">asp.net\'s take on metaWeglog</a> (new)</p>\r\n<p><a name=\"clients\"></a></p>\r\n<h4>Desktop Blogging Software</h4>\r\n<p><a title=\"hongkiat.com\" href=\"http://www.hongkiat.com/blog/desktop-blogging-clients-the-ultimate-list\" target=\"_blank\">hongkiat.com\'s \"Ultimate List\"</a></p>\r\n<p><a title=\"Ceps Ibo\" href=\"http://www.cepsibo.us/2012/01/desktop-blogging-software.html\" target=\"_blank\">Ceps Ibo\'s list</a></p>\r\n<p>&nbsp;</p>','2012-04-01 19:12:13','2012-04-01 19:12:13'),(45,11,1,9,'Detached Worktrees in Git','<p><img src=\"/images/uploads/Git-logo.png\" alt=\"\" width=\"187\" height=\"75\" /></p>\r\n<p>Most of the time we are using git within a worktree with the repo present in the directory. &nbsp;That makes sense most of the time but what about when it comes to publishing code? &nbsp;When you have an image you want to push to production there is no reason to have a repo; you just want a copy of the image. &nbsp;</p>\r\n<div>&nbsp;</div>\r\n<div>This is where detached worktrees come in. &nbsp;In git there are a couple of commands that you don\'t see too often. &nbsp;For instance, the command line options: --git-dir, and --work-tree.</div>\r\n<div>&nbsp;</div>\r\n<div>This gives you the ability to refer to a worktree where there is no underlying repo and associate it with an existing repo. &nbsp;And conversly, to create a worktree from an existing repo without the need for cloning.</div>\r\n<p><!--more--></p>\r\n<div>&nbsp;</div>\r\n<div>To put this in some perspective, imagine the scenario where you need a couple of images of the same project. &nbsp;We have a website that we place on the web server but we also want to publish the site on Github for others to use as a template for building their own site. &nbsp;So for the actual site we need all the specific connection stuff like logins and passwords and there are email addresses for contact and so on. &nbsp;That\'s not stuff you want on Github so for that copy of the site you\'ll want to strip that out.</div>\r\n<div>&nbsp;</div>\r\n<div>In our project we use Phing to churn out two copies of the codebase. &nbsp;So when the Phing thing runs we end up with two worktrees each in a separate directory space. &nbsp;In the directory trees there are no repos, just the code and the assets. &nbsp;But we want to record those snapshots that we are publishing to an existing set of repos on the development machine.</div>\r\n<div>&nbsp;</div>\r\n<div>This is done by referring to the worktree and the repo indirectly as in:&nbsp;</div>\r\n<div>\r\n<div>&nbsp;</div>\r\n<div><span style=\"font-family: \'courier new\', courier;\">git --git-dir=/etc/git-repos/myrepo.git &nbsp;--work-tree=/somedir/myworktree add .</span></div>\r\n<div><span style=\"font-family: \'courier new\', courier;\">git --git-dir=/etc/git-repos/myrepo.git &nbsp;--work-tree=/somedir/myworktree &nbsp;commit -a -m \'Github snapshot XXX\'</span></div>\r\n<div><span style=\"font-family: \'courier new\', courier;\">git --git-dir=/etc/git-repos/myrepo.git &nbsp;--work-tree=/somedir/myworktree &nbsp;tag -a -m \"Some Tag\"</span></div>\r\n<div><span style=\"font-family: \'courier new\', courier;\">git --git-dir=/etc/git-repos/myrepo.git &nbsp;--work-tree=/somedir/myworktree &nbsp;branch &nbsp;\"Some Tag Branch\"</span></div>\r\n<div>&nbsp;</div>\r\n</div>\r\n<div>We\'re tagging and branching here so that if we need to, we can check this image out and avoid the \'detached HEAD\' deal that happens when you check out only a tag. &nbsp;At least this was the solution I came up with. &nbsp;Anyone that wants to enlighten me on alternative strategies is welcome to do so.</div>\r\n<div>\r\n<div>&nbsp;</div>\r\n<div>As for the other way around, when you have an image in a repo and you only want to extract the image without having to clone:</div>\r\n</div>\r\n<div>&nbsp;</div>\r\n<div>First, you push to the web server:</div>\r\n<div>&nbsp;</div>\r\n<div><span style=\"font-family: \'courier new\', courier;\">git&nbsp;--git-dir=/etc/git-repos/myrepo.git&nbsp;push -f my_remote master --tags \"Some Tag\"</span></div>\r\n<div>&nbsp;</div>\r\n<div>And then on the server:</div>\r\n<div>&nbsp;</div>\r\n<div><span style=\"font-family: \'courier new\', courier;\">GIT_WORK_TREE=/home/yourrepo.git checkout -f \"Some Tag\"</span></div>\r\n<div>&nbsp;</div>\r\n<div>That will simply output the image to a directory tree which is all you want for the production server. &nbsp;With a little more work, this last bit could also be part of a post-receive hook if you like. &nbsp;You would need to either have only one image in the web server repo or devise a way of passing the tag to be dumped.</div>\r\n<div>&nbsp;</div>','2012-04-10 16:24:50','2012-04-10 16:24:50');
/*!40000 ALTER TABLE `articles` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


DROP TABLE IF EXISTS `avatars`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `avatars` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image_name` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `url` (`image_name`)
) ENGINE=InnoDB AUTO_INCREMENT=1312 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;


LOCK TABLES `avatars` WRITE;
/*!40000 ALTER TABLE `avatars` DISABLE KEYS */;
INSERT INTO `avatars` VALUES (1288,'01.jpg','2012-02-11 00:15:21','2012-02-11 00:15:21'),(1289,'02.jpg','2012-02-11 00:15:21','2012-02-11 00:15:21'),(1290,'03.gif','2012-02-11 00:15:21','2012-02-11 00:15:21'),(1291,'04.jpg','2012-02-11 00:15:21','2012-02-11 00:15:21'),(1292,'05.jpg','2012-02-11 00:15:21','2012-02-11 00:15:21'),(1293,'06.jpg','2012-02-11 00:15:21','2012-02-11 00:15:21'),(1294,'07.jpg','2012-02-11 00:15:21','2012-02-11 00:15:21'),(1295,'08.jpg','2012-02-11 00:15:21','2012-02-11 00:15:21'),(1296,'09.jpg','2012-02-11 00:15:21','2012-02-11 00:15:21'),(1297,'10.jpg','2012-02-11 00:15:21','2012-02-11 00:15:21'),(1298,'11.jpg','2012-02-11 00:15:21','2012-02-11 00:15:21'),(1299,'12.jpg','2012-02-11 00:15:21','2012-02-11 00:15:21'),(1300,'13.jpg','2012-02-11 00:15:21','2012-02-11 00:15:21'),(1301,'14.jpg','2012-02-11 00:15:21','2012-02-11 00:15:21'),(1302,'15.jpg','2012-02-11 00:15:21','2012-02-11 00:15:21'),(1303,'16.jpg','2012-02-11 00:15:21','2012-02-11 00:15:21'),(1304,'17.jpg','2012-02-11 00:15:21','2012-02-11 00:15:21'),(1305,'18.jpg','2012-02-11 00:15:21','2012-02-11 00:15:21'),(1306,'19.jpg','2012-02-11 00:15:21','2012-02-11 00:15:21'),(1307,'20.gif','2012-02-11 00:15:21','2012-02-11 00:15:21'),(1308,'21.jpg','2012-02-11 00:15:21','2012-02-11 00:15:21'),(1309,'22.jpg','2012-02-11 00:15:21','2012-02-11 00:15:21'),(1310,'23.jpg','2012-02-11 00:15:21','2012-02-11 00:15:21'),(1311,'24.jpg','2012-02-11 00:15:21','2012-02-11 00:15:21');
/*!40000 ALTER TABLE `avatars` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


DROP TABLE IF EXISTS `books`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `books` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `author` varchar(100) NOT NULL,
  `image` varchar(50) NOT NULL,
  `link` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;


LOCK TABLES `books` WRITE;
/*!40000 ALTER TABLE `books` DISABLE KEYS */;
INSERT INTO `books` VALUES (1,'PHP Objects, Patterns and Practice','Matt Zandstra','/images/amz/PHPObjects.jpg','/books','2012-03-09 01:18:21','2012-03-09 01:18:21'),(3,'Zend Framework, A Beginner\'s Guide','Vikram Vaswani','/images/amz/ZFBG.jpg','/books','2012-03-09 02:55:53','2012-03-09 02:55:53'),(6,'Zend Framework 1.8 Web Application Development','Keith Pope','/images/amz/ZFWAD.jpg','/books','2012-03-09 02:58:46','2012-03-09 02:58:46'),(5,'Beginning PHP and MySQL','W. Jason Gilmore','/images/amz/PHPandMYSQL.jpg','/books','2012-03-09 02:57:23','2012-03-09 02:57:23'),(7,'Building PHP Applications with Symfony, CakePHP an','Bartosz Porebski, Karol Przystalski, Leszek Nowak','/images/amz/BuildingPHP.jpg','/books','2012-03-10 18:25:30','2012-03-10 18:25:30'),(8,'Pro PHP: Patterns, Frameworks, Testing and More','Kevin McArthur','/images/amz/ProPHP.jpg','/books','2012-03-10 18:27:35','2012-03-10 18:27:35');
/*!40000 ALTER TABLE `books` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL,
  `comment_text` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `art_id` (`article_id`),
  CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;


LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` VALUES (1,14,40,'Very nice. Can I go now?','2012-04-10 19:42:49','2012-04-10 19:42:49');
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


DROP TABLE IF EXISTS `keywords`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `keywords` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `keyword` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `kw` (`keyword`)
) ENGINE=InnoDB AUTO_INCREMENT=252 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;


LOCK TABLES `keywords` WRITE;
/*!40000 ALTER TABLE `keywords` DISABLE KEYS */;
INSERT INTO `keywords` VALUES (129,'zend','2012-01-25 23:09:59','2012-01-25 23:09:59'),(192,'php','2012-03-11 19:27:48','2012-03-11 19:27:48'),(193,'phpunit','2012-03-11 19:27:48','2012-03-11 19:27:48'),(194,'testing','2012-03-11 19:27:48','2012-03-11 19:27:48'),(212,'Array','2012-04-09 02:33:41','2012-04-09 02:33:41'),(227,'git','2012-04-10 00:43:49','2012-04-10 00:43:49'),(228,'detached-worktree','2012-04-10 00:43:49','2012-04-10 00:43:49'),(251,'phing','2012-04-10 16:24:50','2012-04-10 16:24:50');
/*!40000 ALTER TABLE `keywords` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


DROP TABLE IF EXISTS `menus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu` varchar(15) NOT NULL,
  `title` varchar(15) NOT NULL,
  `link` varchar(30) NOT NULL,
  `ordering` int(2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;


LOCK TABLES `menus` WRITE;
/*!40000 ALTER TABLE `menus` DISABLE KEYS */;
INSERT INTO `menus` VALUES (1,'main','Home','/',1,'0000-00-00 00:00:00','2012-03-24 22:35:59'),(2,'main','Blog','/blog',2,'2012-03-24 23:12:02','2012-03-24 23:12:02'),(3,'main','Books','/books',3,'2012-03-24 23:13:09','2012-03-24 23:13:09'),(4,'admin','Articles','/admin/article',1,'2012-03-25 00:22:10','2012-03-25 00:22:10'),(5,'admin','Comments','/admin/comment',2,'2012-03-25 00:24:13','2012-03-25 00:24:13'),(6,'admin','Users','/admin/user',3,'2012-03-25 00:24:46','2012-03-25 00:24:46'),(7,'admin','Sections','/admin/section',4,'2012-03-25 00:25:34','2012-03-25 00:25:34'),(8,'admin','Config','/admin/setting',6,'2012-03-25 00:26:07','2012-03-25 00:26:07'),(9,'admin','Books','/admin/book',7,'2012-03-25 00:26:48','2012-03-25 00:26:48'),(12,'admin','Search','/admin/index/search',8,'2012-03-25 00:31:49','2012-03-25 01:37:56'),(11,'admin','Menus','/admin/menu',5,'2012-03-25 00:30:19','2012-03-25 00:30:19'),(13,'admin','Latest Version','http://ymozend.dev/version',9,'2012-04-02 15:55:58','2012-04-02 15:55:58');
/*!40000 ALTER TABLE `menus` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


DROP TABLE IF EXISTS `profiles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `profiles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `first` varchar(30) NOT NULL,
  `last` varchar(30) NOT NULL,
  `middle` varchar(30) DEFAULT NULL,
  `occupation` varchar(50) DEFAULT NULL,
  `website` varchar(50) DEFAULT NULL,
  `bio_text` text,
  `avatar` varchar(50) NOT NULL DEFAULT 'default.jpg',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;


LOCK TABLES `profiles` WRITE;
/*!40000 ALTER TABLE `profiles` DISABLE KEYS */;
INSERT INTO `profiles` VALUES (1,14,'User1','Findleton','','This and that, but mostly the other thing...','http://www.arbalestmedia.com','With over 30 years experience in the tech industry, User1 still thinks this stuff is pretty cool. Building this site is his first in-depth foray into the worlds of PHP and Zend Framework. Let\'s just say it\'s been character building and leave it at that. You can contact User1 on his personal website.','_9tE0STdr1tbE/headshotMd-150x150.jpg','2012-02-09 02:00:59','2012-02-09 02:00:59'),(2,11,'Kurt','Miller','Eric','programmer','http://www.ymozend.com','Co-developed Your Moment of Zend blogging site to assist the Zend Framework community members with PHP coding techniques. Site provides examples, tutorials, and discussion of best practices for site development, testing, and deployment with PHP and Zend Framework. YMOZ utilizes HTML5, CSS3/Sass, Dojo, JQuery, a custom domain layer with MySQL back end, and PHPUnit/Selinium for testing.  Currently deploying to www.ymozend.com.','12.jpg','2012-02-09 16:47:28','2012-02-09 20:06:30');
/*!40000 ALTER TABLE `profiles` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


DROP TABLE IF EXISTS `registrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `registrations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `reg_string` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;


LOCK TABLES `registrations` WRITE;
/*!40000 ALTER TABLE `registrations` DISABLE KEYS */;
/*!40000 ALTER TABLE `registrations` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


DROP TABLE IF EXISTS `sections`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sections` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `section_title` varchar(150) NOT NULL,
  `section_text` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `title` (`section_title`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;


LOCK TABLES `sections` WRITE;
/*!40000 ALTER TABLE `sections` DISABLE KEYS */;
INSERT INTO `sections` VALUES (35,1,'About','<p>Welcome to <strong>Your Moment of Zend.</strong> This site is intended as a place to test ideas, exchange opinions, and refine skills.</p>\r\n<p>It\'s a new deployment and therefore a bit rough in spots. We will address issues and fix things as we move along.</p>\r\n<p>We welcome comments and suggestions to improve the site and content so feel free to submit your comments and code. We are interested in providing clear, concise examples or tutorials for classic Zend Framework idioms i.e. configuration, modules, plugins, etc. and will incorporate any suggestions we use with attribution.</p>\r\n<p>This site is meant to continually evolve over time so community contributions are key and we will post problems and solutions as we solve them so others may benefit as well.</p>\r\n<p>Thanks, Kurt Miller</p>','2012-02-11 18:40:38','2012-02-12 23:50:52'),(36,1,'FAQ','<p><strong>Why Zend?</strong></p>\r\n<p>It\'s big. It\'s popular. It can get me a job.</p>','2012-02-11 18:43:03','2012-02-12 23:51:12'),(37,1,'Credits','<p><strong>The following have contributed (knowingly or unwittingly) to YMOZ. A thanks goes out to one and all.</strong></p>','2012-02-15 00:16:43','2012-02-15 00:16:43'),(38,1,'Privacy','<h2>Privacy Policy</h2>\r\n<p>Your privacy is very important to us. Accordingly, we have developed this Policy in order for you to understand how we collect, use, communicate and disclose and make use of personal information. The following outlines our privacy policy.</p>\r\n<ul>\r\n<li>Before or at the time of collecting personal information, we will identify the purposes for which information is being collected.</li>\r\n<li>We will collect and use of personal information solely with the objective of fulfilling those purposes specified by us and for other compatible purposes, unless we obtain the consent of the individual concerned or as required by law.</li>\r\n<li>We will only retain personal information as long as necessary for the fulfillment of those purposes.</li>\r\n<li>We will collect personal information by lawful and fair means and, where appropriate, with the knowledge or consent of the individual concerned.</li>\r\n<li>Personal data should be relevant to the purposes for which it is to be used, and, to the extent necessary for those purposes, should be accurate, complete, and up-to-date.</li>\r\n<li>We will protect personal information by reasonable security safeguards against loss or theft, as well as unauthorized access, disclosure, copying, use or modification.</li>\r\n<li>We will make readily available to customers information about our policies and practices relating to the management of personal information.</li>\r\n</ul>\r\n<p>We are committed to conducting our business in accordance with these principles in order to ensure that the confidentiality of personal information is protected and maintained.</p>','2012-02-15 15:53:34','2012-02-15 15:53:34'),(39,1,'Terms','<h2>Web Site Terms and Conditions of Use</h2>\r\n<h3>1. Terms</h3>\r\n<p>By accessing this web site, you are agreeing to be bound by these web site Terms and Conditions of Use, all applicable laws and regulations, and agree that you are responsible for compliance with any applicable local laws. If you do not agree with any of these terms, you are prohibited from using or accessing this site. The materials contained in this web site are protected by applicable copyright and trade mark law.</p>\r\n<h3>2. Use License</h3>\r\n<ol type=\"a\">\r\n<li>Permission is granted to temporarily download one copy of the materials (information or software) on Your Moment of Zend\'s web site for personal, non-commercial transitory viewing only. This is the grant of a license, not a transfer of title, and under this license you may not:<ol type=\"i\">\r\n<li>modify or copy the materials;</li>\r\n<li>use the materials for any commercial purpose, or for any public display (commercial or non-commercial);</li>\r\n<li>attempt to decompile or reverse engineer any software contained on Your Moment of Zend\'s web site;</li>\r\n<li>remove any copyright or other proprietary notations from the materials; or</li>\r\n<li>transfer the materials to another person or \"mirror\" the materials on any other server.</li>\r\n</ol></li>\r\n<li>This license shall automatically terminate if you violate any of these restrictions and may be terminated by Your Moment of Zend at any time. Upon terminating your viewing of these materials or upon the termination of this license, you must destroy any downloaded materials in your possession whether in electronic or printed format.</li>\r\n</ol>\r\n<h3>3. Disclaimer</h3>\r\n<ol type=\"a\">\r\n<li>The materials on Your Moment of Zend\'s web site are provided \"as is\". Your Moment of Zend makes no warranties, expressed or implied, and hereby disclaims and negates all other warranties, including without limitation, implied warranties or conditions of merchantability, fitness for a particular purpose, or non-infringement of intellectual property or other violation of rights. Further, Your Moment of Zend does not warrant or make any representations concerning the accuracy, likely results, or reliability of the use of the materials on its Internet web site or otherwise relating to such materials or on any sites linked to this site.</li>\r\n</ol>\r\n<h3>4. Limitations</h3>\r\n<p>In no event shall Your Moment of Zend or its suppliers be liable for any damages (including, without limitation, damages for loss of data or profit, or due to business interruption,) arising out of the use or inability to use the materials on Your Moment of Zend\'s Internet site, even if Your Moment of Zend or a Your Moment of Zend authorized representative has been notified orally or in writing of the possibility of such damage. Because some jurisdictions do not allow limitations on implied warranties, or limitations of liability for consequential or incidental damages, these limitations may not apply to you.</p>\r\n<h3>5. Revisions and Errata</h3>\r\n<p>The materials appearing on Your Moment of Zend\'s web site could include technical, typographical, or photographic errors. Your Moment of Zend does not warrant that any of the materials on its web site are accurate, complete, or current. Your Moment of Zend may make changes to the materials contained on its web site at any time without notice. Your Moment of Zend does not, however, make any commitment to update the materials.</p>\r\n<h3>6. Links</h3>\r\n<p>Your Moment of Zend has not reviewed all of the sites linked to its Internet web site and is not responsible for the contents of any such linked site. The inclusion of any link does not imply endorsement by Your Moment of Zend of the site. Use of any such linked web site is at the user\'s own risk.</p>\r\n<h3>7. Site Terms of Use Modifications</h3>\r\n<p>Your Moment of Zend may revise these terms of use for its web site at any time without notice. By using this web site you are agreeing to be bound by the then current version of these Terms and Conditions of Use.</p>\r\n<h3>8. Governing Law</h3>\r\n<p>Any claim relating to Your Moment of Zend\'s web site shall be governed by the laws of the State of California without regard to its conflict of law provisions.</p>\r\n<p>General Terms and Conditions applicable to Use of a Web Site.</p>','2012-02-15 15:55:37','2012-02-15 15:55:37'),(40,1,'Help','<h2 style=\"text-align: center;\">Help? You damn well got that right!</h2>\r\n<p><!--more--></p>\r\n<p style=\"text-align: center;\"><img src=\"/images/uploads/help.jpg\" alt=\"\" width=\"460\" height=\"460\" /></p>','2012-03-10 19:28:15','2012-03-18 22:56:24');
/*!40000 ALTER TABLE `sections` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `site_title` varchar(50) NOT NULL,
  `site_tagline` varchar(100) NOT NULL,
  `site_url` varchar(50) NOT NULL,
  `headlineId` int(11) NOT NULL,
  `homeArticleCount` int(11) NOT NULL,
  `articleCount` int(11) NOT NULL,
  `bookCount` int(11) NOT NULL,
  `latestArticleCount` int(11) NOT NULL,
  `amazonLU` varchar(100) NOT NULL,
  `admArtCnt` int(11) NOT NULL,
  `admComCnt` int(11) NOT NULL,
  `admUserCnt` int(11) NOT NULL,
  `defemail` varchar(40) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;


LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` VALUES (1,'Your Moment of Zend','To know the road ahead, ask those coming back','http://ymozend.com',35,4,5,2,5,'zend',5,4,10,'admin@yoursite.com','2012-03-22 15:43:51','2012-03-24 19:12:10');
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


DROP TABLE IF EXISTS `tag_join`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tag_join` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `article_id` int(11) NOT NULL,
  `keyword_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `article_kwd` (`article_id`,`keyword_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1416 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;


LOCK TABLES `tag_join` WRITE;
/*!40000 ALTER TABLE `tag_join` DISABLE KEYS */;
INSERT INTO `tag_join` VALUES (1338,35,129,'0000-00-00 00:00:00','2012-03-14 19:27:02'),(1346,36,129,'0000-00-00 00:00:00','2012-03-21 18:36:04'),(1347,36,192,'0000-00-00 00:00:00','2012-03-21 18:36:05'),(1348,36,193,'0000-00-00 00:00:00','2012-03-21 18:36:05'),(1349,36,194,'0000-00-00 00:00:00','2012-03-21 18:36:05'),(1363,52,129,'0000-00-00 00:00:00','2012-03-26 20:32:32'),(1364,52,194,'0000-00-00 00:00:00','2012-03-26 20:32:32'),(1371,33,129,'0000-00-00 00:00:00','2012-04-04 19:48:01'),(1384,42,212,'0000-00-00 00:00:00','2012-04-09 02:33:42'),(1412,43,227,'0000-00-00 00:00:00','2012-04-10 16:10:04'),(1413,43,228,'0000-00-00 00:00:00','2012-04-10 16:10:04'),(1414,45,227,'0000-00-00 00:00:00','2012-04-10 16:24:50'),(1415,45,251,'0000-00-00 00:00:00','2012-04-10 16:24:50');
/*!40000 ALTER TABLE `tag_join` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `role` varchar(20) NOT NULL DEFAULT 'user',
  `password` varchar(50) NOT NULL DEFAULT 'password',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;


LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (11,'User2','youremail2@mail.com','admin','70de41cba073f4efca39528e4a40522c5461abc8','2012-01-06 20:08:13','2012-01-31 02:21:38'),(14,'User1','youremail1@mail.com','admin','cce23e185b0b1c2ff0f76b0e9d680de56f53f131','2012-01-09 16:37:33','2012-03-10 18:29:38');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

