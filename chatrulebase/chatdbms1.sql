-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 30, 2023 at 03:39 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `chatdbms1`
--

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `content`) VALUES
(1, 'gn'),
(2, 'hi'),
(3, 'hello'),
(4, 'hi'),
(5, 'hello'),
(6, 'hi'),
(7, 'hello'),
(8, 'hello'),
(9, 'hi'),
(10, 'hello'),
(11, 'tgh'),
(12, 'Hi'),
(13, 'hello'),
(14, 'Hi'),
(15, 'hello'),
(16, 'how can i issu the book from libtiry'),
(17, 'how issue book'),
(18, 'Can I renew my borrowed book?'),
(19, 'Of course! I can assist you with renewing your borrowed book. Please provide me with the title or your library ID.'),
(20, 'Are there any upcoming library events?'),
(21, 'Are there any upcoming library events?'),
(22, 'How can I issue a book from the library?'),
(23, 'Are there any upcoming library events?'),
(24, 'hi'),
(25, 'hello'),
(26, 'Are there any upcoming library events?'),
(27, 'I forgot to return my book. What should I do?'),
(28, 'hi'),
(29, 'hello'),
(30, 'hello'),
(31, 'Hello! How can I assist you today?'),
(32, 'How can I issue a book from the library?'),
(33, 'I forgot to return my book. What should I do?'),
(34, 'Are there any upcoming library events?'),
(35, 'Are there any upcoming library events?'),
(36, 'Are there any upcoming library events?'),
(37, 'How can I issue a book from the library?'),
(38, 'Is it possible to extend the borrowing period?'),
(39, 'Of course! I can assist you with renewing your borrowed book. Please provide me with the title or your library ID.'),
(40, 'python'),
(41, 'hi'),
(42, 'hello'),
(43, 'Are there any upcoming library events?'),
(44, 'Can I renew my borrowed book?'),
(45, 'Of course! I can assist you with renewing your borrowed book. Please provide me with the title or your library ID.'),
(46, 'Are there any upcoming library events?'),
(47, 'I forgot to return my book. What should I do?'),
(48, 'Can you recommend a good mystery novel?'),
(49, 'How can I update my contact information?'),
(50, 'Are there any upcoming library events?'),
(51, 'hi'),
(52, 'hello'),
(53, 'hello'),
(54, 'Hello! How can I assist you today?'),
(55, 'issue book'),
(56, 'How can I update my contact information?'),
(57, 'hi'),
(58, 'hello,Hello! How can I assist you today?'),
(59, 'kese ho'),
(60, 'hui'),
(61, 'issue'),
(62, 'issue'),
(63, 'book'),
(64, 'hui'),
(65, 'issue'),
(66, 'book'),
(67, 'h'),
(68, 'hi'),
(69, 'hello,Hello! How can I assist you today?'),
(70, 'hi'),
(71, 'hello,Hello! How can I assist you today?'),
(72, 'hi'),
(73, 'hello,Hello! How can I assist you today?'),
(74, 'a'),
(75, 'h'),
(76, 'hi'),
(77, 'hello,Hello! How can I assist you today?'),
(78, 'hi'),
(79, 'hello,Hello! How can I assist you today?'),
(80, 'hi'),
(81, 'hello,Hello! How can I assist you today?'),
(82, 'h'),
(83, 'hi'),
(84, 'hello,Hello! How can I assist you today?'),
(85, 'Are there any upcoming library events?'),
(86, 'How can I issue a book from the library?'),
(87, 'Hi'),
(88, 'hello,Hello! How can I assist you today?'),
(89, 'hello,Hello! How can I assist you today?'),
(90, 'How can I issue a book from the library?'),
(91, 'Are there any upcoming library events?'),
(92, 'Are there any upcoming library events?'),
(93, 'hello'),
(94, 'Hello! How can I assist you today?'),
(95, 'Hello! How can I assist you today?'),
(96, 'Hi'),
(97, 'hello,Hello! How can I assist you today?'),
(98, 'Are there any upcoming library events?'),
(99, 'I hVE a oriblem'),
(100, 'What types of books are available?'),
(101, 'Certainly! Our library offers a diverse collection of books spanning various genres, including fiction, non-fiction, academic, and more. Feel free to search for specific titles or genres.'),
(102, 'Are there any upcoming library events?'),
(103, 'How can I issue a book from the library?'),
(104, 'Are there any upcoming library events?'),
(105, 'I returned my book late. How much is the fine?'),
(106, 'To determine the late return fine, could you please provide the title of the book or your library ID?'),
(107, 'Hi'),
(108, 'hello,Hello! How can I assist you today?'),
(109, 'Are there any upcoming library events?');

