-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 17, 2023 at 12:37 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tsu_full`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` tinytext NOT NULL,
  `password` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin123'),
(2, 'therealadmin', 'therealadmin123');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `id` int(11) NOT NULL,
  `course` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`id`, `course`) VALUES
(1, 'BSCS'),
(6, 'BSIS-BA'),
(4, 'BSIT-NA'),
(5, 'BSIT-TSM'),
(3, 'BSIT-WMA');

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE `faculty` (
  `id` int(11) NOT NULL,
  `facultyEmail` tinytext NOT NULL,
  `password` tinytext NOT NULL,
  `name` varchar(60) NOT NULL,
  `occupation` tinytext NOT NULL,
  `address` tinytext NOT NULL,
  `birthday` date NOT NULL,
  `age` tinyint(4) NOT NULL,
  `salary` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`id`, `facultyEmail`, `password`, `name`, `occupation`, `address`, `birthday`, `age`, `salary`) VALUES
(1, 'marced123@gmail.com', 'marced123', 'Marc Ed Austria', 'Professor', 'Tarlac', '2000-01-01', 23, '30000.00'),
(2, 'ianrex123@gmail.com', 'ianrex123', 'Ian Rex Espinosa', 'Professor', 'Tarlac', '2000-01-01', 23, '30000.00'),
(3, 'gloria123@gmail.com', 'gloria123', 'Gloria Prellejera', 'Professor', 'Tarlac', '1965-01-01', 58, '60000.00'),
(4, 'wilbert123@gmail.com', 'wilbert123', 'Wilbert John Canlapan', 'Professor', 'Tarlac', '1998-01-01', 25, '40000.00'),
(5, 'rengel123@gmail.com', 'rengel123', 'Rengel Corpuz', 'Professor', 'Tarlac', '1990-01-01', 33, '50000.00'),
(6, 'bags123@gmail.com', 'bags123', 'Carlo Bagunu', 'Professor', 'Tarlac', '1995-01-01', 28, '40000.00');

-- --------------------------------------------------------

--
-- Table structure for table `grades`
--

CREATE TABLE `grades` (
  `id` int(11) NOT NULL,
  `studentNum` int(11) NOT NULL,
  `subject` varchar(30) NOT NULL,
  `midterm` decimal(4,2) NOT NULL,
  `final` decimal(4,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `grades`
--

INSERT INTO `grades` (`id`, `studentNum`, `subject`, `midterm`, `final`) VALUES
(1, 2021300600, 'SOFTENG', '1.50', '1.25'),
(2, 2021300600, 'DS2', '1.00', '1.00'),
(3, 2021300600, 'COAL', '1.25', '1.25'),
(4, 2021300600, 'CC6', '1.00', '1.00'),
(5, 2021300600, 'WEBPROG', '1.00', '1.00'),
(6, 2021300600, 'DAA', '1.25', '1.25'),
(7, 2021300600, 'ATFL', '1.25', '1.25'),
(16, 2021300598, 'ATFL', '1.50', '1.50'),
(18, 2021300598, 'COAL', '1.25', '1.25'),
(19, 2021300598, 'DS2', '1.50', '1.50'),
(20, 2021300598, 'DAA', '1.25', '1.25'),
(21, 2021300598, 'SOFTENG', '2.75', '2.00'),
(22, 2021300598, 'CC6', '1.25', '1.25'),
(23, 2021300598, 'WEBPROG', '1.25', '1.25');

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `id` int(11) NOT NULL,
  `subject` varchar(30) NOT NULL,
  `course` varchar(30) NOT NULL,
  `section` varchar(2) NOT NULL,
  `day` tinyint(4) NOT NULL,
  `start` time NOT NULL,
  `end` time NOT NULL,
  `room` varchar(4) NOT NULL,
  `professor` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`id`, `subject`, `course`, `section`, `day`, `start`, `end`, `room`, `professor`) VALUES
(1, 'CC6', 'BSCS', '3B', 3, '13:00:00', '16:00:00', 'C412', 'Ian Rex Espinosa'),
(2, 'CC6', 'BSCS', '3B', 5, '13:00:00', '15:00:00', 'L201', 'Ian Rex Espinosa'),
(3, 'WEBPROG', 'BSCS', '3B', 3, '16:00:00', '18:00:00', 'C312', 'Marc Ed Austria'),
(4, 'WEBPROG', 'BSCS', '3B', 5, '15:00:00', '18:00:00', 'C412', 'Marc Ed Austria'),
(5, 'DS2', 'BSCS', '3B', 2, '07:00:00', '08:30:00', 'C213', 'Wilbert John Canlapan'),
(6, 'DS2', 'BSCS', '3B', 4, '07:00:00', '08:30:00', 'C213', 'Wilbert John Canlapan'),
(7, 'ATFL', 'BSCS', '3B', 2, '08:30:00', '10:00:00', 'C212', 'Rengel Corpuz'),
(8, 'ATFL', 'BSCS', '3B', 4, '08:30:00', '10:00:00', 'C212', 'Rengel Corpuz'),
(9, 'DAA', 'BSCS', '3B', 2, '10:30:00', '12:00:00', 'C213', 'Carlo Bagunu'),
(10, 'DAA', 'BSCS', '3B', 4, '10:30:00', '12:00:00', 'C213', 'Carlo Bagunu'),
(11, 'COAL', 'BSCS', '3B', 3, '07:00:00', '08:30:00', 'C213', 'Rengel Corpuz'),
(12, 'COAL', 'BSCS', '3B', 5, '07:00:00', '08:30:00', 'C213', 'Rengel Corpuz'),
(13, 'SOFTENG', 'BSCS', '3B', 3, '08:30:00', '10:00:00', 'C112', 'Gloria Prellejera'),
(14, 'SOFTENG', 'BSCS', '3B', 5, '08:30:00', '10:00:00', 'C112', 'Gloria Prellejera');

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

CREATE TABLE `section` (
  `id` int(11) NOT NULL,
  `section` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `section`
--

INSERT INTO `section` (`id`, `section`) VALUES
(1, '3A'),
(2, '3B'),
(4, '3C');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int(11) NOT NULL,
  `studentNum` int(11) NOT NULL,
  `password` tinytext NOT NULL,
  `name` tinytext NOT NULL,
  `course` varchar(30) NOT NULL,
  `section` varchar(2) NOT NULL,
  `birthday` tinytext NOT NULL,
  `address` tinytext NOT NULL,
  `age` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `studentNum`, `password`, `name`, `course`, `section`, `birthday`, `address`, `age`) VALUES
(1, 2021300600, 'thomas123', 'Thomas Chester Pabalan', 'BSCS', '3B', '2003-11-15', 'Brgy. Maligaya, TC', 20),
(4, 2021300598, 'hanzhanz', 'Hanz Christine Panesa', 'BSCS', '3B', '2002-02-17', 'Brgy. San Rafael, Tarlac City', 21);

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `id` int(11) NOT NULL,
  `subject` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`id`, `subject`) VALUES
