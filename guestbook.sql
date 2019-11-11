SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE DATABASE IF NOT EXISTS `guestbook` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `guestbook`;


CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `author` varchar(10) NOT NULL DEFAULT '',
  `subject` tinytext NOT NULL,
  `content` text NOT NULL,
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `message` (`id`, `author`, `subject`, `content`, `date`) VALUES
(1, 'Ricky', 'A', 'a', '2019-11-11 15:28:36'),
(2, 'Semi', 'B', 'b', '2019-11-11 15:30:03'),
(3, 'Moni', 'C', 'c', '2019-11-11 15:32:34'),
(4, 'Jennifer', 'D', 'd', '2019-11-11 15:35:54'),
(5, 'Melody', 'E', 'e', '2019-11-11 15:38:29'),
(6, 'Passion', 'F', 'f', '2019-11-11 15:40:55');

ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

