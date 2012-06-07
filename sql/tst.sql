
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
  PRIMARY KEY (`id`)
) ENGINE=MEMORY AUTO_INCREMENT=1312 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;


LOCK TABLES `avatars` WRITE;
/*!40000 ALTER TABLE `avatars` DISABLE KEYS */;
INSERT INTO `avatars` VALUES (1288,'01.jpg','2012-02-11 16:15:21','2012-02-11 16:15:21'),(1289,'02.jpg','2012-02-11 16:15:21','2012-02-11 16:15:21'),(1290,'03.gif','2012-02-11 16:15:21','2012-02-11 16:15:21'),(1291,'04.jpg','2012-02-11 16:15:21','2012-02-11 16:15:21'),(1292,'05.jpg','2012-02-11 16:15:21','2012-02-11 16:15:21'),(1293,'06.jpg','2012-02-11 16:15:21','2012-02-11 16:15:21'),(1294,'07.jpg','2012-02-11 16:15:21','2012-02-11 16:15:21'),(1295,'08.jpg','2012-02-11 16:15:21','2012-02-11 16:15:21'),(1296,'09.jpg','2012-02-11 16:15:21','2012-02-11 16:15:21'),(1297,'10.jpg','2012-02-11 16:15:21','2012-02-11 16:15:21'),(1298,'11.jpg','2012-02-11 16:15:21','2012-02-11 16:15:21'),(1299,'12.jpg','2012-02-11 16:15:21','2012-02-11 16:15:21'),(1300,'13.jpg','2012-02-11 16:15:21','2012-02-11 16:15:21'),(1301,'14.jpg','2012-02-11 16:15:21','2012-02-11 16:15:21'),(1302,'15.jpg','2012-02-11 16:15:21','2012-02-11 16:15:21'),(1303,'16.jpg','2012-02-11 16:15:21','2012-02-11 16:15:21'),(1304,'17.jpg','2012-02-11 16:15:21','2012-02-11 16:15:21'),(1305,'18.jpg','2012-02-11 16:15:21','2012-02-11 16:15:21'),(1306,'19.jpg','2012-02-11 16:15:21','2012-02-11 16:15:21'),(1307,'20.gif','2012-02-11 16:15:21','2012-02-11 16:15:21'),(1308,'21.jpg','2012-02-11 16:15:21','2012-02-11 16:15:21'),(1309,'22.jpg','2012-02-11 16:15:21','2012-02-11 16:15:21'),(1310,'23.jpg','2012-02-11 16:15:21','2012-02-11 16:15:21'),(1311,'24.jpg','2012-02-11 16:15:21','2012-02-11 16:15:21');
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
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;


LOCK TABLES `books` WRITE;
/*!40000 ALTER TABLE `books` DISABLE KEYS */;
INSERT INTO `books` VALUES (1,'PHP Objects, Patterns and Practice','Matt Zandstra','/images/amz/PHPObjects.jpg','/store','2012-03-09 17:18:21','2012-03-09 17:18:21'),(3,'Zend Framework, A Beginner\'s Guide','Vikram Vaswani','/images/amz/ZFBG.jpg','/store','2012-03-09 18:55:53','2012-03-09 18:55:53'),(6,'Zend Framework 1.8 Web Application Development','Keith Pope','/images/amz/ZFWAD.jpg','/store','2012-03-09 18:58:46','2012-03-09 18:58:46'),(5,'Beginning PHP and MySQL','W. Jason Gilmore','/images/amz/PHPandMYSQL.jpg','/store','2012-03-09 18:57:23','2012-03-09 18:57:23');
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
  `comment_text` varchar(500) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MEMORY AUTO_INCREMENT=61 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;


LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` VALUES (2,11,21,'wow, pictures....','2012-01-18 12:58:45','2012-01-18 12:58:45'),(4,30,21,'Show off...','2012-01-23 12:54:17','2012-01-23 12:54:17'),(19,14,29,'this is good','2012-01-29 10:16:46','2012-01-29 10:16:46'),(28,14,29,'how about now?','2012-01-29 10:20:32','2012-01-29 10:20:32'),(30,14,29,'but this is good.','2012-01-29 10:25:52','2012-01-29 10:25:52'),(33,14,30,'This is a good comment.','2012-01-29 10:27:20','2012-01-29 10:27:20'),(49,14,30,'Quit your bitchin\'.','2012-01-30 12:27:08','2012-01-30 12:27:08'),(50,11,18,'This comment box has run away and left it\'s background behind!','2012-01-31 18:15:59','2012-01-31 18:15:59'),(52,11,32,'added a bazillion keywords but unique index handled it','2012-02-02 11:13:14','2012-02-02 11:13:14'),(53,11,32,'The ecru background kills the effectiveness of the blue- taupe scheme. A cooler background would be more in keeping with your visual theme.','2012-02-10 16:02:02','2012-02-10 16:02:02'),(55,14,32,'So far I can\'t fault his argument. ','2012-02-11 12:43:55','2012-02-11 12:43:55'),(56,11,33,'That sounds like bullshit to me.','2012-02-11 17:28:54','2012-02-11 17:28:54'),(57,14,33,'Everybody\'s a critic...','2012-02-17 11:24:43','2012-02-17 11:24:43'),(60,29,34,'I just love that gussy.','2012-02-28 12:37:12','2012-02-28 12:37:12');
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
  PRIMARY KEY (`id`)
) ENGINE=MEMORY AUTO_INCREMENT=180 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;


LOCK TABLES `keywords` WRITE;
/*!40000 ALTER TABLE `keywords` DISABLE KEYS */;
INSERT INTO `keywords` VALUES (60,'AAA','2012-01-17 08:17:58','2012-01-17 08:17:58'),(61,'BBB','2012-01-17 08:17:58','2012-01-17 08:17:58'),(62,'CCC','2012-01-17 08:17:58','2012-01-17 08:17:58'),(76,'dog','2012-01-17 11:19:23','2012-01-17 11:19:23'),(77,'cats','2012-01-17 11:19:23','2012-01-17 11:19:23'),(88,'text','2012-01-17 13:57:37','2012-01-17 13:57:37'),(92,'dogs','2012-01-17 14:24:54','2012-01-17 14:24:54'),(100,'textile','2012-01-18 12:00:29','2012-01-18 12:00:29'),(116,'test','2012-01-18 13:19:20','2012-01-18 13:19:20'),(124,'DDD','2012-01-19 11:53:02','2012-01-19 11:53:02'),(129,'zend','2012-01-26 15:09:59','2012-01-26 15:09:59'),(132,'birds','2012-01-26 16:28:10','2012-01-26 16:28:10'),(133,'bats','2012-01-26 16:28:10','2012-01-26 16:28:10'),(137,'lorem','2012-01-26 16:29:06','2012-01-26 16:29:06'),(138,'ipsum','2012-01-26 16:29:06','2012-01-26 16:29:06'),(152,'Cato','2012-01-26 16:32:09','2012-01-26 16:32:09'),(158,'disorders','2012-01-26 16:34:02','2012-01-26 16:34:02'),(159,'tutorial','2012-01-26 16:34:02','2012-01-26 16:34:02'),(173,'release','2012-02-03 16:06:03','2012-02-03 16:06:03'),(178,'cloud','2012-02-03 16:08:42','2012-02-03 16:08:42'),(179,'delete','2012-03-01 16:25:41','2012-03-01 16:25:41');
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
) ENGINE=MEMORY AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;


LOCK TABLES `menus` WRITE;
/*!40000 ALTER TABLE `menus` DISABLE KEYS */;
INSERT INTO `menus` VALUES (1,'main','Home','/',1,'0000-00-00 00:00:00','2012-03-25 05:35:59'),(2,'main','Blog','/blog',2,'2012-03-25 06:12:02','2012-03-25 06:12:02'),(3,'main','Books','/books',3,'2012-03-25 06:13:09','2012-03-25 06:13:09'),(4,'admin','Articles','/admin/article',1,'2012-03-25 07:22:10','2012-03-25 07:22:10'),(5,'admin','Comments','/admin/comment',2,'2012-03-25 07:24:13','2012-03-25 07:24:13'),(6,'admin','Users','/admin/user',3,'2012-03-25 07:24:46','2012-03-25 07:24:46'),(7,'admin','Sections','/admin/section',4,'2012-03-25 07:25:34','2012-03-25 07:25:34'),(8,'admin','Config','/admin/setting',6,'2012-03-25 07:26:07','2012-03-25 07:26:07'),(9,'admin','Books','/admin/book',7,'2012-03-25 07:26:48','2012-03-25 07:26:48'),(12,'admin','Search','/admin/index/search',8,'2012-03-25 07:31:49','2012-03-25 08:37:56'),(11,'admin','Menus','/admin/menu',5,'2012-03-25 07:30:19','2012-03-25 07:30:19'),(13,'admin','Latest Version','http://ymozend.dev/version',9,'2012-04-02 22:55:58','2012-04-02 22:55:58'),(14,'admin','XmlRpc','/xmlrpc/client',10,'2012-06-01 22:19:36','2012-06-01 22:19:36');
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
  `bio_text` varchar(500) DEFAULT NULL,
  `avatar` varchar(50) NOT NULL DEFAULT 'default.jpg',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MEMORY AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;


LOCK TABLES `profiles` WRITE;
/*!40000 ALTER TABLE `profiles` DISABLE KEYS */;
INSERT INTO `profiles` VALUES (1,14,'User1','Findleton','','Lowly code scrubber','http://arbalestmedia.com','User1 is a former Navy Squeal, expert rated small craft pilot, discredited creator of Facebook and is an all around mensch. You can contact him on his site.','D55BqczsEGIe/myShot.jpg','2012-02-09 18:00:59','2012-02-09 18:00:59'),(2,11,'Kurt','Miller','Eric','programmer','www.ymozend.com','Too long without a job; I\'ve taken to robbing banks and convenience stores.','01.jpg','2012-02-10 08:47:28','2012-02-10 12:06:30'),(6,25,'Gus','Schwartz','','','','','default.jpg','2012-02-28 12:29:45','2012-02-28 12:29:45');
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
  PRIMARY KEY (`id`)
) ENGINE=MEMORY AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;


LOCK TABLES `registrations` WRITE;
/*!40000 ALTER TABLE `registrations` DISABLE KEYS */;
INSERT INTO `registrations` VALUES (4,44,'gg50GtOy1cs3qRkYaqcV','2012-02-15 15:39:12','2012-02-15 15:39:12'),(5,32,'fV75ypryAmTqtuxEUwh3','2012-02-27 10:05:43','2012-02-27 10:05:43');
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
  `section_text` varchar(500) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MEMORY AUTO_INCREMENT=100 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;


LOCK TABLES `sections` WRITE;
/*!40000 ALTER TABLE `sections` DISABLE KEYS */;
INSERT INTO `sections` VALUES (35,1,'About','<p>Welcome to <strong>Your Moment of Zend.</strong> I\'m your host, Kurt Miller. I\'m a programmer, musician and all around nice guy. This site is my effort at jumping back into the Zend pool after a several-year hiatus. Hopefully you\'ll find the site entertaining, educational and, with luck, enlightening.</p>','2012-02-12 10:40:38','2012-02-13 15:50:52'),(36,1,'FAQ','<p><strong>Why Zend?</strong></p>\r\n<p>It\'s big. It\'s popular. It can get me a job.</p>','2012-02-12 10:43:03','2012-02-13 15:51:12'),(37,1,'Credits','<p><strong>The following have contributed (knowingly or unwittingly) to YMOZ. A thanks goes out to one and all.</strong></p><p><a title=\"Ben Nadel\" href=\"http://www.bennadel.com/coldfusion/privacy-policy-generator.htm\" target=\"_blank\">Ben Nadel</a>: Sweet little Privacy Policy/Terms of Service generator.</p>\r\n<p>The fine folks over at <a title=\"ccSimpleUploader\" href=\"http://www.creativecodedesign.com/\" target=\"_blank\">Creative Code Design</a> for the tinyMCE plugin, ccSimpleUploader. Nice job, ','2012-02-15 16:16:43','2012-02-15 16:16:43'),(38,1,'Privacy','<h2>Privacy Policy</h2>\r\n<p>Your privacy is very important to us. Accordingly, we have developed this Policy in order for you to understand how we collect, use, communicate and disclose and make use of personal information. The following outlines our privacy policy.</p>\r\n<ul>\r\n<li>Before or at the time of collecting personal information, we will identify the purposes for which information is being collected.</li>\r\n<li>We will collect and use of personal information solely with the objective of f','2012-02-16 07:53:34','2012-02-16 07:53:34'),(39,1,'Terms','<h2>Web Site Terms and Conditions of Use</h2>\r\n<h3>1. Terms</h3>\r\n<p>By accessing this web site, you are agreeing to be bound by these web site Terms and Conditions of Use, all applicable laws and regulations, and agree that you are responsible for compliance with any applicable local laws. If you do not agree with any of these terms, you are prohibited from using or accessing this site. The materials contained in this web site are protected by applicable copyright and trade mark law.</p>\r\n<h3>2','2012-02-16 07:55:37','2012-02-16 07:55:37'),(79,1,'Help','<p>Welcome to <strong>Your Moment of Zend.</strong> I\'m your host, Kurt Miller. I\'m a programmer, musician and all around nice guy. This site is my effort at jumping back into the Zend pool after a several-year hiatus. Hopefully you\'ll find the site entertaining, educational and, with luck, enlightening.</p>','2012-02-12 10:40:38','2012-02-13 15:50:52'),(99,0,'Test','<p>Welcome to <strong>Your Moment of Zend.</strong> I\'m your host, Kurt Miller. I\'m a programmer, musician and all around nice guy. This site is my effort at jumping back into the Zend pool after a several-year hiatus. Hopefully you\'ll find the site entertaining, educational and, with luck, enlightening.</p>','2012-02-12 10:40:38','2012-02-13 15:50:52');
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
) ENGINE=MEMORY AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;


LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` VALUES (1,'Your Moment of Zend','To know the road ahead, ask those coming back','http://ymozend.com',33,3,3,3,6,'zend',5,4,10,'admin@yoursite.com','0000-00-00 00:00:00','2012-03-22 22:43:51');
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
  PRIMARY KEY (`id`)
) ENGINE=MEMORY AUTO_INCREMENT=1244 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;