(2, 'ATFL'),
(6, 'CC6'),
(4, 'COAL'),
(3, 'DAA'),
(1, 'DS2'),
(5, 'SOFTENG'),
(7, 'WEBPROG');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course` (`course`);

--
-- Indexes for table `faculty`
--
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`id`),
  ADD KEY `name` (`name`);

--
-- Indexes for table `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`id`),
  ADD KEY `studentNum` (`studentNum`,`subject`),
  ADD KEY `grades_subject` (`subject`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course` (`course`),
  ADD KEY `section` (`section`),
  ADD KEY `subject` (`subject`),
  ADD KEY `professor` (`professor`);

--
-- Indexes for table `section`
--
ALTER TABLE `section`
  ADD PRIMARY KEY (`id`),
  ADD KEY `section` (`section`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`),
  ADD KEY `section` (`section`),
  ADD KEY `course` (`course`),
  ADD KEY `studentNum` (`studentNum`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subject` (`subject`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `faculty`
--
ALTER TABLE `faculty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `grades`
--
ALTER TABLE `grades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `section`
--
ALTER TABLE `section`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `grades`
--
ALTER TABLE `grades`
  ADD CONSTRAINT `grades_studentNum` FOREIGN KEY (`studentNum`) REFERENCES `student` (`studentNum`) ON UPDATE CASCADE,
  ADD CONSTRAINT `grades_subject` FOREIGN KEY (`subject`) REFERENCES `subject` (`subject`) ON UPDATE CASCADE;

--
-- Constraints for table `schedule`
--
ALTER TABLE `schedule`
  ADD CONSTRAINT `schedule_course` FOREIGN KEY (`course`) REFERENCES `course` (`course`) ON UPDATE CASCADE,
  ADD CONSTRAINT `schedule_prof` FOREIGN KEY (`professor`) REFERENCES `faculty` (`name`) ON UPDATE CASCADE,
  ADD CONSTRAINT `schedule_section` FOREIGN KEY (`section`) REFERENCES `section` (`section`) ON UPDATE CASCADE,
  ADD CONSTRAINT `schedule_subject` FOREIGN KEY (`subject`) REFERENCES `subject` (`subject`) ON UPDATE CASCADE;

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `course_fk` FOREIGN KEY (`course`) REFERENCES `course` (`course`) ON UPDATE CASCADE,
  ADD CONSTRAINT `section_fk` FOREIGN KEY (`section`) REFERENCES `section` (`section`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
