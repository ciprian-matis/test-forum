-- phpMyAdmin SQL Dump
-- version 4.0.10.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 18, 2014 at 08:30 AM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `test`
--

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `id_comment`, `name`, `comment`, `reply`) VALUES
(36, 1, 'Ovidiu', 'nu prea cred', ''),
(36, 2, 'Vasile', 'este incorect raspunsul tau', ''),
(36, 3, 'Rodica', 'totul este adevarat', ''),
(36, 3, 'calin', '', 'nu'),
(36, 1, 'Florin', '', 'Este adevarat'),
(36, 6, 'Ionel', 'Lorem ipsum ...', '');

--
-- Dumping data for table `comments2`
--

INSERT INTO `comments2` (`id`, `id_topic`, `id_comment`, `content`, `author`, `date`) VALUES
(1, 36, 0, 'nu prea cred', 'Ovidiu', '2014-12-11'),
(2, 36, 0, 'este incorect raspunsul tau', 'Vasile', '2014-12-11'),
(3, 36, 0, 'totul este adevarat', 'Rodica', '2014-12-11'),
(4, 36, 3, 'nu', 'calin', '2014-12-11'),
(5, 36, 1, 'Este adevarat', 'Florin', '2014-12-11'),
(7, 36, 4, 'Lorem ipsum dolor ...', 'Ionel', '2014-12-10'),
(8, 46, 0, 'asd ac aada', 'Ionel', '2014-12-11'),
(9, 46, 0, 'nu e corect ...', 'Florin', '2014-12-11'),
(10, 36, 7, 'Asa si asa', 'Calin', '2014-12-12'),
(11, 36, 4, 'calin are dreptate', 'Ana', '2014-12-12'),
(12, 17, 0, 'Cel mai tare topic ever', 'Calin', '2014-12-15'),
(13, 17, 12, 'nu prea cred', 'Ionel', '2014-12-15'),
(14, 17, 0, 'nu mai are rost', 'Florina', '2014-12-15'),
(15, 17, 14, 'ba da', 'Ionel', '2014-12-15'),
(16, 17, 15, 'sigur ... da da', 'Ionela', '2014-12-15'),
(17, 17, 16, 'inca o chestie', 'Catalin', '2014-12-15'),
(18, 17, 17, 'si mai gogonata', 'Manuela', '2014-12-15'),
(19, 17, 17, 'hai lasa', 'Viorel', '2014-12-15'),
(20, 17, 17, 'parca era altceva', 'Q13', '2014-12-15'),
(21, 17, 15, 'nu este adevarat', 'Florin', '2014-12-15'),
(22, 22, 0, 'Prima', 'Catalina', '2014-12-15'),
(23, 44, 0, 'asda', 'Ionica si Abdrei', '2014-12-16'),
(24, 22, 0, 'a doua', 'Madalina', '2014-12-17'),
(25, 47, 0, 'Prima', 'Ionela', '2014-12-17'),
(26, 47, 25, 'nu esti prima', 'Catalin', '2014-12-17'),
(27, 47, 26, 'Ba da', 'Ionela', '2014-12-17'),
(28, 47, 27, 'ma lesi', 'Ionica si Abdrei', '2014-12-17'),
(29, 47, 28, 'aha', 'catalin', '2014-12-17'),
(30, 47, 29, 'tesd', 'Q13', '2014-12-17'),
(31, 47, 28, 'Poate ca nu stie', 'Ion', '2014-12-17'),
(32, 47, 25, 'de la Ploiesti', 'Marin', '2014-12-17'),
(33, 47, 0, 'din apuseni', 'Marcel', '2014-12-17'),
(34, 47, 27, 'da', 'Viorel', '2014-12-17');

--
-- Dumping data for table `topics`
--

INSERT INTO `topics` (`id`, `title`, `description`) VALUES
(17, 'Goals', 'The Strategy: What are the emotions you can amplify, the connections you can make that will cause someone to do something they''ve hesitated to do in the past (change)? The strategy isn''t the point, it''s the lever that helps you cause the change you seek.\r\n\r\nThe Tactics: What are the actions you take that cause the strategy to work? What are the events and interactions that, when taken together, comprise your strategy?'),
(18, 'Complete PHPBridge', 'Because I am awesome ad'),
(20, 'Make Rainbow ElePHPants', 'Create an elePHPant with rainbow fur'),
(21, 'Make Giant Kittens', 'Like kittens, but larger'),
(22, 'Complete PHPBridge', 'Because I am awesome'),
(35, 'Nedefinit', 'Nu are nici\r\no legatura\r\ncu acest test'),
(36, 'Placebo', 'Marketers make change happen. Good marketing can change governments, heal the sick and bring a new technology to the masses. Marketers spend money (sometimes lots of it), take our time and transform our culture. It''s quite a powerful position to be in. \r\n\r\nWho decides, then, what and how it''s okay to market?\r\n\r\nAt a recent conference for non-profits, a college student asked me, "what right does a public health person have to try to change the behavior of an at-risk group?" That one was easy for me. How can they not work to tell stories and share information that will help those at risk change that behavior? \r\n'),
(37, 'Alt topic', 'tasdfaf\r\nsasdada\r\nasd\r\nasdasd\r\n\r\nasd\r\n'),
(39, 'Another', 'In about a week, I''m hosting a design sprint, and I thought it would be worth sharing the details widely because perhaps you should have one too.\r\n\r\nI''m poking around in the early stages of developing some new projects, and one of them tries to solve a widespread problem with a new approach on mobile devices.\r\n\r\nTo take it to the next level, I''m hosting a 6-hour design sprint in my office (outside of New York City) for a few people. The notion (which I have found useful for many projects) is to get some motivated, talented people together to whiteboard possibilities and challenges and to open doors to new ways of thinking. The participants get paid of course, but even better, they get the energy that comes from a collision with other creative people.'),
(42, 'Nu este corect', 'Nimic nu este corect'),
(44, 'Teste', 'Add appropriate icons to the Edit and Delete buttons\r\nAdd a downvote button that does the opposite of what the upvote button does\r\nAdd an ''about'' page, linked from the bottom of the Suggestotron topics list. Link back to the Topics list from the About page so users don''t get stranded.\r\nAdd success messages when adding/editing topics\r\nAdd error messages when adding/editing/deleting topics\r\nMake it so that all error messages are shown in the templates (e.g. going to the edit page without an ID)'),
(45, 'asdas', 'asdasda'),
(46, 'Teste', 'fffffffffffffffffff'),
(47, 'Teste pentru verificari', 'Sa vedem cum functioneaza sau nu');

--
-- Dumping data for table `votes`
--

INSERT INTO `votes` (`id`, `topic_id`, `count`, `down`) VALUES
(1, 17, 19, 11),
(5, 35, 14, 10),
(6, 36, 24, 12),
(7, 37, 0, 0),
(9, 22, 4, 6),
(12, 42, 1, 0),
(14, 44, 0, 0),
(15, 45, 0, 0),
(16, 46, 0, 0),
(17, 47, 52, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
