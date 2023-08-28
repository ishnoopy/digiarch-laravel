-- MySQL dump 10.13  Distrib 8.0.34, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: digiarch
-- ------------------------------------------------------
-- Server version	8.0.34-0ubuntu0.22.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `thesis`
--

DROP TABLE IF EXISTS `thesis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `thesis` (
  `id` int NOT NULL AUTO_INCREMENT,
  `department_id` int NOT NULL,
  `course_id` int NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `author` json DEFAULT NULL,
  `abstract` text,
  `file_url` varchar(255) DEFAULT NULL,
  `view_count` int DEFAULT '0',
  `download_count` int DEFAULT '0',
  `keywords` json DEFAULT NULL,
  `published_year` int DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_thesis_departments1_idx` (`department_id`),
  KEY `fk_thesis_courses1_idx` (`course_id`),
  CONSTRAINT `fk_thesis_courses1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`),
  CONSTRAINT `fk_thesis_departments1` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `thesis`
--

LOCK TABLES `thesis` WRITE;
/*!40000 ALTER TABLE `thesis` DISABLE KEYS */;
INSERT INTO `thesis` VALUES (1,4,10,'R E V I E W Open Access Machine learning, medical diagnosis, and biomedical engineering research','[\"Kenneth Foster\", \" Robert Koprowski\", \" Joseph Skufca\"]','A large number of papers are appearing in the biomedical engineering literature that\r\ndescribe the use of machine learning techniques to develop classifiers for detection\r\nor diagnosis of disease. However, the usefulness of this approach in developing\r\nclinically validated diagnostic techniques so far has been limited and the methods\r\nare prone to overfitting and other problems which may not be immediately\r\napparent to the investigators. This commentary is intended to help sensitize\r\ninvestigators as well as readers and reviewers of papers to some potential pitfalls in\r\nthe development of classifiers, and suggests steps that researchers can take to help\r\navoid these problems. Building classifiers should be viewed not simply as an add-on\r\nstatistical analysis, but as part and parcel of the experimental process. Validation of\r\nclassifiers for diagnostic applications should be considered as part of a much larger\r\nprocess of establishing the clinical validity of the diagnostic technique.','64eb8a1ec9de9_Machine learning, medical diagnosis, and biomedical engineering research.pdf',18,1,'[\"Artificial intelligence\", \" Classifiers\", \" Image processing\", \" Machine learning\"]',2014,'2023-08-27 17:38:38','2023-08-28 08:41:33'),(3,1,8,'BUSINESS INTELLIGENCE: THE ROLE OF THE INTERNET IN MARKETING RESEARCH AND BUSINESS DECISION-MAKING','[\"Ivana Kursan\", \" Mirela Mihić\"]','The purpose of this paper is to point out the determinants of the business\r\nintelligence discipline, as applied in marketing practice. The paper examines the\r\nrole of the Internet in marketing research and its implications on the business\r\ndecision-making processes. Although companies conduct a variety of research\r\nmethods in an offline environment, the paper aims to stress the importance of Web\r\nopportunities in conducting the Web segmentation and collecting customer data.\r\nDue to the existence of different perceptions concerning the role of the Internet,\r\nthis paper tries to emphasize its effort of an interactive channel that serves the\r\nfunction of not only an informational nature, but as a powerful research tool as\r\nwell. Several data collection and analysis methods/techniques are discussed that\r\nwould help companies to take advantage of a Web as a significant corporate\r\nresource.','64eb9b3477ec1_Research Paper for Business Intelligence.pdf',5,1,'[\"Economy\", \" Marketing\"]',2010,'2023-08-27 18:51:32','2023-08-28 09:44:21'),(4,4,10,'Diversity in Software Engineering','[\"Meiyappan Nagappan\", \" Thomas Zimmermann\", \" and  Christian Bird\"]','One of the goals of software engineering research is to achieve gen-\r\nerality: Are the phenomena found in a few projects reflective of\r\nothers? Will a technique perform as well on projects other than the\r\nprojects it is evaluated on? While it is common sense to select a\r\nsample that is representative of a population, the importance of di-\r\nversity is often overlooked, yet as important. In this paper, we com-\r\nbine ideas from representativeness and diversity and introduce a\r\nmeasure called sample coverage, defined as the percentage of pro-\r\njects in a population that are similar to the given sample. We intro-\r\nduce algorithms to compute the sample coverage for a given set of\r\nprojects and to select the projects that increase the coverage the\r\nmost. We demonstrate our technique on research presented over\r\nthe span of two years at ICSE and FSE with respect to a population\r\nof 20,000 active open source projects monitored by Ohloh.net.\r\nKnowing the coverage of a sample enhances our ability to reason\r\nabout the findings of a study. Furthermore, we propose reporting\r\nguidelines for research: in addition to coverage scores, papers\r\nshould discuss the target population of the research (universe) and\r\ndimensions that potentially can influence the outcomes of a re-\r\nsearch (space).','64ec5e67770f7_Diversity in Software Engineering Research.pdf',3,2,'[\"Software engineering\", \"  Development\", \"  Computer science\"]',2011,'2023-08-28 08:44:23','2023-08-28 08:53:18');
/*!40000 ALTER TABLE `thesis` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-08-28 18:03:33
