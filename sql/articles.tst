
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
  `article_text` varchar(500) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MEMORY AUTO_INCREMENT=257 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;


LOCK TABLES `articles` WRITE;
/*!40000 ALTER TABLE `articles` DISABLE KEYS */;
INSERT INTO `articles` VALUES (18,25,0,27,'(Testing) Article Three (Again)','cats are **cute**. dogs are **cute**. kurt is... __well__, cats are cute.  Hmmm.....<p><!--more--></p>Though the man has other redeeming qualities, I\'m sure.','2012-01-17 14:24:54','2012-01-24 15:02:39'),(21,11,0,47,'(Testing) Textile testing','*test* and test and **test**\r\n\r\n<p><!--more--></p>* An item in a bulleted (unordered) list\r\n* Another item in a bulleted list\r\n** Second Level\r\n** Second Level Items\r\n*** Third level\r\n\r\n|_. Header |_. Header |_. Header |\r\n| Cell 1 | Cell 2 | Cell 3 |\r\n| Cell 1 | Cell 2 | Cell 3 |\r\n\r\n_emphasized_ (e.g., italics)\r\n\r\nh1(#id). An HTML first-level heading\r\n\r\nh2. An HTML second-level heading\r\n\r\nh3. An HTML third-level heading\r\n\r\nh4. An HTML fourth-level heading\r\n\r\nh5. An HTML fifth-level heading\r\n\r\nh6','2012-01-18 12:12:22','2012-01-18 12:12:22'),(23,11,0,20,'(Testing) This Could End Badly','hn. My First Textile Effort<p><!--more--></p>I\'m just going by the _help doc_ embedded in the editor page so bear with me for a while until I know what the heck I\'m doing. With luck __no one will get hurt.__\r\nThe above was just some text with some formatting tossed in. This is just some text too. I\'ll try it with @p@ tags in just a bit but I wanted to get some content here without resorting to \"Jackson Ipsum\" just yet.\r\n\r\np. Here\'s my first real paragraph. Soon I will be typing my second paragra','2012-01-22 09:11:38','2012-01-22 09:11:38'),(25,11,0,2,'(Testing) Doing My Duty','<p>We need articles. Well, that\'s what I\'m here for. If you don\'t like *Lorem Ipsum* text you\'re in big trouble. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum viverra, nisi vitae tincidunt bibendum, sapien ante ullamcorper mi, ut laoreet augue leo non felis. Integer facilisis erat non ligula feugiat adipiscing et eget velit. Vivamus porttitor sem sed sapien feugiat porttitor dignissim erat pellentesque. Aenean aliquam, ligula a condimentum egestas, ante diam tristique arcu,','2012-01-26 16:28:10','2012-01-26 16:28:10'),(26,14,0,1,'(Testing) The Article','Lorem Ipsum* text you\'re in big trouble.\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum viverra, nisi vitae tincidunt bibendum, sapien ante ullamcorper mi, ut laoreet augue leo non felis. Integer facilisis erat non ligula feugiat adipiscing et eget velit. Vivamus porttitor sem sed sapien feugiat porttitor dignissim erat pellentesque. Aenean aliquam, ligula a condimentum egestas, ante diam tristique arcu, id tristique massa nisl eget turpis. Vestibulum consequat, purus at ','2012-01-26 16:28:10','2012-01-26 16:28:10'),(27,14,0,2,'(Testing) This is Hard to Keep Straight','Duis condimentum, mauris in consequat commodo, metus eros fermentum libero, id condimentum mauris massa in sapien. Aenean vel dui sem. Aenean id nisl tortor. Sed et ipsum quam. Proin vestibulum varius velit et eleifend. In eget interdum sapien. Donec posuere lorem vitae tortor sodales a volutpat nibh bibendum. Curabitur felis metus, blandit non adipiscing sed, vehicula et sem. In id neque ipsum, ac dignissim purus. <p><!--more--></p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestib','2012-01-26 16:29:57','2012-01-26 16:29:57'),(28,14,1,25,'(Testing) The Hits Just Keep Coming','We are pleased to announce that there will be a Zend Framework 1.12 release!\r\n\r\nAs such, we will be reviewing proposals for any new components which proposers are confident can be completed in time for a release timed in December!<p><!--more--></p>If you are sitting on something you would like to see included, or are interested in reviving a proposal to have included in 1.12 (including from the archived proposals list),\n please get in touch with the CR-Team (zf-crteam@zend.com),\n and/or move you','2012-01-26 16:30:58','2012-01-26 16:30:58'),(29,14,1,49,'(Testing) That Cato Was Whacked','<p><br /><img style=\"float: left; margin: 9px;\" src=\"/images/uploads/pen_3_sm.gif\" alt=\"\" />Donec ut nisl lectus. Quisque tempus vulputate sodales. Praesent malesuada porttitor fringilla. Nulla vitae urna nec arcu placerat adipiscing. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Vestibulum condimentum vehicula arcu, quis viverra risus posuere eget. Suspendisse viverra odio ac magna fringilla placerat vel at nibh. Aenean sodales est nec magna imperdiet a','2012-01-26 16:32:09','2012-01-26 16:32:09'),(30,11,0,69,'(Testing) I\'m Getting an RSD From All This Typing','<p>Curabitur in lacus risus. Pellentesque sit amet sem vel erat euismod accumsan et a arcu. Vestibulum nunc enim, tempor in feugiat eget, porttitor et sapien. Integer a nunc sed nunc lacinia aliquet vel eget lectus. Ut et felis id nibh ultrices tincidunt ut vel neque. Proin eu justo libero. Integer dignissim interdum velit id facilisis. Suspendisse potenti. Nunc quam leo, mattis et commodo ut, accumsan ac lacus. Morbi vestibulum, nibh sed mollis faucibus, eros tellus facilisisinterdum velit id f','2012-01-26 16:34:02','2012-01-26 16:34:02'),(32,11,1,73,'(Testing) Manage cloud infrastructures using Zend Framework','<p><img style=\"float: left; margin-top: 9px; margin-bottom: 9px; margin-left: 5px; margin-right: 5px;\" src=\"http://static.zend.com/img/logo.gif\" alt=\"Zend Cloud\" width=\"193\" height=\"67\" />Recently, the Zend Framework community has developed a new component for cloud services: Zend_Cloud_Infrastructure. This component was provided to manage cloud infrastructures, with a common interface for multiple vendors. In this article we will present the basic usage of this new component with some examples ','2012-02-02 11:11:22','2012-02-02 11:11:22'),(33,14,1,157,'(Testing) Zend FlashMessenger Fun','<p><img style=\"float: left; margin: 10px;\" src=\"http://framework.zend.com/images/logo_small.gif\" alt=\"Zend, baby!\" width=\"123\" height=\"23\" />I ran into the situation where I had two forms on a page, each of which needed to have some FlashMessenger feedback. Unfortunately, even though I changed each of the view variable names to use for assigning the messages to, each of them made the same call to the getMessages() method so whatever message was in queue would display in both places.</p>\r\n<p>Not ','2012-02-03 11:11:41','2012-02-03 11:11:41'),(34,25,1,15,'(Testing) The Proverbial Test Post','<p>The need for test posts from different users of different roles is an ongoing neccessity for testing purposes. Hence, this here post. It\'s doesn\'t need to do much more than merely exist, which now, thanks to the magic of the Inter-webs, it does.</p>\r\n<p>Thank you very much.</p>','2012-02-28 09:42:02','2012-02-28 09:42:02'),(256,14,0,0,'(Testing) Delete Me','<p>Delete this article.</p>','2012-03-01 16:25:41','2012-03-01 16:25:41');
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

