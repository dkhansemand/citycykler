CREATE DATABASE  IF NOT EXISTS `citycykler` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `citycykler`;
-- MySQL dump 10.13  Distrib 5.7.12, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: citycykler
-- ------------------------------------------------------
-- Server version	5.7.17-log

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

--
-- Table structure for table `brands`
--

DROP TABLE IF EXISTS `brands`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `brands` (
  `brandId` int(11) NOT NULL AUTO_INCREMENT,
  `brandName` varchar(15) NOT NULL,
  PRIMARY KEY (`brandId`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `brands`
--

LOCK TABLES `brands` WRITE;
/*!40000 ALTER TABLE `brands` DISABLE KEYS */;
INSERT INTO `brands` VALUES (2,'Kildemoes'),(3,'MBK'),(4,'Mustang'),(5,'Jensen'),(6,'Bianchi'),(7,'T√•rnby'),(8,'Winther'),(9,'MET'),(10,'Lazer'),(11,'VDO'),(12,'Tranz-x'),(13,'Michelin'),(14,'Lipu'),(15,'Sidi'),(16,'Nike'),(17,'Alessi Bianchi'),(18,'John D '),(19,'Hamax'),(20,'Shimano');
/*!40000 ALTER TABLE `brands` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category` (
  `categoryId` int(11) NOT NULL AUTO_INCREMENT,
  `categoryName` varchar(15) NOT NULL,
  `categoryImage` int(11) NOT NULL,
  `categoryType` int(11) NOT NULL,
  PRIMARY KEY (`categoryId`),
  KEY `fkCategoryImage_idx` (`categoryImage`),
  KEY `fkCategoryType_idx` (`categoryType`),
  CONSTRAINT `fkCategoryImage` FOREIGN KEY (`categoryImage`) REFERENCES `media` (`mediaId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fkCategoryType` FOREIGN KEY (`categoryType`) REFERENCES `categorytypes` (`categoryTypeId`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (4,'B√∏rnecykler',14,1),(5,'Mountainbikes',15,1),(6,'Racercykler',16,1),(7,'Damecykler',17,1),(8,'Herrecykler',18,1),(9,'Trehjulede',19,1),(10,'Cykelhjelme',20,2),(11,'Cykelcomputere',21,2),(12,'V√¶rkt√∏j',22,2),(13,'Cykelt√∏j',23,2),(14,'Barnestole',24,2),(15,'Reservedele',25,2);
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categorytypes`
--

DROP TABLE IF EXISTS `categorytypes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categorytypes` (
  `categoryTypeId` int(11) NOT NULL AUTO_INCREMENT,
  `categoryTypeName` varchar(15) NOT NULL,
  PRIMARY KEY (`categoryTypeId`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categorytypes`
--

LOCK TABLES `categorytypes` WRITE;
/*!40000 ALTER TABLE `categorytypes` DISABLE KEYS */;
INSERT INTO `categorytypes` VALUES (1,'cykler'),(2,'udstyr');
/*!40000 ALTER TABLE `categorytypes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `colors`
--

DROP TABLE IF EXISTS `colors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `colors` (
  `colorId` int(11) NOT NULL AUTO_INCREMENT,
  `colorName` varchar(10) NOT NULL,
  `colorSrc` blob NOT NULL,
  `colorMime` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`colorId`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `colors`
--

LOCK TABLES `colors` WRITE;
/*!40000 ALTER TABLE `colors` DISABLE KEYS */;
INSERT INTO `colors` VALUES (1,'r√∏d','ˇ\ÿˇ\‡\0JFIF\0\0\0d\0d\0\0ˇ\Ï\0Ducky\0\0\0\0\0d\0\0ˇ\Ó\0Adobe\0d¿\0\0\0ˇ\€\0Ñ\0ˇ¿\0\0\0\0ˇ\ƒ\0t\0\0\0\0\0\0\0\0\0\0\0\0\0\0	\0\0\0\0\0\0\0\0\0\0\0\0\0\n\0\0\0\0\0\0\0\0\0\0\0A1\"\0\0\0\0\0\0\0\0\01AQa°\—2#C45ˇ\⁄\0\0\0?\0\Ã˙\◊\n\ﬂ=W\ÈyöV\ZA\Â` òÜ$Ω\‰y\‰Øs\’>\ \Â_û˝d^A\…-µ}¥<\‡Hp\Ïu\—Oà|+¡-∏d\…Uë\Í\·∂IRI#r{\È{O\÷z\◊P|}\'\nïeW0\Ê@k|Å?o\≈D8ú®âı0ä≠T\Óã\«@™\‰÷Æ8S\ŒEx\Ô\‘6¢5e\œ¸¿aD≠Sê\“\\º≠lêÅÙπ1§(B	\–\ÍüıñŒ™b—µliêlÜ\ŒëØé\Êß-lÑ\‹\‹xRSC;ßLÖ,m?í!GçËúµ ã\œSº¨I∂}Kr>Ká˜4>`\ÈÛw\—\„⁄ñ\"¬∂D&¡>\›9@únà\ÎIà8\”]°Uß6$%\«møLõÇ\”V\Ã6$`Y∫πßπ7Må2∏\ÊX&+åg¢my÷®\Î+Pp•\∆?ô\Ï˛f∂˚j\Ï≥ÚNõ\Ê¸\⁄R´\·!\Ëv\ﬂ\ÌWünû\0Pò\…*éûÄ\‡©G)$\„_ˇ\Ÿ','image/jpeg'),(2,'Gul','ˇ\ÿˇ\‡\0JFIF\0\0\0d\0d\0\0ˇ\Ï\0Ducky\0\0\0\0\0d\0\0ˇ\Ó\0Adobe\0d¿\0\0\0ˇ\€\0Ñ\0ˇ¿\0\0\0\0ˇ\ƒ\0r\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0	\0\0\0\0\0\0\0\0\0\0!1A\0\0\0\0\0\0\0\0\0!\01AQaqë°ˇ\⁄\0\0\0?\0Æt\ÀD∞\'q◊ºSwiä:îŸñ.ûTâ2)\∆Bò•\›\Â!9{ﬁ´ Øœú1ÚwñwfÁêã!%-\"R¿fÄ\–sfk∫\∆%¸C8\√dñ\≈\»\‚}å\–=°ß\∆%Öâ˙ågXg\‹JwäúlRCπ\…˝r∂dg´x\‰rc\…sû\Œkï>|JÚ˛\Á.LÙªêî†å<ıä¨ÿ¢+äI˚>y~_V√∂\€µylA\Ë\\H?ÆVö∞\ÿrØTT	\›K=æ\¬.3\Í¡±}vµ\Á{òK<uÅl¥çgOè\Á\◊N\nç(JA==Z\ÂE\Á¡º£¶∫˛\ÔíySq#∫R\Õ>\"Hø™T\Ë ˚Ç+\≈\'\‰\√\∆D4∏Ü\√I∫öz\Á\Ì-®\œmV\≈aŸΩcQ\œ\Ëqlæ≤\À_\€\÷|˜Z5ã8ÙyV(3X\„ÿÇ<Ø\ÊàﬂÜ8\’\“$ó\Í ±\Â{X´Ùù1\∆\Â\ŒPõà5\√\‰§¯Ñ\–\ƒtV\œ\Z[ì@I B\\ÃöcvæjÛ]¥i˙ˇ\0D–ö¥-◊•O∞<ˇ\Ÿ','image/jpeg'),(3,'Gr√∏n','ˇ\ÿˇ\‡\0JFIF\0\0\0d\0d\0\0ˇ\Ï\0Ducky\0\0\0\0\0d\0\0ˇ\Ó\0Adobe\0d¿\0\0\0ˇ\€\0Ñ\0ˇ¿\0\0\0\0ˇ\ƒ\0q\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0	\0\0\0\0\0\0\0\0\0\0\0!1A\"\0\0\0\0\0\0\0\0\0\0!1AaÅ\"ë¡R#Cˇ\⁄\0\0\0?\0ïz\€\’\\´íd\\\Œw°ï\"_\ZÆêSñµØy^@£úGΩSÚs\’}˚Û8∑\ﬂ=?)ñ•<î%\Â\0∫ΩQπL¥∆¶8î∏†èö9±ı+\'©Æ\·ç¿(\0≥5å≤¥ÆekY˚#\ŸsähR\0\ÂO´#+U>ËæºW^\ﬁÛ\ÔΩ$.S\ƒ&ïóî≤≤±\‘!f&≠Nr\‚¨Àá\ËìU\œO6,fªØπ4[JMxñ!\‡|tSˇ\0üÖÎñ±[5ï¿IHıº:Tbi\—»Ñ7ß\À\\®®æ\'ª\ÎœΩ±KXì\0˙¨©,§˜\‰Ç(9hKT\◊qëÛ=∏ë˜¶>\√\Ï\ÿƒ∫,\ÌµÙ[;æ(©/\◊\‡5\–ckLˆHM\·¿§•p ¢ULw˙öÚ9≠U5≠vCoJ&N<Ûèî-)É\€û`<ûÄπµ•N~\∆n√ü\—ÅıØˇ\Ÿ','image/jpeg'),(4,'lime','ˇ\ÿˇ\‡\0JFIF\0\0\0d\0d\0\0ˇ\Ï\0Ducky\0\0\0\0\0d\0\0ˇ\Ó\0Adobe\0d¿\0\0\0ˇ\€\0Ñ\0ˇ¿\0\0\0\0ˇ\ƒ\0v\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0	\0\0\0\0\0\0\0\0\0\0\0!1AB	\0\0\0\0\0\0\0\0\0\0!1AaÅQq°\"2$ˇ\⁄\0\0\0?\0¥x∑Étg\œ\Z¢\Ó\”SbSfXaTÚ§I=0\»Sî±˛o)©\Í˜=W\’W\Ô\Á/Ûl˚\"Öë\Àaôo%	}@\0£`/Y\Îvﬁß5=\‘%≈Äy“éé˛~s\Ì>Ø$-Kà\≈uéˇ\0\–Ùßx©Ü\≈,Kù°ç\÷Ãå\Á\'\‘rc\…s\ﬂ…ÆTÒLk˙G!\ÈA\…oùæRá\‘x•Ö®\ƒ^á|ûµπwW£>&´n\Ë≠GW\…˙\"ºÿÜ¸}î]eãÃï¸”æÆ°¨\·÷Ö≤í-ù.Ω±ÆùßG#JºDOvπQQ|¶ké!ÃûkØ…Éb˙¨®\È#^aN$É–ä<\Ëq>E\ÂK[f\Î6\∆˝AX•ù[—∫¶n/™E\ﬂ\È$=5\Ãs≤˘ìV±Ay`Úg¥f≤\◊P\∆y+\\\"˛®\„W»í_àÇ\¬\Ìb≠écå&Lï7\"\ræ>X?µ\ËXprt˜&¿í@©\ﬂ˘IaH	\r9Óªç˝æ\√{Yg_;µˇ\Ÿ','image/jpeg'),(5,'bl√•','ˇ\ÿˇ\‡\0JFIF\0\0\0d\0d\0\0ˇ\Ï\0Ducky\0\0\0\0\0d\0\0ˇ\Ó\0Adobe\0d¿\0\0\0ˇ\€\0Ñ\0ˇ¿\0\0\0\0ˇ\ƒ\0n\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0	\0\0\0\0\0\0\0\0\0\01A!\0\0\0\0\0\0\0\0\0\0!1aAqÅˇ\⁄\0\0\0?\0ò˙\◊\’<ßíd\n\Œw\0†ï\"_\ZÆêSñµØy^@£úGΩS€úı_üø5ãı\Ê2\Ó0õ”∞g+$òé¥\÷6˚\Ÿ\Ÿ_ñ<µáòç∏30\0ë†\0Ù\—Õó®˘-Mw|lˇ\0èÅfkY]a\\:÷∑˜èe\Œi°Hï>XaZ©ˆã\Î\≈\Â∏\≈◊∞§≠&∏Ú‰îâ§GI1ë˝É†\‚\”\À\Za\—u\Ê$!\≈;1Yåπ ~¡\’e\‘\rãØ\Î\ÊK∆ó\\uÄ8Ç¿\¬ı\ÎX\…5ï¡IHıú2\\bi\—\»\“è\”Ú\◊*/ø+±LÅ√ä°iKF\‹Wà©Uí	ß¡çô⁄áCˆV%~˛`˝\ﬂ\Ÿ\≈\«…ôöI’¢Fˇ\0\"W±\Zb\Ï.Àé †\œYè`˛\¬›∞y/ˇ\0V∞¿j√ç¨Ò#ÿ†â;Ö\«§%p £\∆;˝My÷¨ú\Ô<ˇ\0\„≥ˆ[$ºØçjÇAãdT\ \»Ô∞©\'`	\–0\ÏF˝¶^?≥ä5\‚^<±\Íµ¡SK¶ÄWrvr@\Zˇ\Ÿ','image/jpeg'),(6,'lila','ˇ\ÿˇ\‡\0JFIF\0\0\0d\0d\0\0ˇ\Ï\0Ducky\0\0\0\0\0d\0\0ˇ\Ó\0Adobe\0d¿\0\0\0ˇ\€\0Ñ\0ˇ¿\0\0\0\0ˇ\ƒ\0o\0\0\0\0\0\0\0\0\0\0\0\0\0\0	\0\0\0\0\0\0\0\0\0\0\0\0	\0\0\0\0\0\0\0\0\0\0\0A\"!1\0\0\0\0\0\0\0\0\0\0!AQ1aë2ˇ\⁄\0\0\0?\0\À\Ï#\◊<\Í˜2\·∂¯]<É…°Ñbê\Z\Áë\œíΩ\œT˚+ï=vˇ\0\∆~)\”Ú:v>Tàî\‚\„ íR9$u5∏5ùS\'\≈\«h®¥	6•ıZ≥z\ÿ<I¿\·T¡YZNw\0éd∑\Ã3˘uTSâU>¶U™ü(Ω∫v\Á\‚M6,h*fQ˜\À¡A!#\—rõIÿÇAˆ´\Êµ;-1ıé\–*ñ\¬}:R¯5U˙¡ß\‰PÒ\∆=Ö~ñ∂\·Tûë1\ÕN\ :MmxRSE6øà á(m?í!Gç\È˘j™/~á°mrÜïçf$\\àm1P	¸R\»&\›Üí;mO\”Ûqô\¬GBÿö¢\ZOÛ\’êõS[~•ëH§\·-É]¶©«±c\'z\’a7¯\„\Èº`\÷*\¬L\‚\0L\⁄ˆF&™î\œD\⁄Ú9≠[\Ì[L\”2èê7\…¡)?ä`BSD\\©Ñˆ6\Í&¿M3`\ŒE[qÇc\ÕùÛ\—¿u&\¬\È\‰ˆOˇ\Ÿ','image/jpeg'),(7,'pink','ˇ\ÿˇ\‡\0JFIF\0\0\0d\0d\0\0ˇ\Ï\0Ducky\0\0\0\0\0d\0\0ˇ\Ó\0Adobe\0d¿\0\0\0ˇ\€\0Ñ\0ˇ¿\0\0\0\0ˇ\ƒ\0u\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0!1AB\0\0\0\0\0\0\0\0\0\01!QaAqÅ°#ˇ\⁄\0\0\0?\0ªi\Óè\—|æÇ´Û9:∑äÃó;ábdûIÒ!RÉ\…\≈!;Ω\œU\Ô\›}˙÷ò\\\∆\\c…¶E`\Ì≠˘ÍæüÉ∫¡\€9∂\Í2í¢I#¶í\Ï&àP¯<EjHugå\ÏÖ\ÌHa\ŒÒbXœí.^\ \„\ÿ˘Q\ﬁ\‰˜àÚ\«\'\Ï\◊*~z>W÷±äÇ{Q\0M\ F\ﬂëR3æôÇJm\ \Ì\“+{o@6ìb˚É≠[£\ÌEé’∫>Æ1y,¯µ∑E5\ŒÛ\À\ƒY\Ï∆Ö%$|ñÄ\œ\«\ŒNéFî%xûû≠r¢˜\Ëxlì\∆\"\ﬁ\ÀäüM~Ñ@äjªñºñ\n\—vÀ∏ä\‚òÒ(}	ß8™@Ù\„§\€?∞$æ1Xé\'Ω~qlv∑JO≥≠˜æ<^%\◊¬§\‰<ëØ¢\“?ö#(Ä5y\‰\ƒAc\»ˆ±_ë\…]¯V\Z∑W˙\€˙õøí4\ﬁÒS\»id≤w\¬\⁄tkré\⁄!ÙÚ¬Ñí°\◊jì∞\Îˇ\Ÿ','image/jpeg'),(8,'Hvid','ˇ\ÿˇ\‡\0JFIF\0\0\0d\0d\0\0ˇ\Ï\0Ducky\0\0\0\0\0d\0\0ˇ\Ó\0Adobe\0d¿\0\0\0ˇ\€\0Ñ\0ˇ¿\0\0\0\0ˇ\ƒ\0[\0\0\0\0\0\0\0\0\0\0\0\0\0\0	\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0!1	\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0ˇ\⁄\0\0\0?\0\›}¸\€\÷\\ÛV¯[\"∫\·l\Zt\Î<äd©í\ËÇBú\Áç\ÓÛÆÚÚ|™™˜^˝\r¨¸\…\’\Ïnáá\Õ]¬∏WZl÷∑PJ((\¬œ≤\r˜0\‚ïS¢ë\Õ˘®íû7µ|9ÆT_\–Røû{7\∆p4\À\\kÜl8§¡\‚l<Eã™\€!sñC™f-∂?\≈\÷ıV\0i\—\»¬Ä\ƒ\Zû\Õr¢˜\Ë\Ì\Œ\ÕÒƒ¨3ä@\‹?bv\Ì>®Jé\„jû\ÀWã`∏˙\\∑,ãn)ØLïÅ?\’JIRã\ÍÖ{°ˇ\Ÿ','image/jpeg'),(9,'Gr√•','ˇ\ÿˇ\‡\0JFIF\0\0\0d\0d\0\0ˇ\Ï\0Ducky\0\0\0\0\0d\0\0ˇ\Ó\0Adobe\0d¿\0\0\0ˇ\€\0Ñ\0ˇ¿\0\0\0\0ˇ\ƒ\0[\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0!12	\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0ˇ\⁄\0\0\0?\0®∏◊Ö¥>cœ∫Æ\Í\œT\‚sfO\√*%I\È\∆Rú•ééyHEıWπÍæ™´Û\‡\'\Ëû\–tT˙»êµ>%ˆ\ÎFS\‚¶`‘±.6v9[.3ï>\·Iè%\√s~\◊*x/ÛÛ¢4Ö?+h\ÿ6∏á@H≥ç≠1`\ÿ:ßö∑ï\‹/\›e`[)#Y\‘\‡ì+\ÁéFî% ûû\Ìr¢¢¯∫«£¥|¸oR2ª\Ëf?MÛ“§˛e\ﬁ’å|[\«ïh\»\Â∞¿£\nD≈≠v+è$øHÑ«ï\Ìbáˇ\Ÿ','image/jpeg'),(10,'Sort','ˇ\ÿˇ\‡\0JFIF\0\0\0d\0d\0\0ˇ\Ï\0Ducky\0\0\0\0\0d\0\0ˇ\Ó\0Adobe\0d¿\0\0\0ˇ\€\0Ñ\0ˇ¿\0\0\0\0ˇ\ƒ\0]\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0	\n\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0!1A\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0ˇ\⁄\0\0\0?\0¿J“∫Í¨µ-2∞¨µ\Â*\ GP\ BA\»¯R∫£´T¥†ï^≠^P=N¡Uzî¸≥\0˝ì\‡-.™¢\„Wkqólã¥r±Ä\·˝\œI5.\Â‰ñûC\€\‹wˆ™Ø#\≈\Î€ºeıØ\…{®&Ø4\–J™7d!à6C˝8˜\€\"\Ì\ŒKøµW…Öµ.\Â†G9u°?#ØjWë®\‚ü6q\nπû…èŸÅ$ô„çÉˇ\Ÿ','image/jpeg');
/*!40000 ALTER TABLE `colors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `media`
--

DROP TABLE IF EXISTS `media`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `media` (
  `mediaId` int(11) NOT NULL AUTO_INCREMENT,
  `filename` varchar(128) NOT NULL,
  `mime` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`mediaId`)
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `media`
--

LOCK TABLES `media` WRITE;
/*!40000 ALTER TABLE `media` DISABLE KEYS */;
INSERT INTO `media` VALUES (4,'homePicture.png','image/ong'),(10,'268x204_1517404933_homePictur.png','image/png'),(14,'116x80_1517431615_boernecykl.jpeg','image/jpeg'),(15,'116x80_1517471330_mountainbi.jpeg','image/jpeg'),(16,'116x80_1517471345_racercykle.jpeg','image/jpeg'),(17,'116x80_1517471356_damecykler.jpeg','image/jpeg'),(18,'116x80_1517471370_herrecykle.jpeg','image/jpeg'),(19,'116x80_1517471381_trehjulede.jpeg','image/jpeg'),(20,'116x80_1517471410_cykelhjelm.jpeg','image/jpeg'),(21,'116x80_1517471428_cykelcompu.jpeg','image/jpeg'),(22,'116x80_1517471438_vaerktoej..jpeg','image/jpeg'),(23,'116x80_1517471450_cykeltoej..jpeg','image/jpeg'),(24,'116x80_1517471459_barnestole.jpeg','image/jpeg'),(25,'116x80_1517471472_reservedel.jpeg','image/jpeg'),(26,'116x80_1517517646_MTB1.jpg.jpeg','image/jpeg'),(27,'116x80_1517606399_MTB2.jpg.jpeg','image/jpeg'),(30,'116x80_1517606990_MTB2.jpg.jpeg','image/jpeg'),(31,'116x80_1517741409_MTB1.jpg.jpeg','image/jpeg'),(32,'116x80_1517741511_MTB3.jpg.jpeg','image/jpeg'),(33,'116x80_1517741588_racer1.jpg.jpeg','image/jpeg'),(34,'116x80_1517741693_racer2.jpg.jpeg','image/jpeg'),(35,'116x80_1517741731_racer3.jpg.jpeg','image/jpeg'),(36,'116x80_1517741801_dame1.jpg.jpeg','image/jpeg'),(37,'116x80_1517741850_dame2.jpg.jpeg','image/jpeg'),(38,'116x80_1517742011_dame3.jpg.jpeg','image/jpeg'),(39,'116x80_1517742064_dame4.jpg.jpeg','image/jpeg'),(40,'116x80_1517742179_herre1.jpg.jpeg','image/jpeg'),(41,'116x80_1517753749_herre2.jpg.jpeg','image/jpeg'),(42,'116x80_1517753826_herre3.jpg.jpeg','image/jpeg'),(43,'116x80_1517753877_barn1.jpg.jpeg','image/jpeg'),(44,'116x80_1517754239_barn2.jpg.jpeg','image/jpeg'),(45,'116x80_1517754289_barn3.jpg.jpeg','image/jpeg'),(46,'116x80_1517754334_barn4.jpg.jpeg','image/jpeg'),(47,'116x80_1517754398_trehjulet1.jpeg','image/jpeg'),(48,'116x80_1517754445_trehjulet2.jpeg','image/jpeg'),(49,'116x80_1517754493_trehjulet3.jpeg','image/jpeg'),(50,'168x116_1517756785_hjelm1.jpg.jpeg','image/jpeg'),(51,'168x116_1517867828_hjelm2.gif.gif','image/gif'),(52,'168x116_1517867870_hjelm3.gif.gif','image/gif'),(53,'168x116_1517867927_hjelm4.jpg.jpeg','image/jpeg'),(54,'168x116_1517867969_computer1..jpeg','image/jpeg'),(55,'168x116_1517868009_computer2..jpeg','image/jpeg'),(56,'168x116_1517868041_computer3..jpeg','image/jpeg'),(57,'168x116_1517868071_computer4..jpeg','image/jpeg'),(58,'168x116_1517868108_vaerktoej1.jpeg','image/jpeg'),(59,'168x116_1517868139_vaerktoej2.jpeg','image/jpeg'),(60,'168x116_1517868171_vaerktoej3.jpeg','image/jpeg'),(61,'168x116_1517868227_toej1.jpg.jpeg','image/jpeg'),(62,'168x116_1517868262_toej2.jpg.jpeg','image/jpeg'),(63,'168x116_1517868300_toej3.jpg.jpeg','image/jpeg'),(64,'168x116_1517868338_toej4.jpg.jpeg','image/jpeg'),(65,'168x116_1517868368_toej5.jpg.jpeg','image/jpeg'),(66,'168x116_1517868408_stol1.jpg.jpeg','image/jpeg'),(67,'168x116_1517868441_stol2.gif.gif','image/gif'),(68,'168x116_1517868477_reserve1.j.jpeg','image/jpeg'),(69,'168x116_1517868508_reserve2.j.jpeg','image/jpeg'),(70,'168x116_1517868537_reserve3.j.jpeg','image/jpeg'),(71,'168x116_1517868570_reserve4.j.jpeg','image/jpeg');
/*!40000 ALTER TABLE `media` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `offers`
--

DROP TABLE IF EXISTS `offers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `offers` (
  `offerId` int(11) NOT NULL AUTO_INCREMENT,
  `fkProductId` int(11) NOT NULL,
  `offerPrice` decimal(10,2) NOT NULL,
  PRIMARY KEY (`offerId`),
  KEY `fk_prodId_idx` (`fkProductId`),
  CONSTRAINT `fk_prodId` FOREIGN KEY (`fkProductId`) REFERENCES `products` (`productId`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `offers`
--

LOCK TABLES `offers` WRITE;
/*!40000 ALTER TABLE `offers` DISABLE KEYS */;
INSERT INTO `offers` VALUES (2,24,1000.00),(3,25,1800.00),(4,16,7500.00),(5,18,3000.00),(6,20,3500.00),(7,23,3000.00),(8,11,1600.00);
/*!40000 ALTER TABLE `offers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pagecontent`
--

DROP TABLE IF EXISTS `pagecontent`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pagecontent` (
  `pageId` int(11) NOT NULL AUTO_INCREMENT,
  `pageName` varchar(15) NOT NULL,
  `pageText` text NOT NULL,
  `pageImage` int(11) DEFAULT NULL,
  PRIMARY KEY (`pageId`),
  KEY `fkPageImage_idx` (`pageImage`),
  CONSTRAINT `fkPageImage` FOREIGN KEY (`pageImage`) REFERENCES `media` (`mediaId`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pagecontent`
--

LOCK TABLES `pagecontent` WRITE;
/*!40000 ALTER TABLE `pagecontent` DISABLE KEYS */;
INSERT INTO `pagecontent` VALUES (1,'Forsiden','&#60;p&#62;Velkommen til City Cykler Hos os f&#38;aring;r du en cykel, der er tilpasset lige pr&#38;aelig;cis til dig. Vi har nemlig bygget cykler gennem generationer, s&#38;aring; vi ved hvilke krav en cykel kan blive udsat for i det danske vejr. Vores cykler er bygget p&#38;aring; generationers erfaring og solidt h&#38;aring;ndv&#38;aelig;rk.&#60;/p&#62;&#13;&#10;&#60;p&#62;&#38;nbsp;&#60;/p&#62;&#13;&#10;&#60;p&#62;Vi har cyklen til alle i familien. Lige fra barnets f&#38;oslash;rste trehjulede cykel til bedstemors turcykel. V&#38;aelig;lger du en cykel fra os, s&#38;aring; f&#38;aring;r du en cykel, der giver maksimal k&#38;oslash;regl&#38;aelig;de og derved g&#38;oslash;r det til en leg at f&#38;aring; f&#38;aelig;lles familieoplevelser p&#38;aring; cykel med masser af frisk luft og motion, for vi producerer flotte og funktionelle hverdagscykler til hele familien.&#60;/p&#62;&#13;&#10;&#60;p&#62;&#38;nbsp;&#60;/p&#62;&#13;&#10;&#60;p&#62;En god cykel udvikles ikke af sig selv. Den er et resultat af mange &#38;aring;rs produktudvikling. Som et 100% danskejet firma kender vi det danske klima og kan tilpasse vore cykler til det ved at bruge de bedste materialer og de mest optimale processer i fremstillingen af cykler.&#60;/p&#62;&#13;&#10;&#60;p&#62;&#38;nbsp;&#60;/p&#62;&#13;&#10;&#60;p&#62;Vi udvikler og producerer danske kvalitetscykler, der giver dig stor k&#38;oslash;regl&#38;aelig;de, en god funktionalitet og som samtidig lever op til dine krav om holdbarhed og minimal vedligeholdelse. Men samtidig g&#38;aring;r vi ikke p&#38;aring; kompromis med sikkerheden.&#60;/p&#62;',10);
/*!40000 ALTER TABLE `pagecontent` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `productcolors`
--

DROP TABLE IF EXISTS `productcolors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `productcolors` (
  `productColorsId` int(11) NOT NULL AUTO_INCREMENT,
  `fkProductId` int(11) NOT NULL,
  `fkColorId` int(11) NOT NULL,
  PRIMARY KEY (`productColorsId`),
  KEY `fkProdId_idx` (`fkProductId`),
  KEY `fkColorsId_idx` (`fkColorId`),
  CONSTRAINT `fkColorsId` FOREIGN KEY (`fkColorId`) REFERENCES `colors` (`colorId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fkProdId` FOREIGN KEY (`fkProductId`) REFERENCES `products` (`productId`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `productcolors`
--

LOCK TABLES `productcolors` WRITE;
/*!40000 ALTER TABLE `productcolors` DISABLE KEYS */;
INSERT INTO `productcolors` VALUES (8,11,5),(9,11,10),(10,12,9),(11,12,10),(12,13,1),(13,13,5),(14,13,8),(15,14,8),(16,14,9),(17,14,10),(18,15,2),(19,15,4),(20,15,5),(21,15,8),(22,15,10),(23,16,5),(24,16,8),(25,16,9),(26,17,1),(27,17,2),(28,17,6),(29,17,7),(30,17,10),(31,18,2),(32,18,7),(33,18,8),(34,18,10),(35,19,7),(36,20,1),(37,20,2),(38,20,6),(39,20,7),(40,20,8),(41,20,10),(42,21,9),(43,21,10),(44,22,5),(45,22,8),(46,22,9),(47,23,10),(53,25,2),(54,25,10),(55,26,5),(56,26,8),(57,27,2),(58,27,4),(59,27,5),(60,27,6),(61,27,7),(62,27,8),(63,27,9),(64,27,10),(65,28,1),(66,28,5),(67,28,7),(68,28,10),(70,30,1),(71,30,5),(72,30,7),(73,29,1),(74,24,1),(75,24,5),(76,24,8),(77,24,10);
/*!40000 ALTER TABLE `productcolors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `productId` int(11) NOT NULL AUTO_INCREMENT,
  `productDesc` text NOT NULL,
  `productPrice` decimal(10,2) NOT NULL,
  `productCategory` int(11) NOT NULL,
  `productImage` int(11) NOT NULL,
  `productModel` varchar(30) NOT NULL,
  `productBrand` int(11) NOT NULL,
  `productDateAdded` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`productId`),
  KEY `fk_Category_idx` (`productCategory`),
  KEY `fk_ProductImage_idx` (`productImage`),
  KEY `FK_productBrand_idx` (`productBrand`),
  CONSTRAINT `FK_productBrand` FOREIGN KEY (`productBrand`) REFERENCES `brands` (`brandId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Category` FOREIGN KEY (`productCategory`) REFERENCES `category` (`categoryId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_ProductImage` FOREIGN KEY (`productImage`) REFERENCES `media` (`mediaId`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (11,'Dette er den ultimative cykel til byk√∏rsel. For her f√•r du en rigtig supersmart og elegant mountainbike.&#13;&#10;Cyklen har aerodynamisk facon, s√• vindmodstanden mindskes. Cyklen f√•s i flere st√∏rrelser, farver og med&#13;&#10;forskelligt udstyr.',2995.00,5,30,'Mont blanc',3,'2018-02-02 22:29:50'),(12,'Her er cyklen for dig, der skal v√¶re smart og hurtig. Du f√•r her en supersmart mountainbike, der ogs√• er&#13;&#10;rigtig god til byk√∏rsel. Cyklen har aerodynamisk facon, s√• vindmodstanden mindskes. Cyklen f√•s i flere&#13;&#10;st√∏rrelser og med forskelligt udstyr.',2195.00,5,31,'Jala',2,'2018-02-04 11:50:09'),(13,'Er du barn eller ung og gerne vil have en mountainbike kan vi selvf√∏lgelig ogs√• magte det. Cyklen f√•s i hvid&#13;&#10;med bl√• eller r√∏d dekoration. Cyklen en s√¶rdeles god til byk√∏rsel, s√• det bliver en leg at cykle til skole',2595.00,5,32,'Fun',4,'2018-02-04 11:51:51'),(14,'Er man til fart og elegance, s√• er dette cyklen for dig. For her f√•r du en smart, smuk og funktionel cykel, som&#13;&#10;bringer dig hurtigt frem til dit bestemmelsessted. Cyklen f√•s til b√•de piger og drenge, store som sm√•.',4995.00,6,33,'Racer B29',5,'2018-02-04 11:53:08'),(15,'Er du til specialcykler med superudstyr og gode k√∏reegenskaber, s√• er dette cyklen for dig. Her f√•r du 21&#13;&#10;gear med tre klinger. Bremsesystemet er et af de allerbedste p√• markedet. Cyklen f√•s i flere st√∏rrelser til&#13;&#10;b√•de kvinder og m√¶nd. Cyklen f√•s i s√∏lv, sort og r√∏d og bl√• metalic.',9599.00,6,34,'Race4',6,'2018-02-04 11:54:53'),(16,'Er man til fart og elegance, s√• er dette cyklen for dig. For her f√•r du en smart, smuk og funktionel cykel, som&#13;&#10;bringer dig hurtigt frem til dit bestemmelsessted. Cyklen f√•s til b√•de piger og drenge, store som sm√• og i&#13;&#10;farverne s√∏lv, sort og r√∏d og bl√• metalic',8995.00,6,35,'Tvb Racer',7,'2018-02-04 11:55:31'),(17,'Denne elegante cykel er en rigtig god og all-round cykel til den aktive cyklist. Den f√•s i flere st√∏rrelser og i&#13;&#10;farverne r√∏d og s√∏lv metalic. Cyklen har 7 indvendige gear, fodbremse og h√•ndforbremse.',4295.00,7,36,'City 3',7,'2018-02-04 11:56:41'),(18,'Er man til nostalgi eller synes at de moderne cykler er forkerte, s√• har man muligheden for her at f√• en&#13;&#10;cykel, der ligner bedstemors. Men teknologien er forbedret, s√• du f√•r en topmoderne cykel i forkl√¶dning.',3595.00,7,37,'Classic 2',8,'2018-02-04 11:57:30'),(19,'Er man til nostalgi eller synes at de moderne cykler er forkerte, s√• har man muligheden for her at f√• en&#13;&#10;cykel, der ligner bedstemors. Men teknologien er forbedret, s√• du f√•r en topmoderne cykel i forkl√¶dning.&#13;&#10;Synes man at de originale farver er for kedelige, kan den ogs√• f√•s i en lidt mere moderne udgave i farven&#13;&#10;pink.',3999.00,7,38,'Classic 2 Pink edition',8,'2018-02-04 12:00:11'),(20,'En god all-round cykel, som f√•s i flere farver og st√∏rrelser. P√• cyklen er der monteret et indvendigt&#13;&#10;Shimano-gearsystem med 7 gear. S√• det er ogs√• nemt at komme op ad bakken. Cyklen er fabrikeret af&#13;&#10;aluminium med speciallakering, der kan t√•le det danske vejr.',4595.00,7,39,'Street',7,'2018-02-04 12:01:04'),(21,'En god all-round herrecykel, som f√•s i sort og sort metallic og st√∏rrelser. P√• cyklen er der monteret et&#13;&#10;indvendigt Shimano-gearsystem med 7 gear. S√• det er ogs√• nemt at komme op ad bakken. Cyklen er&#13;&#10;fabrikeret af aluminium med speciallakering, der kan t√•le det danske vejr.',5550.00,8,40,'Classic',8,'2018-02-04 12:03:00'),(22,'En let og elegant herrecykel til dig, der har brug for en god og solid cykel. Cyklen f√•s i flere st√∏rrelser og&#13;&#10;farver, bl.a. lys bl√• metalic, sort metalic og s√∏lv metalic. P√• cyklen er der monteret et indvendigt&#13;&#10;Shimanogearsystem med 7 gear. Lakeringen er en speciallakering fremstillet til at modst√• det danske vejr.',4595.00,8,41,'Katmandu',7,'2018-02-04 15:15:49'),(23,'Denne cykel er for dig, der bare har brug for en cykel uden de store dikkedarer. Her f√•r du en god all-round&#13;&#10;cykel, der kan holde til de mange g√∏rem√•l, der er i dagligdagen. Cyklen er monteret med et indvendigt&#13;&#10;Shimano gearsystem med 5 gear. Cyklen har desuden bagageb√¶rer og st√∏ttefod. Lakeringen er en&#13;&#10;speciallakering fremstillet til at modst√• det danske vejr.',3595.00,8,42,'City Limit',8,'2018-02-04 15:17:06'),(24,'Her er den f√∏rste juniorcykel. Cyklen f√•s til b√•de drenge og piger. Den f√•s i flere farver. Cyklen passer til&#13;&#10;aldersgruppen 3 ‚Äì 6 √•r. Man kan f√• st√∏ttehjul til cyklen, s√• det bliver nemmere for barnet at l√¶re at cykle&#13;&#10;selv.',1495.00,4,43,'WB-1',8,'2018-02-04 15:17:57'),(25,'N√•r barnet n√•r skolealderen er dette den perfekte cykel. Her f√•r man en god gedigen cykel, der kan holde til&#13;&#10;at blive til at blive brugt hver dag. Cyklen har forbremser og fodbremser. Cyklen f√•s i et smart layout med&#13;&#10;gult og sort stel til drenge og orange og sort til piger. Cyklen har en sort bagageb√¶rer.',2195.00,4,44,'WB-2',8,'2018-02-04 15:24:00'),(26,'N√•r barnet n√•r skolealderen er dette den perfekte cykel. Her f√•r man en god gedigen cykel, der kan holde til&#13;&#10;at blive til at blive brugt hver dag. Cyklen har forbremser og fodbremser. Cyklen f√•s i et smart layout med&#13;&#10;r√∏dt og hvidt stel til piger og bl√•t og hvidt stel til drenge. Cyklen har en sort bagageb√¶rer.',2295.00,4,45,'WB-3',8,'2018-02-04 15:24:49'),(27,'Denne smarte cykel er rigtig god, n√•r barnet skal cykle til skole hver dag og ogs√• bruge cyklen i de √∏vrige&#13;&#10;hverdagssituationer. Cyklen leveres i smarte farver og findes til b√•de drenge og piger.',1695.00,4,46,'WB-4',8,'2018-02-04 15:25:34'),(28,'Her f√•r dit barn en god og solid cykel i nogle sp√¶ndende farver. Lige til at tage sig en god cykeltur p√•.&#13;&#10;Cyklen er, som alle vore √∏vrige cykler, solidt bygget, s√• den kan holde til dagligt brug. Cyklen er konstrueret,&#13;&#10;s√• barnet f√•r den st√∏rste forn√∏jelse af cyklen.',548.00,9,47,'Mini',8,'2018-02-04 15:26:38'),(29,'er f√•r den gode velkendte r√∏de trehjulede cykel, som gennem generationer har v√¶ret det f√∏rste valg.&#13;&#10;Cyklen har tippelad. Cyklen er, som alle vore √∏vrige cykler, solidt bygget, s√• den kan holde til dagligt og&#13;&#10;solidt brug. Cyklen er konstrueret, s√• barnet f√•r den st√∏rste forn√∏jelse af cyklen.',548.00,9,48,'Midi',8,'2018-02-04 15:27:25'),(30,'Den trehjulede velkendte trehjulede cykel f√•s ogs√• i andre farver, f. eks. I pink og bl√•. Gennem generationer&#13;&#10;har v√¶ret den trehjulede cykel altid v√¶ret det f√∏rste valg. Cyklen har tippelad. Cyklen er, som alle vore&#13;&#10;√∏vrige cykler, solidt bygget, s√• den kan holde til dagligt og solidt brug. Cyklen er konstrueret, s√• barnet f√•r&#13;&#10;den st√∏rste forn√∏jelse af cyklen.',548.00,9,49,'Maxi',8,'2018-02-04 15:28:13'),(31,'Alle b√∏r have en cykelhjelm. Vi har derfor fundet denne smarte model til sm√• piger, der gerne vil v√¶re&#13;&#10;prinsesser. Hjelmen er pink med hvide blomster og passer til piger i alderen 5 ‚Äì 12 √•r.',395.00,10,50,'Junior',9,'2018-02-04 16:06:25'),(32,'Alle b√∏r have en cykelhjelm. Ogs√• n√•r man sidder bagp√• fars eller mors cykel Vi har derfor fundet denne&#13;&#10;smarte model til sm√• piger og drenge. Hjelmen er designet, s√• den ligner en s√∏d lille mus. Den passer til&#13;&#10;piger og drenge i alderen 1 - 5 √•r.',275.00,10,51,'Mouse',10,'2018-02-05 22:57:08'),(33,'Cykelhjelme er for alle. B√•de b√∏rn og voksne. Vi har derfor fundet denne smarte model, som f√•s til b√•de&#13;&#10;b√∏rn og voksne. Hjelmen f√•s i farverne r√∏d og bl√•. Den f√•s i b√∏rnest√∏rrelser fra 6 √•r og i voksenst√∏rrelser op&#13;&#10;til 60 cm.',495.00,10,52,'Regular',10,'2018-02-05 22:57:50'),(34,'For den professionelle rytter eller for hende, der gerne vil have den ultimative cykelhjelm har vi denne&#13;&#10;aerodynamiske model i hvid og bl√•.',995.00,10,53,'Blue',9,'2018-02-05 22:58:47'),(35,'Her f√•r man en god og gedigen cykelcomputer. Computeren har otte forskellige funktioner. Computeren&#13;&#10;har et stort display og den er nem at indstille.',349.00,11,54,'Com3',3,'2018-02-05 22:59:30'),(36,'Her f√•r man en tr√•dl√∏s og programmerbar cykelcomputer. Computeren har selvf√∏lgelig et stort l√¶sevenligt&#13;&#10;display. Der er femten indbyggede funktioner inklusiv kalorie- og fedtforbr√¶nding, s√• man uden problemer&#13;&#10;kan f√∏lge med i fedtforbr√¶ndingen.',259.00,11,55,'CompuSpeed 1',11,'2018-02-05 23:00:09'),(37,'Her f√•r man en god og gedigen cykelcomputer. Computeren har ni forskellige funktioner, som f.eks.&#13;&#10;tidsm√•ler og temperatur m√•ler. Computeren har et stort display og den er nem at indstille.',299.00,11,56,'Com2',3,'2018-02-05 23:00:42'),(38,'Cykelcomputeren her har mange forskellige funktioner. F.eks. kan man m√•le den aktuelle hastighed, k√∏rt&#13;&#10;tid, gennemsnitshastighed. Man kan ogs√• se den k√∏rte distance for en eller to cykler.',399.00,11,57,'CompuSpeed 2',11,'2018-02-05 23:01:11'),(39,'Vil man holde sin cykel i en god stand, er man n√∏dt til at have det rigtige v√¶rkt√∏j. S√• derfor b√∏r denne flotte&#13;&#10;k√¶deadskiller med flere forskellige funktioner v√¶re i enhver handymans cykelv√¶rkt√∏jskasse. Der er bl.a.&#13;&#10;unbracho n√∏gler og skruetr√¶kker med stjernek√¶rv og lige k√¶rv',89.00,12,58,'K√¶deadskiller',12,'2018-02-05 23:01:48'),(40,'Det sker jo at selv det bedste d√¶k kan punktere. Derfor er et s√¶t d√¶kjern uundv√¶rligt. Ellers bliver det at&#13;&#10;skifte d√¶k for besv√¶rligt.',12.00,12,59,'D√¶kjern',13,'2018-02-05 23:02:19'),(41,'Foldev√¶rkt√∏jet med 6 forskellige funktioner f√•s i r√∏d. Her er bl.a. unbracho n√∏gler i forkellige st√∏rrelser.&#13;&#10;Skruetr√¶kker med stjerne og lige k√¶rv.',45.00,12,60,'Foldev√¶rkt√∏j',14,'2018-02-05 23:02:51'),(42,'Cykler man meget p√• en racercykel, s√• kan det v√¶re en god ide, at investere i et par rigtige cykelsko. S√• f√•r&#13;&#10;du nemlig en meget st√∏rre forn√∏jelse af din cykeltur. Her f√•r du et rigtig godt par til en fornuftig pris.',599.00,13,61,'Cykelsko',15,'2018-02-05 23:03:47'),(43,'En god sommerjakke til herrer. Der er en god ventilation i jakken, som er b√•de vandt√¶t og √•ndbar.',899.00,13,62,'Frakke',16,'2018-02-05 23:04:22'),(44,'K√∏b denne smarte cap fra Alessi Bianchi. S√• er du med p√• moden. Cappen f√•s kun i en st√∏rrelse.',89.00,13,63,'Kasket',17,'2018-02-05 23:05:00'),(45,'Dette vinters√¶t med jakke og bukser er i vores s√¶dvanlige gode kvalitet. B√•de jakke og bukser kan k√∏bes&#13;&#10;separat til f√∏lgende priser: Bukser 799 kr. og jakke 699 kr.',999.00,13,64,'Cykels√¶t',18,'2018-02-05 23:05:38'),(46,'Cykler man meget og langt, kan man i det lange l√∏b ikke undv√¶re et par gode cykelbukser. Bukserne er&#13;&#10;med korte bukser og fremstillet af sort lycra.',299.00,13,65,'Bukser',18,'2018-02-05 23:06:08'),(47,'Her f√•r du en elegant barnestol med den st√∏rste comfort til dit barn, n√•r I cykler. Cyklen er fremstillet i&#13;&#10;formst√∏bt plastik med benforl√¶ngere, s√• benene ikke kan komme ind i cyklens hjul.',1595.00,14,66,'Mini',19,'2018-02-05 23:06:48'),(48,'Her f√•r du en elegant barnestol med den st√∏rste comfort til dit barn, n√•r I cykler. Cyklen er fremstillet i&#13;&#10;formst√∏bt plastik med benforl√¶ngere, der ender som st√∏tter til barnets f√∏dder. Derved undg√•r man at&#13;&#10;barnets ben kommer ind i cyklens hjul.',1795.00,14,67,'Midi',19,'2018-02-05 23:07:21'),(49,'Skal cyklen have skiftet k√¶de, er denne k√¶de et godt valg. K√¶den er rustfri og passer til 7 og 8 udvendige&#13;&#10;gear. N√•r du skifter k√¶de, b√∏r du ogs√• skifte krans.',99.00,15,68,'K√¶de',8,'2018-02-05 23:07:57'),(50,'St√∏tteben til mountainbikes og citycyklen. Ja, det er ren rigtig god ting, da man jo ikke altid kan regne med&#13;&#10;at der er et cykelstativ, man kan placere sin cykel i. St√∏ttebenet er blankt og kan justeres.',149.00,15,69,'St√∏tteben',8,'2018-02-05 23:08:28'),(51,'Tr√¶t af at punktere i tide og utide. S√• pr√∏v dette punkterfrie d√¶k med kevlar. S√• f√•r du nedsat dine&#13;&#10;punkteringer med 90 procent. D√¶kket er meget nemt at montere.',299.00,15,70,'D√¶k',4,'2018-02-05 23:08:57'),(52,'Her f√•r du et godt og solidt baggear. Gearskiftet bliver derved til en leg.',249.00,15,71,'Deore Gear',20,'2018-02-05 23:09:30');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sitesettings`
--

DROP TABLE IF EXISTS `sitesettings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sitesettings` (
  `siteSettingsId` int(11) NOT NULL AUTO_INCREMENT,
  `siteTitle` varchar(25) NOT NULL,
  `street` varchar(25) NOT NULL,
  `zipcode` int(4) NOT NULL,
  `city` varchar(25) NOT NULL,
  `phone` int(8) NOT NULL,
  `fax` int(8) NOT NULL,
  `email` varchar(128) NOT NULL,
  PRIMARY KEY (`siteSettingsId`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sitesettings`
--

LOCK TABLES `sitesettings` WRITE;
/*!40000 ALTER TABLE `sitesettings` DISABLE KEYS */;
INSERT INTO `sitesettings` VALUES (1,'City Cykler A/S','Nygade 65',9000,'√Ölborg',98101011,98101012,'contact@cc.dk');
/*!40000 ALTER TABLE `sitesettings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `userId` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(25) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fullname` varchar(45) NOT NULL,
  `userEmail` varchar(64) NOT NULL,
  PRIMARY KEY (`userId`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (2,'admin','$2y$12$ArO0r/vF0f0LxTR.HP..j.VZTgA8ROVB8oI8srf7z3khPDAzNVuw.','Administrator','admin@cc.dk');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'citycykler'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-02-06  8:07:09
