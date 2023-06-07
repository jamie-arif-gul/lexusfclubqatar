-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 08, 2018 at 11:29 AM
-- Server version: 5.6.39-83.1
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `yasir_fclub`
--

-- --------------------------------------------------------

--
-- Table structure for table `accessories`
--

CREATE TABLE `accessories` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `phone_number` int(30) NOT NULL,
  `email` varchar(255) NOT NULL,
  `model` varchar(150) NOT NULL,
  `chassis_number` varchar(150) NOT NULL,
  `part_description` text NOT NULL,
  `part_number` varchar(50) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `phone_number` int(15) NOT NULL,
  `email` varchar(150) NOT NULL,
  `model` varchar(30) NOT NULL,
  `drive_date` varchar(30) NOT NULL,
  `drive_time` varchar(10) NOT NULL,
  `comments` text NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `name`, `phone_number`, `email`, `model`, `drive_date`, `drive_time`, `comments`, `created`) VALUES
(1, 'Salman', 1122, '', 'IS 350 F SPORT', '23-12-2013', '5:30 PM', 'COMMENTS', '2018-06-07 10:41:09');

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_id` int(24) DEFAULT NULL,
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `user_data` mediumtext NOT NULL,
  `added_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`session_id`, `ip_address`, `user_id`, `user_agent`, `last_activity`, `user_data`, `added_on`, `modified_on`) VALUES
