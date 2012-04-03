
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
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;


LOCK TABLES `articles` WRITE;
/*!40000 ALTER TABLE `articles` DISABLE KEYS */;
INSERT INTO `articles` VALUES (33,14,1,225,'Zend FlashMessenger Namespacing Page with Multiple Forms','<p><img style=\"float: left; margin: 10px;\" src=\"http://framework.zend.com/images/logo_small.gif\" alt=\"Zend, baby!\" width=\"123\" height=\"23\" />I ran into the situation where I had two forms on a page, each of which needed to have some FlashMessenger feedback. Unfortunately, even though I changed each of the view variable names to use for assigning the messages to, each of them made the same call to the getMessages() method so whatever message was in queue would display in both places.</p>\r\n<p>Not what I was looking for. But don\'t despair, FlashMessenger namespacing comes to the rescue.</p>\r\n<p><!--more--></p>\r\n<p>In my controller I previously used the following:</p>\r\n<pre class=\"brush: php\">$this-&gt;_helper-&gt;getHelper(\'FlashMessenger\')-&gt;addMessage(\'Some message.\');</pre>\r\n<p>and then sent it to the view thusly:</p>\r\n<pre class=\"brush: php\">$this-&gt;view-&gt;messages = $this-&gt;_helper-&gt;getHelper(\'FlashMessenger\')-&gt;getMessages();</pre>\r\n<p>Partitioning the messages into their own namespace turns out to be ridiculously easy.</p>\r\n<pre class=\"brush: php\">$flasher = $this-&gt;_helper-&gt;getHelper(\'FlashMessenger\');\r\n$flasher-&gt;setNameSpace(\'config\');\r\n$flasher-&gt;addMessage(\'Some message.\');</pre>\r\n<p>and</p>\r\n<pre class=\"brush: php\">$this-&gt;view-&gt;messages = $flasher-&gt;getMessages();</pre>\r\n<p>Short and sweet.</p>','2012-03-09 20:28:33','2012-03-19 18:48:07'),(35,14,1,78,'And So It Begins','<p><a title=\"Your Moment of Zend\" href=\"/images/uploads/zendgarden.jpg\"><img style=\"float: left; margin: 7px;\" src=\"/images/uploads/zendgardenSM.jpg\" alt=\"Your Moment of Zend\" /></a></p>\r\n<h3><em>\"What is this \'moment of Zend\' of which you speak?\"</em></h3>\r\n<p>I\'m glad you asked.</p>\r\n<p>Hi, I\'m User1, one of the co-conspirators bringing you YMOZ. Since this is my maiden post I\'ll try to be gentle and not end up sending you screaming for your mama with vows of complete Zend abstinence spilling from you lips.</p>\r\n<p>Yeah, that\'s right, it\'s not one of those Zend sites where all is praise and drooling sycophancy over the merits and virtues of the <a title=\"Zend Framework\" href=\"http://framework.zend.com/\" target=\"_blank\">Zend Framework</a> and why all roads begin, end and circumambulate at the PHP Mecca that is ZF. No, not one of those sites at all.</p><p><!--more--></p><p>Don\'t get me wrong, this entire site was built using ZF. And while the site has perhaps&nbsp;more than it\'s fair share of wonkiness that can hardly be laid at the feet of the ZF team. No, the PHP programming world is much better off with it than without it. But it\'s definitely a two-edged sword, like a fine piece of equipment you bring home from the hardware store that has \"some assembly required\" only to find out the instructions are in Swazi. Powerful, yes, but not without its warts and unprotected sharp edges. \'Caveat scriptor\' as the bard always says.</p>\r\n<p>Which brings us back to \'Your Moment of Zend,\' a site we hope will give you a chance to learn, comment, vent, contribute and generally become more enlightened regarding that 500 pound gorilla browbeating the other simians in the PHP pool.</p>\r\n<p>So, I\'ll take you gently on the nickle tour and talk about what YMOZ is, what you can expect and where we hope to be headed if things go well. (I know, that\'s why I said \'hope\'.)</p>\r\n<h3>That YMOZ thingy</h3>\r\n<p>YMOZ is actually several things at once: a blog (hopefully obviously) first and foremost, but to us it\'s also a calling card, a proof of concept, a marketing device, a sandbox, a workshop, a place to give back to the community and various and sundry other things that I\'ll refrain from boring you with. Just let it be said that its purpose is manifold.</p>\r\n<p>Pretty ambitious for a venue (blogs) that\'s supposed to be dead, eh?</p>\r\n<h3>Setting Expectations</h3>\r\n<p>That\'s what it is to us. What you can expect of YMOZ, hopefully, is a place where you can share your love/hate relationship with the platform we\'ve all come to know and love, Zend Framework. We\'ll be posting rants (when deemed justified,) insights that we\'ve picked up putting this beasty together, links to other helpful sites and articles, and other germane items that strike our fancy as time permits.</p>\r\n<p>You have to register to comment but it\'s fairly painless (and besides, we needed to show we knew how to do the \'captcha\' thing, as vilified as the practice is, and to get an email response process working.) Comments are moderated at this point but we\'ve got Akismet turned up pretty high so that could change in a heartbeat. If you\'d like to submit articles or become an author just let us know. No&nbsp;guarantees&nbsp;but if it\'s just us the output will be pretty meager so contributors are welcome.</p>\r\n<h3>Welcome To The Future (now go home)</h3>\r\n<p>THE SITE WILL CHANGE! YMOZ is not for the faint of heart. Things will get added, other things will go away, links will magically appear while pages will mysteriously disappear. This is a working site so don\'t get too comfy. And if shit breaks hopefully it won\'t be the contact form and you can send us nasty-grams.</p>\r\n<p>The future will bring things like the site code being available on <a title=\"github\" href=\"https://github.com/kurtericmiller\" target=\"_blank\">github.com</a>. Not sure when but it should be soon and we\'ll let you know when it is. Then you can really plow into us. Fun, neh?</p>\r\n<p>As the more observant amongst you will have noticed the site can generously be described as being unencumbered with an overabundance of JavaScript. That\'s a direct result of the good old design paradigm of HTML, CSS, JavaScript, in that order. The first two are fairly well covered while the latter is on a back burner but it\'s creeping up even as you read this.</p>\r\n<p>And not to be left in the digital dust, design ruminations on how to make the site available in the mobile realm are already stirring in our febrile minds.</p>\r\n<h3>This Way To See The Mighty Egress</h3>\r\n<p>Meanwhile, click around, read a good book (available on our handy <a title=\"Store\" href=\"/store\">Store</a> page,) and let us know what you think.</p>','2012-03-09 20:25:33','2012-03-19 18:48:07'),(36,14,1,59,'Zend Bootstrap PhpUnit Testing Errors','<p><a title=\"Sisyphus\" href=\"http://en.wikipedia.org/wiki/Sisyphus\" target=\"_blank\"><img style=\"float: left;\" src=\"/images/uploads/sysiphus.png\" alt=\"Sisyphus Ahead\" /></a></p>\r\n<h3>An Uphill Battle</h3>\r\n<p>Granted, I\'m new to Zend Framework, PHP and PHPUnit but, really, does it have to be such a grind to discover the solutions to what seem like fundamental problems? If you\'ve encountered similar problems and know of slicker solutions please don\'t hesitate to comment. I can always use the help.</p>\r\n<p>In my case it was missing default routes and the bootstrap parameter not getting set in the front controller, both, I suspect, artifacts from <span style=\"font-family: monospace;\">$aplication-&gt;bootstrap()-&gt;run()</span> not being run but that\'s just a guess on my part. More informed opinions are welcome.</p>\r\n<p>Read on for information on how we got around these annoying errors.</p>\r\n<p><!--more--></p>\r\n<h3>No Bootstrap? How Can It Be?</h3>\r\n<p>This one was a real head-scratcher. The test was for a controller plugin that made the following call:</p>\r\n<pre>$front = Zend_Controller_Front::getInstance();<br />$layout = $front-&gt;getParam(\'bootstrap\')-&gt;getResource(\'layout\');</pre>\r\n<p>When the test runs it completely craps out with \"Fatal error: Call to a member function getResource() on a non-object in ...\" and points right to the $layout assignment above. It took a considerable amount of sleuthage to determine the problem was that, in fact, the frontcontroller\'s \'bootstrap\' parameter was not being set at any time during the test run. What?</p>\r\n<p>To me this was like telling a 4-year-old that Santa Claus was a complete fabrication, a mere fantasy, a phantasm, a pernicious plot perpetrated by parents to practice mind control on 4-year-olds. Disturbing, to say the least. I thought that \'bootstrap\' was intrinsic to the frontcontroller. Not in the least as it turns out.</p>\r\n<p>To cut to the chase, I ended up adding it manually in the setUp() function.</p>\r\n<pre class=\"brush: php\">    public function setUp()\r\n    {\r\n        $this-&gt;bootstrap = new Zend_Application(\r\n            APPLICATION_ENV, \r\n            APPLICATION_PATH . \'/configs/application.ini\');\r\n        parent::setUp();\r\n        $frontController = $this-&gt;getFrontController();\r\n        $frontController\r\n            -&gt;setParam(\'bootstrap\', $this\r\n            -&gt;bootstrap\r\n            -&gt;getBootstrap());\r\n    }\r\n</pre>\r\n<p>(You\'ll notice no callback function in the $this-&gt;boostrap assignment, a la the <a title=\"Zend Framework Testing Documentation\" href=\"http://framework.zend.com/manual/en/zend.test.phpunit.html\" target=\"_blank\">Zend Framework documentation</a>. I think that unless you have something specific you want to accomplish you should just keep it simple and the above seems pretty straight forward.)</p>\r\n<p>This did the trick but if you know of a more elegant solution please leave it in the comments.</p>\r\n<h3>Those Pesky Missing Default Routes</h3>\r\n<p>Something that might catch you unawares (it certainly did me) is the fact that default routes don\'t seem to load in the normal course of PHPUnit testing. I started receiving the following error and had a really enlightening time figuring out what the hell was going on:</p>\r\n<ul>\r\n<li>\"Zend_Controller_Router_Exception: Route default is not defined\"</li>\r\n</ul>\r\n<p>No default routes getting loaded? Yet another precious preconceived notion getting smashed upon the cruel rocks of empirical data. One more addition to our friendly setUp() method resolved things for me.</p>\r\n<pre class=\"brush: php\">    public function setUp()\r\n    {\r\n        $this-&gt;bootstrap = new Zend_Application(\r\n            APPLICATION_ENV, \r\n            APPLICATION_PATH . \'/configs/application.ini\');\r\n        parent::setUp();\r\n        $frontController = $this-&gt;getFrontController();\r\n        $frontController\r\n            -&gt;setParam(\'bootstrap\', $this\r\n            -&gt;bootstrap\r\n            -&gt;getBootstrap());\r\n        $router = $frontController-&gt;getRouter();\r\n        $router-&gt;addDefaultRoutes();\r\n    }\r\n</pre>\r\n<p>The above is strung out over several lines for clarity\'s sake and of course can be strung into one, long, indecipherable call depending on your needs.</p>\r\n<h3>Is There A Better Way?</h3>\r\n<p>These fixes work for me. Just FYI, as far as I can tell these need to be added after the parent::setup() call. YMMV.</p>\r\n<p>Is there a better way? I\'m sure there is. We\'re talking about PHP 5+ here where there\'s 10 ways to do everything. As I said if you want to pitch in your 2&cent; feel free to do so at length in the comments.</p>','2012-03-11 18:29:06','2012-03-19 18:48:07');
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;


LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=201 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;


LOCK TABLES `keywords` WRITE;
/*!40000 ALTER TABLE `keywords` DISABLE KEYS */;
INSERT INTO `keywords` VALUES (129,'zend','2012-01-25 23:09:59','2012-01-25 23:09:59'),(192,'php','2012-03-11 19:27:48','2012-03-11 19:27:48'),(193,'phpunit','2012-03-11 19:27:48','2012-03-11 19:27:48'),(194,'testing','2012-03-11 19:27:48','2012-03-11 19:27:48'),(198,'new','2012-03-25 22:10:37','2012-03-25 22:10:37'),(199,'key','2012-03-25 22:10:37','2012-03-25 22:10:37'),(200,'words','2012-03-25 22:10:37','2012-03-25 22:10:37');
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
INSERT INTO `profiles` VALUES (1,14,'User1','Findleton','','This and that, but mostly the other thing...','http://www.arbalestmedia.com','With over 30 years experience in the tech industry, User1 still thinks this stuff is pretty cool. Building this site is his first in-depth foray into the worlds of PHP and Zend Framework. Let\'s just say it\'s been character building and leave it at that. You can contact User1 on his personal website.','_9tE0STdr1tbE/headshotMd-150x150.jpg','2012-02-09 02:00:59','2012-02-09 02:00:59'),(2,11,'Kurt','Miller','Eric','programmer','http://www.ymozend.com','Developed Your Moment of Zend blogging site to assist the Zend Framework community members with PHP coding techniques. Site provides examples, tutorials, and discussion of best practices for site development, testing, and deployment with PHP and Zend Framework. YMOZ utilizes HTML5, CSS3/Sass, Dojo, JQuery, a custom domain layer with MySQL back end, and PHPUnit/Selinium for testing.  Currently deploying to www.ymozend.com.','18.jpg','2012-02-09 16:47:28','2012-02-09 20:06:30');
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
INSERT INTO `settings` VALUES (1,'Your Moment of Zend','To know the road ahead, ask those coming back','http://ymozend.com',35,3,3,6,'zend',5,4,10,'admin@yoursite.com','2012-03-22 15:43:51','2012-03-24 19:12:10');
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
) ENGINE=InnoDB AUTO_INCREMENT=1371 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;


