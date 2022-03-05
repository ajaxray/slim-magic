-- -------------------------------------------------------------
-- TablePlus 4.0.1(373)
--
-- https://tableplus.com/
--
-- Database: slim-blog
-- Generation Time: 2021-11-15 00:36:02.7950
-- -------------------------------------------------------------


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


DROP TABLE IF EXISTS `posts`;
CREATE TABLE `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `status` char(10) COLLATE utf8mb4_unicode_ci DEFAULT 'PUBLISHED',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `posts` (`id`, `title`, `content`, `created_at`, `status`) VALUES
(6, 'Basic page', 'The easiest way to specify commonly used connection parameters is using a database URL. The scheme is used to specify a driver, the user and password in the URL encode user and password for the connection, followed by the host and port parts (the authority). \r\n\r\nThe path after the authority part represents the name of the database, sans the leading slash. Any query parameters are used as additional connection parameters.', '2021-11-07 15:14:18', 'PUBLISHED'),
(7, 'PSR-11: Container interface', '[This document](https://www.php-fig.org/psr/psr-11/) describes a common interface for dependency injection containers.\r\n\r\nThe goal set by `ContainerInterface` is to standardize how frameworks and libraries make use of a container to obtain objects and parameters (called entries in the rest of this document).\r\n\r\nThe key words \"MUST\", \"MUST NOT\", \"REQUIRED\", \"SHALL\", \"SHALL NOT\", \"SHOULD\", \"SHOULD NOT\", \"RECOMMENDED\", \"MAY\", and \"OPTIONAL\" in this document are to be interpreted as described in RFC 2119.\r\n\r\nThe word implementor in this document is to be interpreted as someone implementing the `ContainerInterface` in a dependency injection-related library or framework. Users of dependency injection containers (DIC) are referred to as user.\r\n\r\n[Read more details...](https://www.php-fig.org/psr/psr-11/)', '2021-11-07 15:34:27', 'PUBLISHED'),
(8, 'Testing SimpleMDE', '**WYSIWYG** editors that produce HTML are often complex and buggy. Markdown solves this problem in many ways, plus Markdown can be rendered natively on more platforms than HTML.\r\n\r\nHowever, *Markdown* is not a syntax that an average user will be familiar with, nor is it visually clear while editing. In otherwords, for an unfamiliar user, the syntax they write will make little sense until they click the preview button. SimpleMDE has been designed to bridge this gap for non-technical users who are less familiar with or **just learning Markdown syntax**.\r\n\r\n', '2021-11-08 00:00:08', 'PUBLISHED'),
(9, 'SimpleMDE Markdown Editor', '#### Intro\r\nGo ahead, play around with the editor! Be sure to check out **bold** and *italic* styling, or even [links](https://google.com). You can type the Markdown syntax, use the toolbar, or use shortcuts like `cmd-b` or `ctrl-b`.\r\n\r\n#### Lists\r\nUnordered lists can be started using the toolbar or by typing `* `, `- `, or `+ `. Ordered lists can be started by typing `1. `.\r\n\r\n##### Unordered\r\n* Lists are a piece of cake\r\n* They even auto continue as you type\r\n* A double enter will end them\r\n* Tabs and shift-tabs work too\r\n\r\n##### Ordered\r\n1. Numbered lists...\r\n2. ...work too!\r\n\r\n#### What about images?\r\n![Yes](https://i.imgur.com/sZlktY7.png)', '2021-11-14 20:18:54', 'PUBLISHED'),
(10, 'Doctrine DBAL', 'The Doctrine DataBase Abstraction Layer (**DBAL**) offers *an object-oriented API *and a lot of additional, horizontal features like database schema introspection and manipulation.\r\n\r\nThe fact that the Doctrine DBAL abstracts the access to the concrete database away through the use of interfaces, makes it possible to implement custom drivers that may use existing native or self-made APIs. For example, the **DBAL** ships with a driver for Oracle databases that uses the oci8 extension under the hood.\r\n\r\nThe following database vendors are currently supported:\r\n\r\n* MySQL\r\n* Oracle\r\n* Microsoft SQL Server\r\n* PostgreSQL\r\n* SQLite\r\n', '2021-11-14 21:01:47', 'PUBLISHED'),
(11, 'Skeleton', '#### A dead simple, responsive boilerplate.\r\n\r\n1. **Light as a feathe**r at ~400 lines & built with mobile in mind. \r\n2. Styles designed to be a starting point, *not a UI framework*. \r\n3. **Quick to start **with zero compiling or installing necessary.\r\n\r\n![Skeleton Dance](https://i.imgur.com/PE7Y8dE.gif)\r\n\r\nYou should use [Skeleton](http://getskeleton.com) if you\'re embarking on a smaller project or just don\'t feel like you need all the utility of larger frameworks. Skeleton only styles a handful of standard HTML elements and includes a grid, but that\'s often more than enough to get started. In fact, this site is built on Skeleton and has ~200 lines of custom CSS (half of which is the docking navigation).\r\n\r\n> Love Skeleton and want to Tweet it, share it, or star it? Well, I appreciate that <3\r\n\r\n', '2021-11-14 21:06:20', 'PUBLISHED');


/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;