('1ddf85456eeea461d977cde1d8049fd9', '212.77.219.58', NULL, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.99 Safari/537.36', 1532420520, 'a:3:{s:9:\"user_data\";s:0:\"\";s:7:\"user_id\";N;s:8:\"lang_key\";i:1;}', '2018-07-24 08:22:00', '0000-00-00 00:00:00'),
('37041a8f2dcdbecdff883e94a78816bd', '108.167.136.232', NULL, 'Mozilla/5.0 (Espyttp; Linux x86_64; en-US) EIG Espy -- DO NOT BLOCK', 1532960548, 'a:3:{s:9:\"user_data\";s:0:\"\";s:7:\"user_id\";N;s:8:\"lang_key\";i:1;}', '2018-07-30 14:22:28', '0000-00-00 00:00:00'),
('6cb0619794e1f272b56646dbccabfc4c', '117.102.33.41', NULL, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.99 Safari/537.36', 1533740973, '', '2018-08-08 15:09:33', '0000-00-00 00:00:00'),
('91d660e0988da94b5061835513e963b4', '110.36.177.8', NULL, 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.99 Safari/537.36', 1532690226, 'a:3:{s:9:\"user_data\";s:0:\"\";s:7:\"user_id\";N;s:8:\"lang_key\";i:1;}', '2018-07-27 11:17:06', '0000-00-00 00:00:00'),
('d3dfdf4307f7062cab1c7554f26c875e', '108.167.136.232', NULL, 'Mozilla/5.0 (Espyttp; Linux x86_64; en-US) EIG Espy -- DO NOT BLOCK', 1532960546, 'a:3:{s:9:\"user_data\";s:0:\"\";s:7:\"user_id\";N;s:8:\"lang_key\";i:1;}', '2018-07-30 14:22:26', '0000-00-00 00:00:00'),
('f44baf40b7965a208b97dedb1912f1f5', '117.102.33.41', NULL, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.99 Safari/537.36', 1533740973, 'a:3:{s:9:\"user_data\";s:0:\"\";s:7:\"user_id\";N;s:8:\"lang_key\";i:1;}', '2018-08-08 15:09:33', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(15) NOT NULL,
  `event_image` varchar(150) NOT NULL,
  `event_date` date NOT NULL,
  `event_time` varchar(55) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `event_image`, `event_date`, `event_time`, `created`) VALUES
(1, '1528716741.jpg', '2019-03-02', '14:01', '2018-06-11 11:32:21');

-- --------------------------------------------------------

--
-- Table structure for table `event_detail`
--

CREATE TABLE `event_detail` (
  `id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `location` varchar(50) NOT NULL,
  `lang` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `event_detail`
--

INSERT INTO `event_detail` (`id`, `event_id`, `name`, `description`, `location`, `lang`) VALUES
(1, 1, 'NAME OF EVENT', '<p>Description of event here. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean consequat metus nec pretium porta. Quisque egestas leo eu urna mattis, ac consequat eros rhoncus. </p>', 'Location here', 1),
(2, 1, 'مسمّى الفعالية', '<p>توصيف الفعالية. هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها. ولذلك يتم استخدام طريقة لوريم إيبسوم لأنها تعطي توزيعاَ طبيعياَ -إلى حد ما- للأحرف عوضاً عن استخدام &quot;هنا يوجد محتوى نصي، هنا يوجد محتوى نصي&quot; فتجعلها تبدو (أي الأحرف) وكأنها نص مقروء. </p>', 'موقع', 2);

-- --------------------------------------------------------

--
-- Table structure for table `event_users`
--

CREATE TABLE `event_users` (
  `id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `frange`
--

CREATE TABLE `frange` (
  `id` int(11) NOT NULL,
  `frange_image` varchar(200) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `frange`
--

INSERT INTO `frange` (`id`, `frange_image`, `admin_id`, `created`, `updated`) VALUES
(2, '1528719929.jpg', 1, '2018-06-11 12:25:29', '0000-00-00 00:00:00'),
(4, '1528719954.jpg', 1, '2018-06-11 12:25:54', '0000-00-00 00:00:00'),
(5, '1528719992.jpg', 1, '2018-06-11 12:26:32', '0000-00-00 00:00:00'),
(6, '1528718858.jpg', 1, '2018-06-11 12:07:38', '0000-00-00 00:00:00'),
(7, '1528720038.jpg', 1, '2018-06-11 12:27:19', '0000-00-00 00:00:00'),
(9, '1528719591.jpg', 1, '2018-06-11 12:19:51', '0000-00-00 00:00:00'),
(10, '1528719721.jpg', 1, '2018-06-11 12:22:01', '0000-00-00 00:00:00'),
(11, '1528803220.jpg', 1, '2018-06-12 11:33:40', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `frange_content`
--

CREATE TABLE `frange_content` (
  `id` int(11) NOT NULL,
  `frange_c_image` varchar(200) NOT NULL,
  `title` varchar(200) CHARACTER SET utf8 NOT NULL,
  `description` text CHARACTER SET utf8 NOT NULL,
  `lang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `frange_content`
--

INSERT INTO `frange_content` (`id`, `frange_c_image`, `title`, `description`, `lang`) VALUES
(4, '1528289544.png', 'THE STORY OF', '<p>The birth of the Lexus &lsquo;F&rsquo; legacy was on the legendary Fuji Speedway, which is one of the world&rsquo;s most challenging race tracks. It also happens to be the chief performance testing site of Lexus vehicles. Where power, sound and response are reinvented, to re-engineer an exceptional driving pleasure. It is also where the art of precision-driven engineering, the centre of the Lexus philosophy, is continually perfected.&nbsp;</p><p>The first of such an extraordinary, performance-centered engineering was introduced in 2007 with the launch of Lexus IS F. Since then, Lexus F legacy has only evolved to become the pinnacle of passion, performance, and precision. Today, the Lexus F range features an extraordinary line-up of vehicles, each designed to make a lasting impression with their, responsive performance, progressive engineering, and intuitive design.&nbsp;</p><p>The F in the Lexus F range reflects Freedom, Flair, Focus, Force, and above all the Future in automotive excellence, based on racing-inspired engineering.</p>', 1),
(5, '1528289544.png', 'تاريخ علامة', '<p>أُطلقت سيارة لكزس F العريقة على طريق Fuji Speedway الأسطوري ، والذي يعد واحداً من أكثر حلبات السباق تحدياً في العالم. فهو بمثابة الموقع الرئيسي لتجربة الأداء في سيارات لكزس. حيث يتم اختبار قوة العزم والصوت مع سرعة الاستجابة وذلك لإعادة تصميم هندسة القيادة الاستثنائية. وما زال العمل جارياً على أن يكون فن الهندسة الدقيقة متقناً بشكلٍ عالٍ، وهذا ما يشكل مركز فلسفة لكزس.</p><p>تم طرح أول تصميم هندسي استثنائي عام 2007 مع إطلاق سيارة لكزس IS F والذي يرتكز على الأداء الفريد. ومنذ ذلك الحين ، تطور إرث لكزس ليصبح رمزاً &nbsp;للأداء والدقة والشغف. الآن تتميز فئة لكزس F بمجموعة من المركبات المصممة لتترك انطباعاً دائماً عبر قوة الاستجابة والهندسة المتقدمة والتصميم المبهر.</p><p>تعكس F في فئة لكزس F: الانسيابية - الحرية - التفوق - العزم والقوة.. وقبل كل شيء المستقبل، عبر التفرد في مجال السيارات استنادًا إلى الهندسة المستوحاة من سيارات السباق.</p>', 2);

-- --------------------------------------------------------

--
-- Table structure for table `frange_detail`
--

CREATE TABLE `frange_detail` (
  `id` int(11) NOT NULL,
  `frange_id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `description` text CHARACTER SET utf8 NOT NULL,
  `lang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `frange_detail`
--

INSERT INTO `frange_detail` (`id`, `frange_id`, `title`, `description`, `lang`) VALUES
(1, 1, 'LFA', '<p>A leap ahead in design and engineering, this supercar straight from the future.</p>', 1),
(2, 1, 'LFA', '<p>قفزة نوعية في التصميم والهندسة تجعل هذه السيارة السوبر أيقونة المستقبل.</p>', 2),
(3, 2, 'RC F', '<p>A sports coup&eacute; that delivers exhilarating performance with bold, head-turning design.</p>', 1),
(4, 2, 'RC F', '<p>سيارة كوبيه الرياضية تقدم لك أداءً مبهراً مع تصميم جريء يأخذ العقول.</p>', 2),
(5, 3, 'IS F', '<p>The award-winning luxury sports sedan that attracts attention wherever it goes.</p>', 1),
(6, 3, 'IS F', '<p>سيارة السيدان الرياضية الفاخرة الحائزة على الجوائز والتي تجذب الانتباه أينما ذهبت.</p>', 2),
(7, 4, 'GS F', '<p>A hand-built, race-tuned Lexus that redefines the boundaries of power-packed performance.</p>', 1),
(8, 4, 'GS F', '<p>هذه السيارة من لكزس المصنوعة يدوياً والمعدلة خصيصاً لسباق السيارات ،تعتبر معياراً للأداء القوي.</p>', 2),
(9, 5, 'IS F', '<p>The award-winning luxury sports sedan that attracts attention wherever it goes.</p>', 1),
(10, 5, 'IS F', '<p>سيارة السيدان الرياضية الفاخرة الحائزة على الجوائز والتي تجذب الانتباه أينما ذهبت.</p>', 2),
(11, 6, 'IS F Sport', '<p>A bold expression of uncompromising design and unprecedented engineering. </p>', 1),
(12, 6, 'IS F Sport', '<p>التصميم المفعم بالجرأة والتحدي.. وهندسة غير مسبوقة.</p>', 2),
(13, 7, 'GS F Sport', '<p>A heart-racing performer, enhanced with uncompromising comfort and luxury.</p>', 1),
(14, 7, 'GS F Sport', '<p>أداء فريد يأسر القلب، معزّز بالراحة والفخامة.</p>', 2),
(15, 8, 'GS F Sport', '<p>12</p>', 1),
(16, 8, 'GS F Sport', '<p>12</p>', 2),
(17, 9, 'RC F Sport', '<p>A standout in the luxury-coupe class, balancing striking design with breathtaking performance.</p>', 1),
(18, 9, 'RD F Sport', '<p>علامة مميزة في فئة الكوبيه الفاخرة ، مع التوازن بين تصميم مذهل وأداء فائق.</p>', 2),
(19, 10, 'LC 500/500h', '<p>When expressive design comes together with the extreme engineering to create a pure performer.</p>', 1),
(20, 10, 'LC 500/500h', '<p>عندما يكون التصميم الفريد جنبًا إلى جنب مع الهندسة المتقدمة والمتطورة ليعطي أداءً بمستوى عالي الدقة.</p>', 2),
(21, 11, 'LFA', '<p>A hand-built, race-tuned Lexus that redefines the boundaries of power-packed performance. </p>', 1),
(22, 11, 'LFA', '<p>A hand-built, race-tuned Lexus that redefines the boundaries of power-packed performance. </p>', 2);

-- --------------------------------------------------------

--
-- Table structure for table `language`
--

CREATE TABLE `language` (
  `id` int(2) NOT NULL,
  `language` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `language`
--

INSERT INTO `language` (`id`, `language`) VALUES
(1, 'English'),
(2, 'Arabic');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `news_image` varchar(50) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `news_image`, `admin_id`, `created`) VALUES
(17, '1528194165.png', 1, '2018-06-05 10:15:38'),
(18, '1528194165.png', 1, '2018-06-05 10:18:13'),
(19, '1528194165.png', 1, '2018-06-05 10:19:09'),
(20, '1528194165.png', 1, '2018-06-05 10:21:37'),
(21, '1528194165.png', 1, '2018-06-05 10:22:07'),
(22, '1528194165.png', 1, '2018-06-05 10:22:30'),
(23, '1528194165.png', 1, '2018-06-05 10:22:45'),
(24, '1528194165.png', 1, '2018-06-07 11:44:25');

-- --------------------------------------------------------

--
-- Table structure for table `news_detail`
--

CREATE TABLE `news_detail` (
  `id` int(11) NOT NULL,
  `news_id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `lang` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `news_detail`
--

INSERT INTO `news_detail` (`id`, `news_id`, `title`, `description`, `lang`) VALUES
(35, 17, 'TITLE OF NEWS', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean consequat metus nec pretium porta. Quisque egestas leo eu urna mattis, ac consequat eros rhoncus.', 1),
(36, 17, 'عنوان الخبر', 'هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها.هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها.', 2),
(37, 18, 'TITLE OF NEWS', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean consequat metus nec pretium porta. Quisque egestas leo eu urna mattis, ac consequat eros rhoncus.', 1),
(38, 18, 'عنوان الخبر', 'هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها.هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها.', 2),
(39, 19, 'TITLE OF NEWS', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean consequat metus nec pretium porta. Quisque egestas leo eu urna mattis, ac consequat eros rhoncus.', 1),
(40, 19, 'عنوان الخبر', 'هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها.هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها.', 2),
(41, 20, 'TITLE OF NEWS', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean consequat metus nec pretium porta. Quisque egestas leo eu urna mattis, ac consequat eros rhoncus.', 1),
(42, 20, 'عنوان الخبر', 'هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها.هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها.', 2),
(43, 21, 'TITLE OF NEWS', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean consequat metus nec pretium porta. Quisque egestas leo eu urna mattis, ac consequat eros rhoncus.', 1),
(44, 21, 'عنوان الخبر', 'هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها.هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها.', 2),
(45, 22, 'TITLE OF NEWS', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean consequat metus nec pretium porta. Quisque egestas leo eu urna mattis, ac consequat eros rhoncus.', 1),
(46, 22, 'عنوان الخبر', 'هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها.هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها.', 2),
(47, 23, 'TITLE OF NEWS', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean consequat metus nec pretium porta. Quisque egestas leo eu urna mattis, ac consequat eros rhoncus.', 1),
(48, 23, 'عنوان الخبر', 'هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها.هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها.', 2),
(49, 24, 'TITLE OF NEWS', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean consequat metus nec pretium porta. Quisque egestas leo eu urna mattis, ac consequat eros rhoncus.', 1),
(50, 24, 'عنوان الخبر', 'هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها.هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها', 2);

-- --------------------------------------------------------

--
-- Table structure for table `offers`
--

CREATE TABLE `offers` (
  `id` int(11) NOT NULL,
  `offers_image` varchar(200) DEFAULT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `offers`
--

INSERT INTO `offers` (`id`, `offers_image`, `created`) VALUES
(1, '1528367932.png', '0000-00-00 00:00:00'),
(2, '1528367932.png', '0000-00-00 00:00:00'),
(3, '1528367932.png', '0000-00-00 00:00:00'),
(4, '1528367932.png', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `offers_content`
--

CREATE TABLE `offers_content` (
  `id` int(11) NOT NULL,
  `title` varchar(200) CHARACTER SET utf8 NOT NULL,
  `description` text CHARACTER SET utf8 NOT NULL,
  `lang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `offers_content`
--

INSERT INTO `offers_content` (`id`, `title`, `description`, `lang`) VALUES
(1, 'Latest offers', 'Our wide range of special offers means vehicle ownership is straightforward and affordable from start to finish. For more information about what is currently available you can follow the links below and fill in the online enquiry form and our friendly sales team will get back to you with expert help and advice as soon as they can.', 1),
(2, 'أحدث العروض', 'هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها. ولذلك يتم استخدام طريقة لوريم إيبسوم لأنها تعطي توزيعاَ طبيعياَ -إلى حد ما- للأحرف عوضاً عن استخدام', 2);

-- --------------------------------------------------------

--
-- Table structure for table `offers_detail`
--

CREATE TABLE `offers_detail` (
  `id` int(11) NOT NULL,
  `offers_id` int(11) NOT NULL,
  `title` varchar(200) CHARACTER SET utf8 NOT NULL,
  `description` text CHARACTER SET utf8 NOT NULL,
  `lang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `offers_detail`
--

INSERT INTO `offers_detail` (`id`, `offers_id`, `title`, `description`, `lang`) VALUES
(1, 1, 'OFFER ONE', 'Detail english', 1),
(2, 1, 'العرض الثاني', 'العرض الثاني 11', 2),
(3, 2, 'OFFER TWO', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean consequat metus nec pretium porta. Quisque egestas leo eu urna mattis, ac consequat eros rhoncus.', 1),
(4, 2, 'عنوان الخبر', 'هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها.هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها.', 2),
(5, 3, 'OFFER THREE', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean consequat metus nec pretium porta. Quisque egestas leo eu urna mattis, ac consequat eros rhoncus.', 1),
(6, 3, 'عنوان الخبر', 'هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها.هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها.', 2),
(7, 4, 'OFFER FOUR', 'OFFER THREE', 1),
(8, 4, 'عنوان الخبر', 'عنوان الخبر', 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(24) NOT NULL,
  `name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `qid` varchar(50) NOT NULL,
  `user_name` varchar(150) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `vehicle` varchar(50) NOT NULL,
  `year_of_make` varchar(30) NOT NULL,
  `chassis_number` varchar(50) NOT NULL,
  `registration_number` varchar(50) NOT NULL,
  `t_shirt_size` varchar(25) NOT NULL,
  `number` varchar(150) NOT NULL,
  `gender` varchar(30) NOT NULL DEFAULT 'Male',
  `profile_pic` varchar(255) NOT NULL,
  `registered_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_on` datetime NOT NULL,
  `account_status` tinyint(1) NOT NULL,
  `email_confirmed` tinyint(1) NOT NULL,
  `activation_hash` varchar(32) NOT NULL,
  `pass` varchar(150) NOT NULL,
  `password_reset_hash` varchar(32) NOT NULL,
  `user_role` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `last_name`, `qid`, `user_name`, `email`, `password`, `vehicle`, `year_of_make`, `chassis_number`, `registration_number`, `t_shirt_size`, `number`, `gender`, `profile_pic`, `registered_on`, `modified_on`, `account_status`, `email_confirmed`, `activation_hash`, `pass`, `password_reset_hash`, `user_role`, `is_deleted`) VALUES
(1, 'Admin', '', '1212', '', 'admin@clubqatar.com', 'd5fc8b6dfa5ce85dbeeb4d1c8f313555', 'BMW', '2018', '3232', '23232', '', '', 'Male', '1525345169.jpg', '2018-04-11 09:36:18', '0000-00-00 00:00:00', 0, 0, '', '', '', 1, 0),
(2, 'Salman', 'Saeed', '123', 'SalmanSaeed123', 'salmancheema010@gmail.com', '96e79218965eb72c92a549dd5a330112', 'IS 350 F SPORT', '2018', '111', '111', 'XS', '1111', 'Male', '', '2018-05-31 22:07:19', '0000-00-00 00:00:00', 1, 0, '4f723d5a3ac978f8c602e5628bae6d83', '111111', '', 0, 0),
(3, 'Peter Joseph', 'Joseph', '45', 'Peter JosephJoseph45', 'tester@gmail.com', 'cc03e747a6afbbcbf8be7668acfebee5', 'IS 350 F SPORT', '2018', '123123123', '123123', '', '7215368921', 'Male', '', '2018-06-27 08:10:17', '0000-00-00 00:00:00', 1, 0, 'c07275908ef11ad0dd514fcab557cf52', 'test123', '', 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accessories`
--
ALTER TABLE `accessories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD PRIMARY KEY (`session_id`),
  ADD KEY `last_activity_idx` (`last_activity`),
  ADD KEY `user_id_fk_ci_sessions` (`user_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event_detail`
--
ALTER TABLE `event_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_id` (`event_id`);

--
-- Indexes for table `event_users`
--
ALTER TABLE `event_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `frange`
--
ALTER TABLE `frange`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `frange_content`
--
ALTER TABLE `frange_content`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `frange_detail`
--
ALTER TABLE `frange_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `language`
--
ALTER TABLE `language`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news_detail`
--
ALTER TABLE `news_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `news_id` (`news_id`),
  ADD KEY `lang` (`lang`);

--
-- Indexes for table `offers`
--
ALTER TABLE `offers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `offers_content`
--
ALTER TABLE `offers_content`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `offers_detail`
--
ALTER TABLE `offers_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `offers_id` (`offers_id`),
  ADD KEY `lang` (`lang`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `user_role_idx` (`user_role`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accessories`
--
ALTER TABLE `accessories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `event_detail`
--
ALTER TABLE `event_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `event_users`
--
ALTER TABLE `event_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `frange`
--
ALTER TABLE `frange`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `frange_content`
--
ALTER TABLE `frange_content`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `frange_detail`
--
ALTER TABLE `frange_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `language`
--
ALTER TABLE `language`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `news_detail`
--
ALTER TABLE `news_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `offers`
--
ALTER TABLE `offers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `offers_content`
--
ALTER TABLE `offers_content`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `offers_detail`
--
ALTER TABLE `offers_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(24) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `event_detail`
--
ALTER TABLE `event_detail`
  ADD CONSTRAINT `event_detail_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `news_detail`
--
ALTER TABLE `news_detail`
  ADD CONSTRAINT `news_detail_ibfk_1` FOREIGN KEY (`news_id`) REFERENCES `news` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `offers_detail`
--
ALTER TABLE `offers_detail`
  ADD CONSTRAINT `offers_detail_ibfk_1` FOREIGN KEY (`offers_id`) REFERENCES `offers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
