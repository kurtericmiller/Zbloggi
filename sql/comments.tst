
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