LOCK TABLES `tag_join` WRITE;
/*!40000 ALTER TABLE `tag_join` DISABLE KEYS */;
INSERT INTO `tag_join` VALUES (1338,35,129,'0000-00-00 00:00:00','2012-03-14 19:27:02'),(1346,36,129,'0000-00-00 00:00:00','2012-03-21 18:36:04'),(1347,36,192,'0000-00-00 00:00:00','2012-03-21 18:36:05'),(1348,36,193,'0000-00-00 00:00:00','2012-03-21 18:36:05'),(1349,36,194,'0000-00-00 00:00:00','2012-03-21 18:36:05'),(1352,33,129,'0000-00-00 00:00:00','2012-03-21 18:38:35'),(1358,40,198,'0000-00-00 00:00:00','2012-03-25 22:10:40'),(1359,40,199,'0000-00-00 00:00:00','2012-03-25 22:10:40'),(1360,40,200,'0000-00-00 00:00:00','2012-03-25 22:10:40'),(1363,52,129,'0000-00-00 00:00:00','2012-03-26 20:32:32'),(1364,52,194,'0000-00-00 00:00:00','2012-03-26 20:32:32'),(1365,38,192,'0000-00-00 00:00:00','2012-03-29 00:31:17'),(1366,38,193,'0000-00-00 00:00:00','2012-03-29 00:31:17'),(1367,38,129,'0000-00-00 00:00:00','2012-03-29 00:31:17'),(1368,39,199,'0000-00-00 00:00:00','2012-03-29 00:33:41'),(1369,39,198,'0000-00-00 00:00:00','2012-03-29 00:33:41'),(1370,39,200,'0000-00-00 00:00:00','2012-03-29 00:33:41');
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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;


LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (11,'User2','youremail2@mail.com','admin','70de41cba073f4efca39528e4a40522c5461abc8','2012-01-06 20:08:13','2012-01-31 02:21:38'),(14,'User1','youremail1@mail.com','admin','cce23e185b0b1c2ff0f76b0e9d680de56f53f131','2012-01-09 16:37:33','2012-03-10 18:29:38'),(15,'admin','admin@mail.com','admin','c1cd20da5452c0d370794759cd151058ac189f2c','2012-03-23 16:18:26','2012-03-23 16:18:26');
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