-- --------------------------------------------------------

--
-- Table structure for table `responses`
--

CREATE TABLE `responses` (
  `id` int(11) NOT NULL,
  `trigger_phrase` varchar(255) NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `responses`
--

INSERT INTO `responses` (`id`, `trigger_phrase`, `content`) VALUES
(1, 'hi', 'hello,Hello! How can I assist you today?'),
(6, 'hello', 'Hello! How can I assist you today?'),
(7, 'How can I issue a book from the library?', 'To issue a book from the library, you can search for the book you\'re interested in and then follow the borrowing process. I can guide you through it if you\'d like.'),
(8, 'What\'s the process for borrowing a book?', 'To issue a book from the library, you can search for the book you\'re interested in and then follow the borrowing process. I can guide you through it if you\'d like.'),
(9, 'Can you tell me more about the library\'s collection?', 'Certainly! Our library offers a diverse collection of books spanning various genres, including fiction, non-fiction, academic, and more. Feel free to search for specific titles or genres.'),
(10, 'What types of books are available?', 'Certainly! Our library offers a diverse collection of books spanning various genres, including fiction, non-fiction, academic, and more. Feel free to search for specific titles or genres.'),
(11, 'Do you have \'The Great Gatsby\' in your collection?', 'Let me check for you. Please wait a moment while I search our collection.'),
(12, 'Is \'Harry Potter and the Sorcerer\'s Stone\' available?', 'Let me check for you. Please wait a moment while I search our collection.'),
(13, 'Can you recommend a good mystery novel?', 'Sure! For mystery novels, I recommend \'Gone Girl\' by Gillian Flynn. And for science fiction, you might enjoy \'Dune\' by Frank Herbert.'),
(14, 'I\'m interested in science fiction. Any recommendations?', 'Sure! For mystery novels, I recommend \'Gone Girl\' by Gillian Flynn. And for science fiction, you might enjoy \'Dune\' by Frank Herbert.'),
(15, 'How can I donate books to the library?', 'We appreciate your interest in donating books! You can use the \'Donate Book\' feature to submit a form with details about the books you\'d like to donate.'),
(16, 'Is there a way to contribute books to your collection?', 'We appreciate your interest in donating books! You can use the \'Donate Book\' feature to submit a form with details about the books you\'d like to donate.'),
(17, 'Is \'To Kill a Mockingbird\' currently available?', 'Let me check the availability of \'To Kill a Mockingbird\' for you.'),
(18, 'When is my book due?', 'Sure! Could you please provide me with the title of the book you\'ve borrowed?'),
(19, 'Can I renew my borrowed book?', 'Of course! I can assist you with renewing your borrowed book. Please provide me with the title or your library ID.'),
(20, 'Is it possible to extend the borrowing period?', 'Of course! I can assist you with renewing your borrowed book. Please provide me with the title or your library ID.'),
(21, 'I returned my book late. How much is the fine?', 'To determine the late return fine, could you please provide the title of the book or your library ID?'),
(22, 'How can I update my contact information?', 'To update your contact information, log in to your account and go to the \'Account Settings\' section.'),
(23, 'What are the library\'s opening hours?', 'The library is open [insert opening hours here]. Please note that these hours might change during holidays.'),
(24, 'I forgot to return my book. What should I do?', 'Don\'t worry! If your book is overdue, return it as soon as possible to avoid additional fines.'),
(25, 'How can I contact the library\'s customer support?', 'You can reach our customer support team via email at [insert email address] or by calling [insert phone number].'),
(26, 'Are there any upcoming library events?', 'Yes, we have exciting events planned. For detailed information, please visit our \'Events\' page on the website.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `responses`
--
ALTER TABLE `responses`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT for table `responses`
--
ALTER TABLE `responses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
