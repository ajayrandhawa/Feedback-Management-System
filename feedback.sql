-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 26, 2022 at 06:24 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `feedback`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `email`, `password`) VALUES
(1, 'admin', 'admin@admin.com', '9ae2be73b58b565bce3e47493a56e26a');

-- --------------------------------------------------------

--
-- Table structure for table `appbuffer`
--

CREATE TABLE `appbuffer` (
  `id` int(11) NOT NULL,
  `buffer` varchar(100) NOT NULL,
  `theory` int(5) NOT NULL DEFAULT '0',
  `lab` int(5) NOT NULL DEFAULT '0',
  `review` int(5) NOT NULL DEFAULT '0',
  `feedtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `id` int(11) NOT NULL,
  `cname` varchar(50) NOT NULL,
  `ccode` varchar(50) NOT NULL,
  `status` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`id`, `cname`, `ccode`, `status`) VALUES
(6, 'CSE-1-Sem-A2', 'A2', 1);

-- --------------------------------------------------------

--
-- Table structure for table `feedbackdata_lab`
--

CREATE TABLE `feedbackdata_lab` (
  `SubmissionID` int(11) NOT NULL,
  `class` varchar(50) NOT NULL,
  `SubjectName` varchar(100) NOT NULL,
  `ParameterName` varchar(100) NOT NULL,
  `Rating` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `feedbackdata_lab`
--

INSERT INTO `feedbackdata_lab` (`SubmissionID`, `class`, `SubjectName`, `ParameterName`, `Rating`) VALUES
(37, 'CSE-1-Sem-A2', 'Communicative_English', 'Knowledge_of_Lab_Course', 3),
(38, 'CSE-1-Sem-A2', 'Engineering_Physics', 'Knowledge_of_Lab_Course', 3),
(39, 'CSE-1-Sem-A2', 'Electrical_Engineering', 'Knowledge_of_Lab_Course', 3),
(40, 'CSE-1-Sem-A2', 'Communicative_English', 'Discipline_Maintained', 2),
(41, 'CSE-1-Sem-A2', 'Engineering_Physics', 'Discipline_Maintained', 3),
(42, 'CSE-1-Sem-A2', 'Electrical_Engineering', 'Discipline_Maintained', 3),
(43, 'CSE-1-Sem-A2', 'Communicative_English', 'Punctuality_in_Lab', 1),
(44, 'CSE-1-Sem-A2', 'Engineering_Physics', 'Punctuality_in_Lab', 1),
(45, 'CSE-1-Sem-A2', 'Electrical_Engineering', 'Punctuality_in_Lab', 1);

-- --------------------------------------------------------

--
-- Table structure for table `feedbackdata_review`
--

CREATE TABLE `feedbackdata_review` (
  `id` int(11) NOT NULL,
  `class` varchar(50) NOT NULL,
  `msg` varchar(1000) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `feedbackdata_review`
--

INSERT INTO `feedbackdata_review` (`id`, `class`, `msg`, `time`) VALUES
(1, 'CSE-1-Sem-A2', 'No Error', '2018-09-23 16:00:47');

-- --------------------------------------------------------

--
-- Table structure for table `feedbackdata_theory`
--

CREATE TABLE `feedbackdata_theory` (
  `SubmissionID` int(11) NOT NULL,
  `class` varchar(50) NOT NULL,
  `SubjectName` varchar(100) NOT NULL,
  `ParameterName` varchar(100) NOT NULL,
  `Rating` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `feedbackdata_theory`
--

INSERT INTO `feedbackdata_theory` (`SubmissionID`, `class`, `SubjectName`, `ParameterName`, `Rating`) VALUES
(171, 'CSE-1-Sem-A2', 'Communicative_English', 'Preparation_of_Lecture', 5),
(172, 'CSE-1-Sem-A2', 'Engineering_Physics', 'Preparation_of_Lecture', 5),
(173, 'CSE-1-Sem-A2', 'Engineering_Mathematics', 'Preparation_of_Lecture', 5),
(174, 'CSE-1-Sem-A2', 'Human_Value_and_Professional_Ethics', 'Preparation_of_Lecture', 5),
(175, 'CSE-1-Sem-A2', 'Electrical_Engineering', 'Preparation_of_Lecture', 5),
(176, 'CSE-1-Sem-A2', 'Communicative_English', 'Effective_use_of_ICT', 4),
(177, 'CSE-1-Sem-A2', 'Engineering_Physics', 'Effective_use_of_ICT', 4),
(178, 'CSE-1-Sem-A2', 'Engineering_Mathematics', 'Effective_use_of_ICT', 4),
(179, 'CSE-1-Sem-A2', 'Human_Value_and_Professional_Ethics', 'Effective_use_of_ICT', 4),
(180, 'CSE-1-Sem-A2', 'Electrical_Engineering', 'Effective_use_of_ICT', 4),
(181, 'CSE-1-Sem-A2', 'Communicative_English', 'Punctuality', 3),
(182, 'CSE-1-Sem-A2', 'Engineering_Physics', 'Punctuality', 3),
(183, 'CSE-1-Sem-A2', 'Engineering_Mathematics', 'Punctuality', 3),
(184, 'CSE-1-Sem-A2', 'Human_Value_and_Professional_Ethics', 'Punctuality', 3),
(185, 'CSE-1-Sem-A2', 'Electrical_Engineering', 'Punctuality', 3);

-- --------------------------------------------------------

--
-- Table structure for table `parameters`
--

CREATE TABLE `parameters` (
  `ParameterID` int(11) NOT NULL,
  `ParameterName` varchar(100) NOT NULL,
  `ParameterType` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `parameters`
--

INSERT INTO `parameters` (`ParameterID`, `ParameterName`, `ParameterType`) VALUES
(24, 'Preparation of Lecture', 'Theory'),
(26, 'Effective use of ICT', 'Theory'),
(29, 'Punctuality', 'Theory'),
(34, 'Knowledge of Lab Course', 'LAB'),
(39, 'Discipline Maintained', 'LAB'),
(40, 'Punctuality in Lab', 'LAB');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(11) NOT NULL,
  `subjecttype` varchar(50) NOT NULL,
  `SubjectName` varchar(50) NOT NULL,
  `subjectcode` varchar(50) NOT NULL,
  `teachername` varchar(100) NOT NULL,
  `classname` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `subjecttype`, `SubjectName`, `subjectcode`, `teachername`, `classname`) VALUES
(30, 'Theory', 'Communicative English', 'ACHU-101', 'Varun Mehra', 'CSE-1-Sem-A2'),
(31, 'Theory', 'Engineering Physics', 'ACPH-101', 'Navdeep Singh', 'CSE-1-Sem-A2'),
(32, 'Theory', 'Engineering Mathematics', 'ACAM-101', 'Neha Arora', 'CSE-1-Sem-A2'),
(33, 'Theory', 'Human Value and Professional Ethics', 'ACHV-101', 'Anujeet Kamal', 'CSE-1-Sem-A2'),
(34, 'Theory', 'Electrical Engineering', 'ACEE-101', 'Narinder Sharma', 'CSE-1-Sem-A2'),
(35, 'LAB', 'Communicative English', 'ACHU-103', 'Varun Mehra', 'CSE-1-Sem-A2'),
(36, 'LAB', 'Engineering Physics', 'ACPH-102', 'Navdeep Singh', 'CSE-1-Sem-A2'),
(37, 'LAB', 'Electrical Engineering', 'ACEE-102', 'Narinder Sharma', 'CSE-1-Sem-A2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `appbuffer`
--
ALTER TABLE `appbuffer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedbackdata_lab`
--
ALTER TABLE `feedbackdata_lab`
  ADD PRIMARY KEY (`SubmissionID`);

--
-- Indexes for table `feedbackdata_review`
--
ALTER TABLE `feedbackdata_review`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedbackdata_theory`
--
ALTER TABLE `feedbackdata_theory`
  ADD PRIMARY KEY (`SubmissionID`);

--
-- Indexes for table `parameters`
--
ALTER TABLE `parameters`
  ADD PRIMARY KEY (`ParameterID`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `appbuffer`
--
ALTER TABLE `appbuffer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `feedbackdata_lab`
--
ALTER TABLE `feedbackdata_lab`
  MODIFY `SubmissionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `feedbackdata_review`
--
ALTER TABLE `feedbackdata_review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `feedbackdata_theory`
--
ALTER TABLE `feedbackdata_theory`
  MODIFY `SubmissionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=186;

--
-- AUTO_INCREMENT for table `parameters`
--
ALTER TABLE `parameters`
  MODIFY `ParameterID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
