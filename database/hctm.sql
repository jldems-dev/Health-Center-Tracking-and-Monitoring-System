-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 21, 2022 at 11:14 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hctm`
--

-- --------------------------------------------------------

--
-- Table structure for table `appntmnt_patients`
--

CREATE TABLE `appntmnt_patients` (
  `id` int(11) NOT NULL,
  `apptmntid` int(11) NOT NULL,
  `patientid` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `appntmnt_patients`
--

INSERT INTO `appntmnt_patients` (`id`, `apptmntid`, `patientid`, `status`) VALUES
(4, 1, 29, 1),
(5, 1, 30, 1),
(9, 1, 36, 1),
(10, 1, 31, 1),
(11, 1, 37, 1);

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `id` int(11) NOT NULL,
  `healthid` int(11) NOT NULL,
  `start` varchar(50) NOT NULL,
  `end` varchar(50) NOT NULL,
  `title` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`id`, `healthid`, `start`, `end`, `title`) VALUES
(1, 1, '2022-04-14 22:52:00', '2022-04-14 10:52:00', 'asd'),
(4, 4, '2022-04-09 07:00:00', '2022-04-09 09:00:00', 'asdddddddddddd'),
(5, 4, '2022-04-14 08:00:00', '2022-04-14 10:00:00', 'asdssssssssssssssssssssssssss');

-- --------------------------------------------------------

--
-- Table structure for table `health`
--

CREATE TABLE `health` (
  `id` int(11) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `mname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `phone_number` varchar(100) NOT NULL,
  `b_day` varchar(100) NOT NULL,
  `age` varchar(100) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `cvstatus` varchar(100) NOT NULL,
  `profile_image` varchar(100) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `health`
--

INSERT INTO `health` (`id`, `fname`, `mname`, `lname`, `address`, `phone_number`, `b_day`, `age`, `gender`, `cvstatus`, `profile_image`, `status`) VALUES
(1, 'McGee', 'Santos', 'Douglas', 'a', '2', '2022-03-29', '24', 'Male', 'Single', 'Profileimage/McGee_Douglas.png', 'Administrator'),
(4, 'x', 'x', 'x', 'x', '3', '2022-03-29', '23', 'Male', 'Single', 'Profileimage/user.png', 'BHW'),
(5, 'Gabriel', 'Ddal', 'Lee', 'asd', '09992312567', '2022-04-19', '34', 'Male', 'Single', 'Profileimage/user.png', 'BHW');

-- --------------------------------------------------------

--
-- Table structure for table `illness`
--

