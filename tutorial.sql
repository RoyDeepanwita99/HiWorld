-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 10, 2023 at 06:17 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tutorial`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `content`, `post_id`, `user_id`) VALUES
(8, 'I have a question, Why need database in real life?', 7, 1),
(9, 'xd fchbjm ik ujgvbgvft', 11, 1),
(10, 'rxdhbyfdcmkiyholyhujkgy', 16, 1),
(11, 'ghnvgnjgy', 19, 1),
(12, 'Thanks', 20, 1),
(13, 'Describe the normalization', 21, 3),
(14, 'Thanks', 22, 3),
(15, 'Thanks', 21, 4),
(16, 'How I learn easily?', 22, 4),
(17, 'How I implement the heap sort? ', 23, 4),
(18, 'Need more information\r\n', 21, 5);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `time` int(255) NOT NULL,
  `edited_at` int(128) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `title`, `content`, `user_id`, `time`, `edited_at`) VALUES
(21, 'Database Edited', 'A database is an organized collection of structured information, or data, typically stored electronically in a computer system. A database is usually controlled by a database management system (DBMS). Together, the data and the DBMS, along with the applications that are associated with them, are referred to as a database system, often shortened to just database.\r\n\r\nData within the most common types of databases in operation today is typically modeled in rows and columns in a series of tables to make processing and data querying efficient. The data can then be easily accessed, managed, modified, updated, controlled, and organized. Most databases use structured query language (SQL) for writing and querying data.', 1, 0, 1696911388),
(22, 'Web Engineering Modified', 'The World Wide Web has become a major delivery platform for a variety of complex and sophisticated enterprise applications in several domains. In addition to their inherent multifaceted functionality, these Web applications exhibit complex behaviour and place some unique demands on their usability, performance, security, and ability to grow and evolve. However, a vast majority of these applications continue to be developed in an ad hoc way, contributing to problems of usability, maintainability, quality and reliability.[1][2] While Web development can benefit from established practices from other related disciplines, it has certain distinguishing characteristics that demand special considerations. In recent years, there have been developments towards addressing these considerations.', 1, 0, 1696911098),
(23, 'Algorithm', 'Algorithms are used to find the best possible way to solve a problem, based on data storage, sorting and processing, and machine learning. In doing so, they improve the efficiency of a program.\r\n\r\nAlgorithms are used in all areas of computing. Because it is a fantastic way of automating computer decisions. \r\n\r\nLet\'s say you have to drive 200 km to your vacation spot. After checking what the shortest route is (data sorting), how to avoid traffic based on previous or current data (data storage), or how the weather forecast may impact your driving (data analysis), the algorithm will give you the best route and your estimated arrival time (data structure and algorithms are good friends in computer science, machine learning.', 3, 0, 0),
(24, 'Networking', 'Networking is the process of making connections and building relationships. These connections can provide you with advice and contacts, which can help you make informed career decisions. Networking can even help you ﬁnd unadvertised jobs/internships. Networking can take place in a group or one-on-one setting.\r\n\r\nHow Do I Start Networking?\r\nBrainstorm to think about who your connections are and who they might know. \r\n\r\nWrite down the names of people already in your network. Consider people you know:\r\n\r\nColumbia professors and staff members\r\nFormer supervisors or colleagues\r\nParents’ friends\r\nClassmates and club/organization members\r\nRecent alumni\r\nAfter creating your list of your current contacts, you can start thinking about who these people can connect you with. If you don’t ask, you’ll never know!', 4, 0, 0),
(25, 'new post', 'new post description', 1, 1696908010, 0);

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `question_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`) VALUES
(1, 'Nasim', '01790'),
(2, 'Protyush', '12345'),
(3, 'Abdullah', '12345'),
(4, 'Asif', '12345'),
(5, 'Imran', '12345'),
(6, 'Rifat', '12345');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`question_id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `question_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
