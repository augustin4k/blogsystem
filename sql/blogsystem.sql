-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 27, 2021 at 02:58 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blogsystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `cid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `message` text NOT NULL,
  `pid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`cid`, `uid`, `date`, `message`, `pid`) VALUES
(129, 29, '2021-05-23 16:51:09', '231rewfgw', 25),
(130, 32, '2021-05-27 01:51:05', 'qweqeqwesadasd', 29),
(131, 32, '2021-05-27 01:51:09', 'asdasdasdasddddddd', 30),
(132, 32, '2021-05-27 01:51:13', '123123123123eqweqw', 28),
(133, 32, '2021-05-27 01:51:17', 'qqweqeqwgsfdgsdfg', 29),
(134, 29, '2021-05-27 01:51:56', 'sdasdasdaxcvxcxvcv', 29),
(135, 29, '2021-05-27 01:51:58', '', 29),
(136, 29, '2021-05-27 01:52:03', 'qqqdfdfssfsf342423', 30),
(137, 29, '2021-05-27 01:52:07', 'qweqwe123121231bvbcb', 28);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `views` int(11) NOT NULL DEFAULT 0,
  `image` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `published` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '1998-12-31 22:00:01'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `title`, `slug`, `views`, `image`, `body`, `published`, `created_at`, `updated_at`) VALUES
(25, NULL, 'eeeeeeee', 'eeeeeeee', 0, '', '<p>qweqewqeq</p>\r\n', 0, '2021-05-26 22:50:35', '2021-05-26 22:50:35'),
(28, 32, '1111111', '1111111', 4, 'heart-removebg-preview.png', '&lt;p&gt;123123123&lt;/p&gt;\r\n', 1, '2021-05-26 22:52:10', '2021-05-26 22:50:24'),
(29, 32, 'sssssssss', 'sssssssss', 8, '51f6fb256629fc755b8870c801092942 1.png', '&lt;p&gt;ssssssssdddd&lt;/p&gt;\r\n', 1, '2021-05-26 22:52:02', '2021-05-26 22:50:46'),
(30, 32, 'axxxxxxxxx', 'axxxxxxxxx', 4, 'heart-removebg-preview.png', '&lt;p&gt;xzaxaxaxaxaxaaxa&lt;/p&gt;\r\n', 1, '2021-05-26 22:52:06', '2021-05-26 22:50:56');

-- --------------------------------------------------------

--
-- Table structure for table `post_topic`
--

CREATE TABLE `post_topic` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `topic_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `post_topic`
--

INSERT INTO `post_topic` (`id`, `post_id`, `topic_id`) VALUES
(26, 25, 15),
(29, 28, 15),
(31, 29, 16),
(32, 30, 18);

-- --------------------------------------------------------

--
-- Table structure for table `topics`
--

CREATE TABLE `topics` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `topics`
--

INSERT INTO `topics` (`id`, `name`, `slug`) VALUES
(15, 'qweqewq', 'qweqewq'),
(16, 'asdasdsa', 'asdasdsa'),
(17, 'zxczxcxzc', 'zxczxcxzc'),
(18, 'tyrtyrty', 'tyrtyrty'),
(19, 'fghfghgf', 'fghfghgf'),
(20, 'vbnvbnv', 'vbnvbnv');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` enum('Author','Admin') DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `role`, `password`, `created_at`, `updated_at`, `token`, `status`) VALUES
(29, 'dima', 'dandumgic@gmail.com', 'Admin', '$2y$10$ssD60C/XxO0fT6.M21VvHuuwxAVH1jwgks3WkzgsRkCx6yoiMUcvG', '2021-05-23 13:17:24', '2021-05-23 13:17:24', '89bfa693751d1b38dd33024c66ea82c2', 1),
(31, 'vadim', 'dexami7393@sc2hub.com', 'Admin', '$2y$10$gwCwjVY4GcmjljT4hQ7SsObBU1W4YPByWIg2pIElXF5TEevmlMGYa', '2021-05-23 13:53:07', '2021-05-23 13:53:07', '49acd90730242441ef303ffb1a0c890e', 1),
(32, 'asdasd', 'lafiki1935@rphinfo.com', 'Admin', '$2y$10$TJHW3PHR5i.GXm1kJqj3Cu6kFS6R/SwGM3s7siGePtjgYQeC02A9i', '2021-05-23 13:54:56', '2021-05-23 13:54:56', 'a11e3c6a6bc5297d31ea4a3724432f1e', 1),
(33, 'qweqwe', 'qweqwe@gmail.com', 'Author', '$2y$10$jq4y0Q9nEL/TWYHVkOjB0.JyXdb6JhXdREOMNiWgEKcRdTM0iOzmS', '2021-05-26 22:49:45', '2021-05-26 22:49:45', '5d515249b76c3ddc1f31c4718d28bdc8', 0),
(34, 'zxczxc', 'zxczxc@gmail.com', 'Author', '$2y$10$IVNk1qeGh.zjM7S8wcemb.s3GgUcSYIEtQRf/CT9VzWH3.2JFugKK', '2021-05-26 22:50:06', '2021-05-26 22:50:06', '9f4848683850e589464f4869a1fce604', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`cid`),
  ADD KEY `uid` (`uid`),
  ADD KEY `pid` (`pid`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `posts_ibfk_1` (`user_id`);

--
-- Indexes for table `post_topic`
--
ALTER TABLE `post_topic`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `post_id` (`post_id`),
  ADD KEY `topic_id` (`topic_id`);

--
-- Indexes for table `topics`
--
ALTER TABLE `topics`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=138;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `post_topic`
--
ALTER TABLE `post_topic`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `topics`
--
ALTER TABLE `topics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`pid`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `post_topic`
--
ALTER TABLE `post_topic`
  ADD CONSTRAINT `post_topic_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `post_topic_ibfk_2` FOREIGN KEY (`topic_id`) REFERENCES `topics` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
