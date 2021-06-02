-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 23, 2021 at 04:18 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.4.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `libraryDB`
--

-- --------------------------------------------------------

--
-- Table structure for table `Author`
--

CREATE TABLE `Author` (
  `id` int(11) NOT NULL,
  `AuthorName` text NOT NULL,
  `Reg Date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Author`
--

INSERT INTO `Author` (`id`, `AuthorName`, `Reg Date`) VALUES
(25, 'J. K. Rowling', '2021-05-21 20:37:59'),
(26, 'Jane Austen', '2021-05-22 05:53:15'),
(27, 'William Golding', '2021-05-22 06:40:54'),
(28, 'BJ', '2021-05-22 06:55:13');

-- --------------------------------------------------------

--
-- Table structure for table `Book`
--

CREATE TABLE `Book` (
  `bookID` int(11) NOT NULL,
  `BookName` text NOT NULL,
  `authorID` int(11) NOT NULL,
  `categoryID` int(11) NOT NULL,
  `BookPrice` int(11) NOT NULL,
  `BookISBN` bigint(13) NOT NULL,
  `Reg Date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Book`
--

INSERT INTO `Book` (`bookID`, `BookName`, `authorID`, `categoryID`, `BookPrice`, `BookISBN`, `Reg Date`) VALUES
(12, 'Harry Potter', 25, 9, 4, 978073936, '2021-05-21 20:38:07'),
(13, 'Pride and Prejudice', 26, 2, 5, 9780143058175, '2021-05-22 05:53:43'),
(14, 'The Ickabog', 25, 1, 3, 9781338732870, '2021-05-22 05:59:00'),
(15, 'Lord of the Flies', 27, 6, 4, 9780141800967, '2021-05-22 06:40:54'),
(16, 'Refugee Boy', 28, 9, 6, 9780747550861, '2021-05-22 06:55:13');

-- --------------------------------------------------------

--
-- Table structure for table `Category`
--

CREATE TABLE `Category` (
  `id` int(11) NOT NULL,
  `CategoryName` text NOT NULL,
  `Status` int(11) NOT NULL DEFAULT 1,
  `Reg Date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Category`
--

INSERT INTO `Category` (`id`, `CategoryName`, `Status`, `Reg Date`) VALUES
(1, 'Horrors', 1, '2021-05-20 00:33:33'),
(2, 'Romance', 1, '2021-05-21 11:25:51'),
(3, 'Thrill', 1, '2021-05-21 11:38:17'),
(4, 'Biographies & Memoirs', 1, '2021-05-21 11:51:48'),
(5, 'Education & Reference', 1, '2021-05-21 11:52:37'),
(6, 'Literature & Fiction', 1, '2021-05-21 12:59:24'),
(7, 'History', 1, '2021-05-21 15:53:42'),
(8, 'Science & Math', 1, '2021-05-21 21:31:43'),
(9, 'Teen & Young Adult', 1, '2021-05-21 21:31:54');

-- --------------------------------------------------------

--
-- Table structure for table `IssueDetails`
--

CREATE TABLE `IssueDetails` (
  `issueID` int(11) NOT NULL,
  `studentID` int(11) NOT NULL,
  `bookID` int(11) NOT NULL,
  `IssueDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `ReturnDate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Status` int(11) NOT NULL,
  `Fine` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `Student`
--

CREATE TABLE `Student` (
  `id` int(11) NOT NULL,
  `FullName` text NOT NULL,
  `Email` text NOT NULL,
  `MobileNumber` text NOT NULL,
  `Password` text NOT NULL,
  `Reg Date` timestamp NOT NULL DEFAULT current_timestamp(),
  `Status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Student`
--

INSERT INTO `Student` (`id`, `FullName`, `Email`, `MobileNumber`, `Password`, `Reg Date`, `Status`) VALUES
(19, 'Mostafa Shenavaei', 'mostafa.shena@gmail.com', '+44 740 576 0048', 'fabb17b072e862431544759415c51bdd', '2021-05-16 16:58:29', 1),
(20, 'Mahaa', 'mohishenaa@gmail.com', '+44 7448 416089', 'fdd8065b60f6cb42c2be12dfbad4343a', '2021-05-16 22:52:33', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Author`
--
ALTER TABLE `Author`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Book`
--
ALTER TABLE `Book`
  ADD PRIMARY KEY (`bookID`),
  ADD KEY `authorID` (`authorID`),
  ADD KEY `categoryID` (`categoryID`);

--
-- Indexes for table `Category`
--
ALTER TABLE `Category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `IssueDetails`
--
ALTER TABLE `IssueDetails`
  ADD PRIMARY KEY (`issueID`),
  ADD KEY `bookID` (`bookID`);

--
-- Indexes for table `Student`
--
ALTER TABLE `Student`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Author`
--
ALTER TABLE `Author`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `Book`
--
ALTER TABLE `Book`
  MODIFY `bookID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `Category`
--
ALTER TABLE `Category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `IssueDetails`
--
ALTER TABLE `IssueDetails`
  MODIFY `issueID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Student`
--
ALTER TABLE `Student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Book`
--
ALTER TABLE `Book`
  ADD CONSTRAINT `book_ibfk_3` FOREIGN KEY (`authorID`) REFERENCES `Author` (`id`),
  ADD CONSTRAINT `book_ibfk_4` FOREIGN KEY (`categoryID`) REFERENCES `Category` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
