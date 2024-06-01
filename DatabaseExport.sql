-- MySQL dump 10.13  Distrib 8.0.34, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: codecademy
-- ------------------------------------------------------
-- Server version	8.0.35

DROP DATABASE IF EXISTS codecademy;

CREATE DATABASE codecademy;
USE codecademy;

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
-- Table structure for table `courses`
--

DROP TABLE IF EXISTS `courses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `courses` (
  `course_id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text,
  `difficulty` varchar(50) DEFAULT NULL,
  `lesson_count` int DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `course_type` enum('Free','Paid') DEFAULT 'Free',
  `video_source` varchar(200) DEFAULT NULL,
  `uploaded_by` varchar(45) NOT NULL,
  PRIMARY KEY (`course_id`)
) ENGINE=InnoDB AUTO_INCREMENT=309 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `courses`
--

LOCK TABLES `courses` WRITE;
/*!40000 ALTER TABLE `courses` DISABLE KEYS */;
INSERT INTO `courses` VALUES (227,'Learn Python 3','Learn the basics of Python 3, one of the most powerful, versatile, and in-demand programming languages today.','Beginner Friendly',25,0.00,'Free','Learn-to-code-with-Codecademy.mp4','Admin'),(228,'Learn HTML','Start at the beginning by learning HTML basics — an important foundation for building and editing web pages.','Beginner Friendly',7,0.00,'Free','Learn-to-code-with-Codecademy.mp4','Admin'),(229,'Learn JavaScript','Learn how to use JavaScript — a powerful and flexible programming language for adding website interactivity.','Beginner Friendly',15,0.00,'Free','Learn-to-code-with-Codecademy.mp4','Admin'),(230,'Learn Java','Learn to code in Java — a robust programming language used to create software, web and mobile apps, and more.','Beginner Friendly',16,0.00,'Free','Learn-to-code-with-Codecademy.mp4','Admin'),(231,'Learn SQL','In this SQL course, you\'ll learn how to manage large datasets and analyze real data using the standard data management language.','Beginner Friendly',5,0.00,'Free','Learn-to-code-with-Codecademy.mp4','Admin'),(232,'Learn C++','Learn C++ — a versatile programming language that’s important for developing software, games, databases, and more.','Beginner Friendly',10,0.00,'Free','Learn-to-code-with-Codecademy.mp4','Admin'),(233,'Learn Python 2','Learn the basics of the world\'s fastest growing and most popular programming language used by software engineers, analysts, data scientists, and machine learning engineers alike.','Beginner Friendly',17,0.00,'Free','Learn-to-code-with-Codecademy.mp4','Admin'),(234,'Learn CSS','In this CSS tutorial, you’ll learn how to add CSS to visually transform HTML into eye-catching sites.','Beginner Friendly',6,0.00,'Free','Learn-to-code-with-Codecademy.mp4','Admin'),(235,'Learn C#','Learn Microsoft\'s popular C# programming language, used to make websites, mobile apps, video games, VR, and more.','Beginner Friendly',20,0.00,'Free','Learn-to-code-with-Codecademy.mp4','Admin'),(236,'Learn React','In this React course, you’ll build powerful interactive applications with one of the most popular JavaScript libraries.','Intermediate',13,0.00,'Free','Learn-to-code-with-Codecademy.mp4','Admin'),(237,'Learn How to Code','New to coding? Start here and learn programming fundamentals that can be helpful for any language you learn.','Beginner Friendly',1,0.00,'Free','Learn-to-code-with-Codecademy.mp4','Admin'),(238,'Learn R','Learn how to code and clean and manipulate data for analysis and visualization with the R programming language.','Beginner Friendly',14,0.00,'Free','Learn-to-code-with-Codecademy.mp4','Admin'),(239,'Introduction to Game Development','Explore video game development, including game design, gameplay development, and asset creation.','Beginner Friendly',1,0.00,'Free','Learn-to-code-with-Codecademy.mp4','Admin'),(240,'Learn Lua','Learn the basics of Lua, a general-purpose programming language used for building games, web apps, and developer tools.','Beginner Friendly',4,0.00,'Free','Learn-to-code-with-Codecademy.mp4','Admin'),(241,'Introduction to Cybersecurity','Learn about the fast-growing field of cybersecurity and how to protect your data and information from digital attacks.','Beginner Friendly',3,0.00,'Free','Learn-to-code-with-Codecademy.mp4','Admin'),(242,'Analyze Data with SQL','Learn to analyze data with SQL and prepare for technical interviews.','Beginner Friendly',16,0.00,'Free','Learn-to-code-with-Codecademy.mp4','Admin'),(243,'Learn Intermediate JavaScript','Take your JavaScript knowledge to the next level by learning how to use advanced functions to create more efficient programs.','Intermediate',10,0.00,'Free','Learn-to-code-with-Codecademy.mp4','Admin'),(244,'Learn Swift','A powerful programming language developed by Apple for iOS, macOS, and more.','Beginner Friendly',12,0.00,'Free','Learn-to-code-with-Codecademy.mp4','Admin'),(245,'Learn What to Learn','In this quick free course, you\'ll get the info you need to make your own decisions about what to learn.','Beginner Friendly',2,0.00,'Free','Learn-to-code-with-Codecademy.mp4','Admin'),(246,'Learn TypeScript','Learn TypeScript, a superset of JavaScript that adds types to make the language scale!','Intermediate',9,0.00,'Free','Learn-to-code-with-Codecademy.mp4','Admin'),(247,'Build a Website with HTML, CSS, and GitHub Pages','Learn the basics of web development to build your own website.','Beginner Friendly',16,0.00,'Free','Learn-to-code-with-Codecademy.mp4','Admin'),(248,'Code Foundations','Start your programming journey with an introduction to the world of code and basic concepts.','Beginner Friendly',4,0.00,'Free','Learn-to-code-with-Codecademy.mp4','Admin'),(249,'Learn the Command Line','Learn about the command line, starting with navigating and manipulating the file system, and ending with redirection and configuring the env','Beginner Friendly',4,0.00,'Free','Learn-to-code-with-Codecademy.mp4','Admin'),(250,'Learn Intermediate Python 3','Learn Intermediate Python 3 and practice leveraging Python’s unique features to build powerful, sophisticated applications.','Intermediate',19,0.00,'Free','Learn-to-code-with-Codecademy.mp4','Admin'),(251,'Learn Go','Learn how to use Go (Golang), an open-source programming language supported by Google!','Beginner Friendly',4,0.00,'Free','Learn-to-code-with-Codecademy.mp4','Admin'),(252,'Getting Started with Python for Data Science','Work hands-on with real datasets while learning Python for data science.','Beginner Friendly',7,0.00,'Free','Learn-to-code-with-Codecademy.mp4','Admin'),(253,'Learn C: Introduction','Learn about the basics of the C programming language, and write your first C program!','Beginner Friendly',1,0.00,'Free','Learn-to-code-with-Codecademy.mp4','Admin'),(254,'Learn to Code with Blockly','Want to learn how to get started with programming in an interactive way? Try our drag and drop code lessons!','Beginner Friendly',1,0.00,'Free','Learn-to-code-with-Codecademy.mp4','Admin'),(255,'Intro to Java','Get started with Java by learning about the basics of a Java program and variables!','Beginner Friendly',6,0.00,'Free','Learn-to-code-with-Codecademy.mp4','Admin'),(256,'Intro to SQL','Use SQL to create, access, and update tables of data in a relational database.','Beginner Friendly',2,0.00,'Free','Learn-to-code-with-Codecademy.mp4','Admin'),(257,'Learn Ruby','Learn to program in Ruby, a ﬂexible and beginner-friendly language used to create sites like Codecademy.','Beginner Friendly',9,0.00,'Free','Learn-to-code-with-Codecademy.mp4','Admin'),(258,'Learn PHP: Introduction','Learn about PHP, a programming language used in modern web development, and build a strong foundation in PHP by learning about basic syntax.','Beginner Friendly',2,0.00,'Free','Learn-to-code-with-Codecademy.mp4','Admin'),(259,'Learn Intermediate CSS','Learn how to implement elegant transitions, create new layouts and serve users with dynamic needs.','Intermediate',13,0.00,'Free','Learn-to-code-with-Codecademy.mp4','Admin'),(260,'Python for Programmers','An introduction to the basic syntax and fundamentals of Python for experienced programmers.','Intermediate',3,0.00,'Free','Learn-to-code-with-Codecademy.mp4','Admin'),(261,'Intro to Generative AI','Dive into the many forms of generative AI and learn how we can best use these new technologies!','Beginner Friendly',1,0.00,'Free','Learn-to-code-with-Codecademy.mp4','Admin'),(262,'Learn React Native','Build mobile apps with JavaScript and React, using Expo and React Native','Intermediate',6,0.00,'Free','Learn-to-code-with-Codecademy.mp4','Admin'),(263,'Learn React: Introduction','Build powerful interactive applications with React, a popular JavaScript library.','Beginner Friendly',6,0.00,'Free','Learn-to-code-with-Codecademy.mp4','Admin'),(264,'Learn PowerShell','Jump into PowerShell through interactive lessons on variables, operators, control flow, objects, arrays, and functions.','Beginner Friendly',6,0.00,'Free','Learn-to-code-with-Codecademy.mp4','Admin'),(265,'Learn Kotlin','Learn Kotlin, the expressive, open-source programming language developed by JetBrains.','Beginner Friendly',9,0.00,'Free','Learn-to-code-with-Codecademy.mp4','Admin'),(266,'Learn Intermediate Java','Dive deeper into Java — one of the world’s most popular programming languages.','Intermediate',10,0.00,'Free','Learn-to-code-with-Codecademy.mp4','Admin'),(267,'Business Intelligence Data Analyst','BI Data Analysts use Python and SQL to query, analyze, and visualize data — and Tableau and Excel to communicate findings.','Beginner Friendly',50,199.00,'Paid','Learn-to-code-with-Codecademy.mp4','Admin'),(268,'Data and Programming Foundations for AI','Learn the coding, data science, and math you need to get started as a Machine Learning or AI engineer.','Beginner Friendly',39,79.00,'Paid','Learn-to-code-with-Codecademy.mp4','Admin'),(269,'Data Science Foundations','Learn to clean, analyze, and visualize data with Python and SQL.','Beginner Friendly',56,99.00,'Paid','Learn-to-code-with-Codecademy.mp4','Admin'),(270,'iOS Developer','Learn how to use Swift and SwiftUI to build iOS applications.','Beginner Friendly',35,129.00,'Paid','Learn-to-code-with-Codecademy.mp4','Admin'),(271,'Full-Stack Engineer','A full-stack engineer can get a project done from start to finish, back-end to front-end.','Beginner Friendly',150,249.00,'Paid','Learn-to-code-with-Codecademy.mp4','Admin'),(272,'Learn PHP','Learn the fundamentals of PHP, one of the most popular languages of modern web development.','Beginner Friendly',17,49.00,'Paid','Learn-to-code-with-Codecademy.mp4','Admin'),(273,'Machine Learning/AI Engineer','Machine Learning/AI Engineers build end-to-end ML applications and power many of the apps we use every day. They work in Python, Git, & ML.','Intermediate',45,129.00,'Paid','Learn-to-code-with-Codecademy.mp4','Admin'),(274,'Data Scientist: Natural Language Processing Specialist','NLP Data Scientists find meaning in language, analyze text and speech, and create chatbots. They use Python, SQL, & NLP to answer questions.','Beginner Friendly',100,149.00,'Paid','Learn-to-code-with-Codecademy.mp4','Admin'),(275,'Create Video Games with Phaser.js','It’s easy to get lost in the flow of a good game. But behind every power-up and boss battle is simple code that brings the game to life.','Beginner Friendly',27,59.00,'Paid','Learn-to-code-with-Codecademy.mp4','Admin'),(276,'Build Web Apps with ASP.NET','Jumpstart your career with this skill path, first by learning the C# language, then building web apps with ASP.NET Core and the Razor Pages.','Intermediate',33,79.00,'Paid','Learn-to-code-with-Codecademy.mp4','Admin'),(277,'Create REST APIs with Spring and Java','By the end of this Skill Path, you will have created your very own API using the Spring framework and Java language.','Beginner Friendly',19,69.00,'Paid','Learn-to-code-with-Codecademy.mp4','Admin'),(278,'Analyze Financial Data with Python','Level up in financial analytics by learning Python to process, analyze, and visualize financial data.','Beginner Friendly',27,89.00,'Paid','Learn-to-code-with-Codecademy.mp4','Admin'),(279,'Build Python Web Apps with Django','Django is an open-source Python web development framework that allows you to quickly create web apps using the plethora of tools provided.','Intermediate',13,79.00,'Paid','Learn-to-code-with-Codecademy.mp4','Admin'),(280,'Learn Data Structures and Algorithms with Python','Learn what data structures and algorithms are, why they are useful, and how you can use them effectively in Python.','Intermediate',26,89.00,'Paid','Learn-to-code-with-Codecademy.mp4','Admin'),(281,'Learn Data Analysis with Pandas','Learn the basics of Pandas, an industry standard Python library that provides tools for data manipulation and analysis.','Intermediate',6,59.00,'Paid','Learn-to-code-with-Codecademy.mp4','Admin'),(282,'Learn Vue.js','Learn how to make front-end web apps with ease using Vue.js, an increasingly popular JavaScript front-end framework.','Beginner Friendly',4,69.00,'Paid','Learn-to-code-with-Codecademy.mp4','Admin'),(283,'Build Python Web Apps with Flask','Learn how to code in Python, design and access databases, create interactive web applications, and share your apps with the world.','Intermediate',30,79.00,'Paid','Learn-to-code-with-Codecademy.mp4','Admin'),(284,'Learn Spring','Learn how to build an API using the Spring framework and Java programming language.','Intermediate',5,49.00,'Paid','Learn-to-code-with-Codecademy.mp4','Admin'),(285,'Pass the Technical Interview with Python','Learn about the computer science concepts of data structures and algorithms and build implementations of each from scratch in modern Python.','Intermediate',25,99.00,'Paid','Learn-to-code-with-Codecademy.mp4','Admin'),(286,'Create a Back-End App with JavaScript','Learn how to build back-end web APIs using Express.js, Node.js, SQL, and a Node.js-SQLite database library.','Beginner Friendly',30,59.00,'Paid','Learn-to-code-with-Codecademy.mp4','Admin'),(287,'Learn Advanced React','Learn advanced React techniques and topics including custom hooks, error boundaries, the Context API, and optimization.','Advanced',5,0.00,'Free','Learn-to-code-with-Codecademy.mp4','Admin'),(288,'Learn Advanced Python 3','Learn the basics of functional programming, concurrent programming, deployment, and more in this advanced Python course.','Advanced',6,0.00,'Free','Learn-to-code-with-Codecademy.mp4','Admin'),(289,'Machine Learning: Artificial Intelligence Decision Making with Minimax','Teach computers how to make decisions and play games with the Minimax Algorithm!','Advanced',2,0.00,'Free','Learn-to-code-with-Codecademy.mp4','Admin'),(290,'Learn Advanced Python 3: Functional Programming','Learn how to use functional programming to create clean, efficient programs.','Advanced',2,0.00,'Free','Learn-to-code-with-Codecademy.mp4','Admin'),(291,'Learn Advanced Java','Learn the basics of parallel and concurrent programming, servlets, and sockets in this advanced Java course.','Advanced',2,0.00,'Free','Learn-to-code-with-Codecademy.mp4','Admin'),(292,'Learn Advanced Python 3: Concurrency','Learn how to use concurrent programming to implement code more efficiently.','Advanced',2,0.00,'Free','Learn-to-code-with-Codecademy.mp4','Admin'),(304,'','','beginner',0,0.00,'Free','toUpload.mp4','denis'),(305,'','','beginner',0,0.00,'Free','toUpload.mp4','denis'),(306,'','','beginner',0,0.00,'Free','toUpload.mp4','denis'),(307,'','asd','beginner',0,0.00,'Free','toUpload.mp4','denis'),(308,'','','beginner',0,0.00,'Free','toUpload.mp4','denis');
/*!40000 ALTER TABLE `courses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `price_plans`
--

DROP TABLE IF EXISTS `price_plans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `price_plans` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `billing` varchar(255) NOT NULL,
  `description` text,
  `button_url` varchar(255) DEFAULT NULL,
  `button_text` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `price_plans`
--

LOCK TABLES `price_plans` WRITE;
/*!40000 ALTER TABLE `price_plans` DISABLE KEYS */;
INSERT INTO `price_plans` VALUES (1,'Basic',0.00,'Always free','Start learning something new with basic access.','https://codecademyre.com/signup','Sign Up'),(2,'Plus',13.99,'Billed annually or $17.49 billed monthly','Build in-demand technical skills for work or a personal project.','https://codecademyre.com/signup','Try Plus'),(3,'Pro',23.99,'Billed annually or $29.99 billed monthly','Develop the skills and experience to land a job in tech.','https://codecademyre.com/signup','Try Pro');
/*!40000 ALTER TABLE `price_plans` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-06-01 15:21:58