LOCK TABLES `tag_join` WRITE;
/*!40000 ALTER TABLE `tag_join` DISABLE KEYS */;
INSERT INTO `tag_join` VALUES (79,17,76,'0000-00-00 00:00:00','2012-01-17 11:19:38'),(80,17,77,'0000-00-00 00:00:00','2012-01-17 11:19:38'),(81,17,60,'0000-00-00 00:00:00','2012-01-17 11:19:38'),(89,16,60,'0000-00-00 00:00:00','2012-01-17 13:57:53'),(90,16,61,'0000-00-00 00:00:00','2012-01-17 13:57:53'),(91,16,88,'0000-00-00 00:00:00','2012-01-17 13:57:53'),(96,18,92,'0000-00-00 00:00:00','2012-01-17 15:44:22'),(97,18,77,'0000-00-00 00:00:00','2012-01-17 15:44:22'),(98,18,60,'0000-00-00 00:00:00','2012-01-17 15:44:22'),(99,18,88,'0000-00-00 00:00:00','2012-01-17 15:44:22'),(102,19,100,'0000-00-00 00:00:00','2012-01-18 12:07:33'),(103,20,100,'0000-00-00 00:00:00','2012-01-18 12:08:49'),(116,22,116,'0000-00-00 00:00:00','2012-01-18 13:19:21'),(117,22,60,'0000-00-00 00:00:00','2012-01-18 13:19:21'),(118,22,88,'0000-00-00 00:00:00','2012-01-18 13:19:21'),(119,21,100,'0000-00-00 00:00:00','2012-01-18 13:20:00'),(123,15,60,'0000-00-00 00:00:00','2012-01-19 11:53:02'),(124,15,61,'0000-00-00 00:00:00','2012-01-19 11:53:02'),(125,15,62,'0000-00-00 00:00:00','2012-01-19 11:53:02'),(126,15,124,'0000-00-00 00:00:00','2012-01-19 11:53:02'),(132,23,100,'0000-00-00 00:00:00','2012-01-22 09:11:38'),(133,23,116,'0000-00-00 00:00:00','2012-01-22 09:11:39'),(134,26,129,'0000-00-00 00:00:00','2012-01-26 15:09:59'),(144,27,129,'0000-00-00 00:00:00','2012-01-26 16:29:57'),(145,27,116,'0000-00-00 00:00:00','2012-01-26 16:29:57'),(146,27,137,'0000-00-00 00:00:00','2012-01-26 16:29:57'),(165,24,129,'0000-00-00 00:00:00','2012-01-27 09:32:45'),(1118,28,129,'0000-00-00 00:00:00','2012-02-03 19:09:39'),(1119,28,173,'0000-00-00 00:00:00','2012-02-03 19:09:39'),(1179,30,116,'0000-00-00 00:00:00','2012-02-09 21:22:35'),(1180,30,158,'0000-00-00 00:00:00','2012-02-09 21:22:35'),(1181,30,159,'0000-00-00 00:00:00','2012-02-09 21:22:35'),(1182,25,60,'0000-00-00 00:00:00','2012-02-09 21:23:37'),(1183,25,116,'0000-00-00 00:00:00','2012-02-09 21:23:37'),(1184,25,132,'0000-00-00 00:00:00','2012-02-09 21:23:37'),(1185,25,133,'0000-00-00 00:00:00','2012-02-09 21:23:37'),(1195,31,88,'0000-00-00 00:00:00','2012-02-12 08:51:55'),(1196,31,138,'0000-00-00 00:00:00','2012-02-12 08:51:55'),(1223,35,116,'0000-00-00 00:00:00','2012-02-16 12:53:42'),(1226,33,129,'0000-00-00 00:00:00','2012-02-17 09:21:45'),(1237,32,178,'0000-00-00 00:00:00','2012-02-20 16:42:53'),(1238,29,60,'0000-00-00 00:00:00','2012-02-27 10:45:50'),(1239,29,129,'0000-00-00 00:00:00','2012-02-27 10:45:50'),(1240,29,137,'0000-00-00 00:00:00','2012-02-27 10:45:50'),(1241,29,138,'0000-00-00 00:00:00','2012-02-27 10:45:50'),(1242,29,152,'0000-00-00 00:00:00','2012-02-27 10:45:50'),(1243,256,179,'0000-00-00 00:00:00','2012-03-01 16:25:41');
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
  PRIMARY KEY (`id`)
) ENGINE=MEMORY AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;


LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (11,'User2','youremail2@mail.com','admin','dd002afa986524378fdf2251272b9c5ee12379ec','2012-01-07 12:08:13','2012-01-31 18:21:38'),(14,'bucky','youremail1@mail.com','admin','dd002afa986524378fdf2251272b9c5ee12379ec','2012-01-10 08:37:33','2012-02-10 12:04:17'),(25,'gussy','gs@mail.com','author','fd717d411976a2d48f261721de2300c439f71549','2012-01-14 09:22:26','2012-01-24 15:02:02'),(26,'user','user4@email.com','user','70de41cba073f4efca39528e4a40522c5461abc8','2012-01-19 00:40:19','2012-01-19 00:40:19'),(29,'nancy','nn@mail.com','user','fd717d411976a2d48f261721de2300c439f71549','2012-01-21 10:21:55','2012-01-21 10:21:55'),(30,'herby','hb@mail.com','author','fd717d411976a2d48f261721de2300c439f71549','2012-01-23 12:52:09','2012-01-23 12:52:09'),(31,'dham','dh@mail.com','author','fd717d411976a2d48f261721de2300c439f71549','2012-02-01 18:08:24','2012-02-01 18:08:24'),(32,'testing','testing@gmail.com','admin','dd002afa986524378fdf2251272b9c5ee12379ec','2012-02-27 10:05:43','2012-02-27 10:05:43');
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