CREATE TABLE `illness` (
  `id` int(11) NOT NULL,
  `illness_name` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `illness`
--

INSERT INTO `illness` (`id`, `illness_name`, `description`) VALUES
(12, 'Cold and Flu', 'Colds and influenza (flu) are the most common illnesses among college students. ');

-- --------------------------------------------------------

--
-- Table structure for table `illness_patients`
--

CREATE TABLE `illness_patients` (
  `id` int(11) NOT NULL,
  `illness_id` int(11) NOT NULL,
  `patients_id` int(11) NOT NULL,
  `consulted_date` varchar(100) NOT NULL,
  `next_visit_date` varchar(100) NOT NULL,
  `conditions` varchar(100) NOT NULL,
  `medicine` varchar(50) NOT NULL,
  `quantity` varchar(50) NOT NULL,
  `concern` text NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `illness_patients`
--

INSERT INTO `illness_patients` (`id`, `illness_id`, `patients_id`, `consulted_date`, `next_visit_date`, `conditions`, `medicine`, `quantity`, `concern`, `status`) VALUES
(4, 12, 29, '', '', 'Treatment', '', '', '', 'Selected');

-- --------------------------------------------------------

--
-- Table structure for table `immunization`
--

CREATE TABLE `immunization` (
  `id` int(11) NOT NULL,
  `immunize_name` varchar(100) NOT NULL,
  `year` varchar(100) NOT NULL,
  `start_date` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `immunization`
--

INSERT INTO `immunization` (`id`, `immunize_name`, `year`, `start_date`) VALUES
(1, 'HIPA', '2001-2002', '2022-04-19');

-- --------------------------------------------------------

--
-- Table structure for table `immunize_patients`
--

CREATE TABLE `immunize_patients` (
  `id` int(11) NOT NULL,
  `immunize_id` int(11) NOT NULL,
  `patients_id` int(11) NOT NULL,
  `status` varchar(100) NOT NULL,
  `status_visit` varchar(50) NOT NULL,
  `date_visit` varchar(50) NOT NULL,
  `date_add` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `immunize_patients`
--

INSERT INTO `immunize_patients` (`id`, `immunize_id`, `patients_id`, `status`, `status_visit`, `date_visit`, `date_add`) VALUES
(2, 1, 29, 'Selected', '1st', '2022-04-19', '2022-04-19 11:48:02 PM');

-- --------------------------------------------------------

--
-- Table structure for table `immunize_patients_record`
--

CREATE TABLE `immunize_patients_record` (
  `id` int(11) NOT NULL,
  `immunize_patient_id` int(11) NOT NULL,
  `status_visit` varchar(50) NOT NULL,
  `date_visit` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `immunize_patients_record`
--

INSERT INTO `immunize_patients_record` (`id`, `immunize_patient_id`, `status_visit`, `date_visit`) VALUES
(2, 2, '1st', '2022-04-19');

-- --------------------------------------------------------

--
-- Table structure for table `medical_record`
--

CREATE TABLE `medical_record` (
  `id` int(11) NOT NULL,
  `patientid` int(11) NOT NULL,
  `rname` varchar(50) NOT NULL,
  `date` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `medical_record`
--

INSERT INTO `medical_record` (`id`, `patientid`, `rname`, `date`) VALUES
(7, 29, 'obb', '2022-04-07');

-- --------------------------------------------------------

--
-- Table structure for table `medical_record_patient`
--

CREATE TABLE `medical_record_patient` (
  `id` int(11) NOT NULL,
  `patientid` int(11) NOT NULL,
  `medrecordid` int(11) NOT NULL,
  `file_name` varchar(50) NOT NULL,
  `file_path` varchar(50) NOT NULL,
  `date` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `medical_record_patient`
--

INSERT INTO `medical_record_patient` (`id`, `patientid`, `medrecordid`, `file_name`, `file_path`, `date`) VALUES
(11, 29, 7, 'xray.docx', 'Patients_medical_record/xray.docx', '2022-04-09 12:23:45 PM'),
(12, 29, 7, 'Referal.docx', 'Patients_medical_record/Referal.docx', '2022-04-09 01:28:17 PM');

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `id` int(11) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `mname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `b_date` varchar(100) NOT NULL,
  `b_place` varchar(100) NOT NULL,
  `age` varchar(100) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `cvstatus` varchar(100) NOT NULL,
  `bps` varchar(50) NOT NULL,
  `bpd` varchar(50) NOT NULL,
  `pr` varchar(50) NOT NULL,
  `rr` varchar(50) NOT NULL,
  `temp` varchar(100) NOT NULL,
  `wt` varchar(100) NOT NULL,
  `ht` varchar(100) NOT NULL,
  `bt` varchar(100) NOT NULL,
  `date` varchar(100) NOT NULL,
  `phonenum` varchar(100) NOT NULL,
  `refferred_from` varchar(50) NOT NULL,
  `refferred_to` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`id`, `fname`, `mname`, `lname`, `address`, `b_date`, `b_place`, `age`, `gender`, `status`, `cvstatus`, `bps`, `bpd`, `pr`, `rr`, `temp`, `wt`, `ht`, `bt`, `date`, `phonenum`, `refferred_from`, `refferred_to`) VALUES
(29, 'aaaaaa', 'a', 'a', 'a', '2022-03-22', 'a', '23', 'Male', 'Child', 'Single', '', '0', '', '', '36.2', '56', '176', 'O', '2022-03-22 01:37:44 PM', '09675673221', '', ''),
(30, 'asda', 'sda', 'sd', 'asdasd', '2022-03-22', 'asda', '34', 'Male', 'Child', 'Single', '100', '0', '', '', '37.2', '70', '156', 'O', '2021-03-22 01:37:44 PM', '09675623112', '', ''),
(31, 'asdgg', 'gggggggggg', 'gggggggggggg', 'ggggggggggggg', '2022-04-07', 'asdgg', '1', 'Male', 'Infancy', 'Single', '', '', '123', '123', '37.2', '70', '156', 'B', '2022-03-22 01:37:44 PM', '09992123415', '', ''),
(36, 'Florence', 'Remote', 'Paceinte', 'tabigue', '2022-04-29', 'hkadog', '23', 'Male', 'Adult', 'Single', '119', '79', '23', '23', '36.5', '20kg', '175', 'A', '2022-04-01 10:34:48 AM', '92312312231', '', ''),
(37, 'a', 'a', 'a', 'asd', '2022-04-01', 'asd', '80', 'Male', 'Senior Citizen', 'Married', '129', '80', '1111', '11112', '36.5', '50', '175', 'O+', '2022-04-06 09:56:42 PM', '23122222222222', '', ''),
(38, 'john', 'seballs', 'demegillo', 'asdasd', '2022-04-07', 'asdasd', '23', 'Male', 'Adult', 'Single', '131', '81', '13', '67', '12', '12', '12', 'AB+', '2022-04-07 09:52:26 PM', '12312313123123', '', ''),
(39, 'asd', 'asd', 'asd', 'asd', '2022-04-11', 'asd', '23', 'Female', 'Senior Citizen', 'Single', '141', '91', 'asd', 'asd', '37.2', '23', '23', 'A', '2022-04-10 12:18:36 PM', '213123123', 'asd', 'asd'),
(41, 'asd', 'asda', 'asd', 'asd', '2022-04-15', 'asd', '23', 'Male', 'Adult', 'Single', '181', '121', '68', '23', '36.0', '123', '123', '0', '2022-04-15 09:03:58 PM', '123', 'asd', 'asd'),
(56, '1', '1', '1', '1', '2022-04-19', '1', '1', 'Male', 'Infancy', 'Single', '0', '0', '', '', '', '23', '23', '0', '2022-04-19 03:29:42 PM', '1', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `patient_bloodpressure`
--

CREATE TABLE `patient_bloodpressure` (
  `id` int(11) NOT NULL,
  `patients_id` int(11) NOT NULL,
  `bps` int(11) NOT NULL,
  `bpd` int(11) NOT NULL,
  `date` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `patient_bloodpressure`
--

INSERT INTO `patient_bloodpressure` (`id`, `patients_id`, `bps`, `bpd`, `date`) VALUES
(1, 37, 129, 81, '2022-04-15 10:21:46 PM'),
(2, 37, 129, 80, '2022-01-15 10:55:57 PM'),
(3, 36, 119, 79, '2022-01-17 12:58:32 PM');

-- --------------------------------------------------------

--
-- Table structure for table `prenatal`
--

CREATE TABLE `prenatal` (
  `id` int(11) NOT NULL,
  `prenatal_name` varchar(100) NOT NULL,
  `year` varchar(100) NOT NULL,
  `date` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `prenatal`
--

INSERT INTO `prenatal` (`id`, `prenatal_name`, `year`, `date`) VALUES
(1, 'Buntiss', '2021-2022', '2022-04-06'),
(4, 'Buntis2', '2019-2020', '2022-04-12');

-- --------------------------------------------------------

--
-- Table structure for table `prenatal_patients`
--

CREATE TABLE `prenatal_patients` (
  `id` int(11) NOT NULL,
  `prenatal_id` int(11) NOT NULL,
  `patients_id` int(11) NOT NULL,
  `status` varchar(100) NOT NULL,
  `status_visit` varchar(50) NOT NULL,
  `quarter` varchar(50) NOT NULL,
  `concern` varchar(500) NOT NULL,
  `date_visit` varchar(50) NOT NULL,
  `date_add` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `prenatal_patients`
--

INSERT INTO `prenatal_patients` (`id`, `prenatal_id`, `patients_id`, `status`, `status_visit`, `quarter`, `concern`, `date_visit`, `date_add`) VALUES
(1, 1, 29, 'Selected', '2nd', '2nd', '2', '2022-04-30', '2022-04-12 07:56:47 PM'),
(3, 4, 36, 'Selected', '1st', '1st', 'a', '2022-04-14', '2022-04-14 11:58:07 PM');

-- --------------------------------------------------------

--
-- Table structure for table `prenatal_patients_record`
--

CREATE TABLE `prenatal_patients_record` (
  `id` int(11) NOT NULL,
  `prenatal_patient_id` int(11) NOT NULL,
  `status_visit` varchar(50) NOT NULL,
  `quarter` varchar(50) NOT NULL,
  `concern` varchar(50) NOT NULL,
  `date_visit` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `prenatal_patients_record`
--

INSERT INTO `prenatal_patients_record` (`id`, `prenatal_patient_id`, `status_visit`, `quarter`, `concern`, `date_visit`) VALUES
(1, 1, '1st', '1st', '1', '2022-04-12'),
(2, 1, '2nd', '2nd', '2', '2022-04-30'),
(3, 2, '1st', '1st', 'a2', '2022-04-12'),
(4, 3, '1st', '1st', 'a', '2022-04-14');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `healthid` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `healthid`, `username`, `password`) VALUES
(1, 1, 'admin', '21232f297a57a5a743894a0e4a801fc3'),
(17, 4, 'x', '9dd4e461268c8034f5c8564e155c67a6'),
(18, 5, 'Lee', '7b34fdbd72fdecd596f0c583dd483a0f');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appntmnt_patients`
--
ALTER TABLE `appntmnt_patients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `health`
--
ALTER TABLE `health`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `illness`
--
ALTER TABLE `illness`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `illness_patients`
--
ALTER TABLE `illness_patients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `immunization`
--
ALTER TABLE `immunization`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `immunize_patients`
--
ALTER TABLE `immunize_patients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `immunize_patients_record`
--
ALTER TABLE `immunize_patients_record`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `medical_record`
--
ALTER TABLE `medical_record`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `medical_record_patient`
--
ALTER TABLE `medical_record_patient`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patient_bloodpressure`
--
ALTER TABLE `patient_bloodpressure`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prenatal`
--
ALTER TABLE `prenatal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prenatal_patients`
--
ALTER TABLE `prenatal_patients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prenatal_patients_record`
--
ALTER TABLE `prenatal_patients_record`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appntmnt_patients`
--
ALTER TABLE `appntmnt_patients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `health`
--
ALTER TABLE `health`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `illness`
--
ALTER TABLE `illness`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `illness_patients`
--
ALTER TABLE `illness_patients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `immunization`
--
ALTER TABLE `immunization`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `immunize_patients`
--
ALTER TABLE `immunize_patients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `immunize_patients_record`
--
ALTER TABLE `immunize_patients_record`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `medical_record`
--
ALTER TABLE `medical_record`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `medical_record_patient`
--
ALTER TABLE `medical_record_patient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `patient_bloodpressure`
--
ALTER TABLE `patient_bloodpressure`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `prenatal`
--
ALTER TABLE `prenatal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `prenatal_patients`
--
ALTER TABLE `prenatal_patients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `prenatal_patients_record`
--
ALTER TABLE `prenatal_patients_record`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
