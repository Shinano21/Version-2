-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 14, 2024 at 04:30 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `carevisio`
--

-- --------------------------------------------------------

--
-- Table structure for table `about`
--

CREATE TABLE `about` (
  `id` int(11) NOT NULL,
  `header_pic` varchar(255) DEFAULT NULL,
  `section_head` varchar(255) DEFAULT NULL,
  `section_subhead` varchar(255) DEFAULT NULL,
  `section_body` text DEFAULT NULL,
  `section_pic` varchar(255) DEFAULT NULL,
  `mission` text DEFAULT NULL,
  `mission_pic` varchar(255) DEFAULT NULL,
  `vision` text DEFAULT NULL,
  `vision_pic` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `about`
--

INSERT INTO `about` (`id`, `header_pic`, `section_head`, `section_subhead`, `section_body`, `section_pic`, `mission`, `mission_pic`, `vision`, `vision_pic`) VALUES
(1, NULL, 'Welcome', 'sasas', 'dwddwddwdw', '?PNG\r\n\Z\n\0\0\0\rIHDR\0\08\0\0$\0\0\0]???\0\0\0sRGB\0???\0\0\0gAMA\0\0??\r\n?a\0\0\0	pHYs\0\0?\0\0??o?d\0\0?{IDATx^??\r\n?$?]???[#iԂi?D\r\n??A?nTP???I?F|?f?\\????M{w?q???jd?e?;)fQΥ?|???T?+????.???iv?Җ?g??&ǔ?HS???D<?A?G?\Z???sN?Ȍ??wFfed???OtWF??ĉG???9\'.????IP?K??\"??ƑF\0?m??>', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `administrator`
--

CREATE TABLE `administrator` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `midname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) NOT NULL,
  `cpnumber` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` varchar(255) NOT NULL,
  `pfp` varchar(255) DEFAULT NULL,
  `a_status` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT 'offline'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `administrator`
--

INSERT INTO `administrator` (`id`, `firstname`, `midname`, `lastname`, `cpnumber`, `email`, `password`, `user_type`, `pfp`, `a_status`, `status`) VALUES
(1, 'Juan', NULL, 'Dela Cruz', '091234567890', 'admin@gmail.com', '$2y$10$meRTBQGo1MvYRoUrzZAjCuAJ.Knit8dduTFpHVfw0NptDChAx7Xm6', 'System Administrator', '', 'Active', 'Offline now'),
(11, 'Furina', 'Focalors', 'De Fontaine', '09467812431', 'furina500@gmail.com', '$2y$10$UFADbzixF59kUo7bgP3fbOwJe6uFaZ59SfCwV2ApvtElJfJ03JhKu', 'Barangay Health Worker', '', 'Active', 'Active now'),
(13, 'Agnes', 'Villaranda', 'Ogaban', '09467812431', 'agnesogaban08@gmail.com', '$2y$10$Lcj3urTMu8PkdGPtazMTAOPWPfqz9W2FJy0yawNNHrfkC5H6RCzVe', 'Barangay Health Worker', '', 'Active', 'offline'),
(14, 'Randiel James', 'Zaragoza', 'Asis', '09380828470', 'shakosako46@gmail.com', '$2y$10$jMaJUderc8ZrS9Dt0ITlFuK10S5qy.jrFALm0EWA3FWTfkIPFCJGq', 'Barangay Health Worker', NULL, 'Active', 'Active now');

-- --------------------------------------------------------

--
-- Table structure for table `animal_bite_records`
--

CREATE TABLE `animal_bite_records` (
  `id` int(11) NOT NULL,
  `resident_id` int(11) DEFAULT NULL,
  `bite_date` date DEFAULT NULL,
  `bitten_place` varchar(255) DEFAULT NULL,
  `treatment_date` date DEFAULT NULL,
  `bitten_location` varchar(255) DEFAULT NULL,
  `bite_location` varchar(255) DEFAULT NULL,
  `treatment_center` varchar(255) DEFAULT NULL,
  `remarks` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `animal_bite_records`
--

INSERT INTO `animal_bite_records` (`id`, `resident_id`, `bite_date`, `bitten_place`, `treatment_date`, `bitten_location`, `bite_location`, `treatment_center`, `remarks`) VALUES
(1, 2, '2024-09-21', NULL, '2024-09-21', 'Purok 2', 'index finger', 'Rabaxx', 'edgg'),
(3, 4, '2024-10-04', NULL, '2024-10-23', NULL, 'index finger', 'Rabaxx', '');

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

CREATE TABLE `announcements` (
  `id` int(11) NOT NULL,
  `announce_type` varchar(255) DEFAULT NULL,
  `announce_heading` varchar(255) DEFAULT NULL,
  `announce_body` text DEFAULT NULL,
  `announce_pic` varchar(255) DEFAULT NULL,
  `post_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `anti_pneumonia`
--

CREATE TABLE `anti_pneumonia` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `suffix` varchar(255) DEFAULT NULL,
  `zone` varchar(255) NOT NULL,
  `barangay` varchar(255) NOT NULL,
  `city_municipality` varchar(255) NOT NULL,
  `province` varchar(255) NOT NULL,
  `vaccination_date` date NOT NULL,
  `vaccination_site` varchar(50) NOT NULL,
  `date_of_birth` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `anti_pneumonia`
--

INSERT INTO `anti_pneumonia` (`id`, `first_name`, `middle_name`, `last_name`, `suffix`, `zone`, `barangay`, `city_municipality`, `province`, `vaccination_date`, `vaccination_site`, `date_of_birth`) VALUES
(1, 'Zhongli', 'Asis', 'Lee', '', 'Purok 1', 'Baybay', 'Legazpi', 'Albay', '2024-12-15', 'Right', '2024-12-16'),
(4, 'carlo', 'andrie', 'abagay', '', 'Purok 1', 'Bagumbayan', 'Daraga', 'Albay', '2024-01-05', 'left', '2023-12-20'),
(5, 'Zhongli', 'sasasa', 'Sato', '', 'Purok 1', 'Pigcale', 'Legazpi', 'Albay', '2024-12-11', 'Left', '2024-12-15');

-- --------------------------------------------------------

--
-- Table structure for table `brgy_health`
--

CREATE TABLE `brgy_health` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `position` varchar(255) DEFAULT NULL,
  `pic` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` int(11) NOT NULL,
  `short_mess` text DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `contact` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `fb_name` varchar(255) DEFAULT NULL,
  `fb_link` varchar(255) DEFAULT NULL,
  `longitude` decimal(10,6) DEFAULT NULL,
  `latitude` decimal(10,6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`id`, `short_mess`, `email`, `contact`, `address`, `fb_name`, `fb_link`, `longitude`, `latitude`) VALUES
(1, 'Hello', 'shakosako46@gmail.com', '09467812439', 'ajajajaj', 'aasas', 'asasas', 123.752418, 13.146018);

-- --------------------------------------------------------

--
-- Table structure for table `family_planning`
--

CREATE TABLE `family_planning` (
  `id` int(11) NOT NULL,
  `date_of_registration` date NOT NULL,
  `date_of_birth` date NOT NULL,
  `family_serial_number` varchar(255) DEFAULT NULL,
  `se_status` varchar(255) NOT NULL,
  `type_of_client` varchar(255) NOT NULL,
  `source` varchar(255) NOT NULL,
  `previous_method` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `suffix` varchar(255) DEFAULT NULL,
  `zone` varchar(255) NOT NULL,
  `barangay` varchar(255) NOT NULL,
  `city_municipality` varchar(255) NOT NULL,
  `province` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `family_planning`
--

INSERT INTO `family_planning` (`id`, `date_of_registration`, `date_of_birth`, `family_serial_number`, `se_status`, `type_of_client`, `source`, `previous_method`, `first_name`, `middle_name`, `last_name`, `suffix`, `zone`, `barangay`, `city_municipality`, `province`) VALUES
(1, '2021-06-11', '2014-02-11', '', 'NHTS', 'CU-CM', 'Public', 'NFP-STM', 'Maria', '', 'Gomez', '', 'Purok 1', 'Baybay', 'Legazpi', 'Albay'),
(6, '2024-12-20', '2024-12-12', '1234', 'NHTS', 'CU', 'Public', 'NFP-SDM', 'Randiel ', 'Zamora', 'Ased', '', 'Purok 2', 'Baybay', 'Legazpi', 'Albay');

-- --------------------------------------------------------

--
-- Table structure for table `family_planning_sched`
--

CREATE TABLE `family_planning_sched` (
  `id` int(11) NOT NULL,
  `schedule_date_january` date DEFAULT NULL,
  `actual_date_january` date DEFAULT NULL,
  `schedule_date_february` date DEFAULT NULL,
  `actual_date_february` date DEFAULT NULL,
  `schedule_date_march` date DEFAULT NULL,
  `actual_date_march` date DEFAULT NULL,
  `schedule_date_april` date DEFAULT NULL,
  `actual_date_april` date DEFAULT NULL,
  `schedule_date_may` date DEFAULT NULL,
  `actual_date_may` date DEFAULT NULL,
  `schedule_date_june` date DEFAULT NULL,
  `actual_date_june` date DEFAULT NULL,
  `schedule_date_july` date DEFAULT NULL,
  `actual_date_july` date DEFAULT NULL,
  `schedule_date_august` date DEFAULT NULL,
  `actual_date_august` date DEFAULT NULL,
  `schedule_date_september` date DEFAULT NULL,
  `actual_date_september` date DEFAULT NULL,
  `schedule_date_october` date DEFAULT NULL,
  `actual_date_october` date DEFAULT NULL,
  `schedule_date_november` date DEFAULT NULL,
  `actual_date_november` date DEFAULT NULL,
  `schedule_date_december` date DEFAULT NULL,
  `actual_date_december` date DEFAULT NULL,
  `family_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `family_planning_sched`
--

INSERT INTO `family_planning_sched` (`id`, `schedule_date_january`, `actual_date_january`, `schedule_date_february`, `actual_date_february`, `schedule_date_march`, `actual_date_march`, `schedule_date_april`, `actual_date_april`, `schedule_date_may`, `actual_date_may`, `schedule_date_june`, `actual_date_june`, `schedule_date_july`, `actual_date_july`, `schedule_date_august`, `actual_date_august`, `schedule_date_september`, `actual_date_september`, `schedule_date_october`, `actual_date_october`, `schedule_date_november`, `actual_date_november`, `schedule_date_december`, `actual_date_december`, `family_id`) VALUES
(0, '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 1),
(0, '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 3),
(0, '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 5),
(0, '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 6);

-- --------------------------------------------------------

--
-- Table structure for table `family_plan_rem`
--

CREATE TABLE `family_plan_rem` (
  `id` int(11) NOT NULL,
  `reasons` varchar(255) DEFAULT NULL,
  `reasons_date` date DEFAULT NULL,
  `deworming_drugs_1st_dose_date` date DEFAULT NULL,
  `deworming_drugs_2nd_dose_date` date DEFAULT NULL,
  `deworming_drugs_yndwrm` varchar(3) DEFAULT NULL,
  `lam_remarks` text DEFAULT NULL,
  `family_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `family_plan_rem`
--

INSERT INTO `family_plan_rem` (`id`, `reasons`, `reasons_date`, `deworming_drugs_1st_dose_date`, `deworming_drugs_2nd_dose_date`, `deworming_drugs_yndwrm`, `lam_remarks`, `family_id`) VALUES
(0, '', '0000-00-00', '0000-00-00', '0000-00-00', '', '', 1),
(0, 'C', '0000-00-00', '2022-03-11', '2024-11-16', 'No', 'Comeback after 1month', 3),
(0, 'B', '0000-00-00', '2024-12-29', '2025-01-07', 'No', '', 5),
(0, NULL, '0000-00-00', '0000-00-00', '0000-00-00', NULL, 'q3essssdssdfg', 6);

-- --------------------------------------------------------

--
-- Table structure for table `home`
--

CREATE TABLE `home` (
  `id` int(11) NOT NULL,
  `center_name` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `contact` varchar(255) DEFAULT NULL,
  `open_hours` varchar(255) DEFAULT NULL,
  `bg_img` varchar(255) DEFAULT NULL,
  `short_desc` text DEFAULT NULL,
  `mission` text DEFAULT NULL,
  `vision` text DEFAULT NULL,
  `goal` text DEFAULT NULL,
  `chairman` varchar(255) DEFAULT NULL,
  `chairman_pic` varchar(255) DEFAULT NULL,
  `chairman_comm` text DEFAULT NULL,
  `chairman_comm_pic` varchar(255) DEFAULT NULL,
  `section_pic` varchar(255) DEFAULT NULL,
  `contact_mess` text DEFAULT NULL,
  `office_hrs` varchar(255) DEFAULT NULL,
  `programs_pic` varchar(255) DEFAULT NULL,
  `announce_pic` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `home`
--

INSERT INTO `home` (`id`, `center_name`, `address`, `email`, `contact`, `open_hours`, `bg_img`, `short_desc`, `mission`, `vision`, `goal`, `chairman`, `chairman_pic`, `chairman_comm`, `chairman_comm_pic`, `section_pic`, `contact_mess`, `office_hrs`, `programs_pic`, `announce_pic`) VALUES
(1, 'Rawis', 'N/A', 'alaka@gmail.com', '09467812431', '8;00am - 5;00pm', 'uploads/brgyHallEstanza.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `hypertension`
--

CREATE TABLE `hypertension` (
  `hypertension_id` int(11) NOT NULL,
  `resident_id` int(11) NOT NULL,
  `checkup_date` date NOT NULL,
  `medicine_type` varchar(255) DEFAULT NULL,
  `blood_pressure` varchar(50) DEFAULT NULL,
  `remarks_type` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hypertension`
--

INSERT INTO `hypertension` (`hypertension_id`, `resident_id`, `checkup_date`, `medicine_type`, `blood_pressure`, `remarks_type`) VALUES
(3, 1, '2024-12-04', 'Cinnarizine', '23', 'qwqsqsqsq');

-- --------------------------------------------------------

--
-- Table structure for table `immunization`
--

CREATE TABLE `immunization` (
  `id` int(11) NOT NULL,
  `reg` varchar(255) NOT NULL,
  `bday` varchar(255) NOT NULL,
  `serial` varchar(255) NOT NULL,
  `se_status` varchar(255) NOT NULL,
  `sex` varchar(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `mname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `suffix` varchar(255) NOT NULL,
  `zone` varchar(255) NOT NULL,
  `brgy` varchar(255) NOT NULL,
  `mun` varchar(255) NOT NULL,
  `prov` varchar(255) NOT NULL,
  `cpab` varchar(255) NOT NULL,
  `mother_fname` varchar(50) NOT NULL,
  `mother_mname` varchar(59) NOT NULL,
  `mother_lname` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `immunization`
--

INSERT INTO `immunization` (`id`, `reg`, `bday`, `serial`, `se_status`, `sex`, `fname`, `mname`, `lname`, `suffix`, `zone`, `brgy`, `mun`, `prov`, `cpab`, `mother_fname`, `mother_mname`, `mother_lname`) VALUES
(1, '2024-12-01', '2024-11-30', '1234567890', 'NHTS', 'Male', 'Zhongli', 'Asis', 'morax', '', 'Purok 3', 'Bagumbayan', 'Daraga', 'Albay', 'TT2/Td2', 'Geneva', 'Asis', 'Morax');

-- --------------------------------------------------------

--
-- Table structure for table `immunization_1`
--

CREATE TABLE `immunization_1` (
  `id` int(11) NOT NULL,
  `length` varchar(255) NOT NULL,
  `weight` varchar(255) NOT NULL,
  `bf` varchar(255) NOT NULL,
  `bcg` varchar(255) NOT NULL,
  `hepa` varchar(255) NOT NULL,
  `immu_id` int(11) NOT NULL,
  `bw` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `immunization_1`
--

INSERT INTO `immunization_1` (`id`, `length`, `weight`, `bf`, `bcg`, `hepa`, `immu_id`, `bw`) VALUES
(1, '69', '5', '2024-12-12', '2024-12-12', '2024-12-12', 1, 'N');

-- --------------------------------------------------------

--
-- Table structure for table `immunization_2`
--

CREATE TABLE `immunization_2` (
  `id` int(11) NOT NULL,
  `length_at_birth` decimal(5,2) NOT NULL,
  `weight_at_birth` decimal(5,2) NOT NULL,
  `birth_weight_status` char(1) NOT NULL,
  `breastfeeding_initiation_date` date DEFAULT NULL,
  `bcg_date` date DEFAULT NULL,
  `hepa_b_bd_date` date DEFAULT NULL,
  `age_in_months_1` int(11) DEFAULT NULL,
  `length_cm_1` decimal(5,2) DEFAULT NULL,
  `date_taken_1` date DEFAULT NULL,
  `weight_kg_1` decimal(5,2) DEFAULT NULL,
  `date_taken_2` date DEFAULT NULL,
  `sst_1` char(1) DEFAULT NULL,
  `lbw_given_iron_1` date DEFAULT NULL,
  `lbw_given_iron_2` date DEFAULT NULL,
  `lbw_given_iron_3` date DEFAULT NULL,
  `dpt_hib_hepb_1st_dose_2` date DEFAULT NULL,
  `dpt_hib_hepb_2nd_dose_2` date DEFAULT NULL,
  `dpt_hib_hepb_3rd_dose_2` date DEFAULT NULL,
  `opb_1st_dose_2` date DEFAULT NULL,
  `opb_2nd_dose_2` date DEFAULT NULL,
  `opb_3rd_dose_2` date DEFAULT NULL,
  `pcb_1st_dose_2` date DEFAULT NULL,
  `pcb_2nd_dose_2` date DEFAULT NULL,
  `pcb_3rd_dose_2` date DEFAULT NULL,
  `ipv_3rd_dose_2` date DEFAULT NULL,
  `ebf_1_5_months_2` char(3) DEFAULT NULL,
  `date_assessed_1_5_months_2` date DEFAULT NULL,
  `ebf_2_5_months_2` char(3) DEFAULT NULL,
  `date_assessed_2_5_months_2` date DEFAULT NULL,
  `ebf_3_5_months_2` char(3) DEFAULT NULL,
  `date_assessed_3_5_months_2` date DEFAULT NULL,
  `ebf_4_5_months_2` char(3) DEFAULT NULL,
  `date_assessed_4_5_months_2` date DEFAULT NULL,
  `immu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `immunization_2`
--

INSERT INTO `immunization_2` (`id`, `length_at_birth`, `weight_at_birth`, `birth_weight_status`, `breastfeeding_initiation_date`, `bcg_date`, `hepa_b_bd_date`, `age_in_months_1`, `length_cm_1`, `date_taken_1`, `weight_kg_1`, `date_taken_2`, `sst_1`, `lbw_given_iron_1`, `lbw_given_iron_2`, `lbw_given_iron_3`, `dpt_hib_hepb_1st_dose_2`, `dpt_hib_hepb_2nd_dose_2`, `dpt_hib_hepb_3rd_dose_2`, `opb_1st_dose_2`, `opb_2nd_dose_2`, `opb_3rd_dose_2`, `pcb_1st_dose_2`, `pcb_2nd_dose_2`, `pcb_3rd_dose_2`, `ipv_3rd_dose_2`, `ebf_1_5_months_2`, `date_assessed_1_5_months_2`, `ebf_2_5_months_2`, `date_assessed_2_5_months_2`, `ebf_3_5_months_2`, `date_assessed_3_5_months_2`, `ebf_4_5_months_2`, `date_assessed_4_5_months_2`, `immu_id`) VALUES
(1, 69.00, 5.00, 'N', '2024-12-12', '2024-12-12', '2024-12-12', 2, 54.00, '2024-12-31', 5.00, '2024-12-31', 'N', '2024-12-14', '2024-12-31', '0000-00-00', '2024-12-13', '0000-00-00', '0000-00-00', '2024-12-12', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `immunization_3`
--

CREATE TABLE `immunization_3` (
  `id` int(11) NOT NULL,
  `ebf_6_months` char(3) DEFAULT NULL,
  `date_assessed_ebf_6_months` date DEFAULT NULL,
  `complementary_feeding_6_months` char(3) DEFAULT NULL,
  `bfed_6_months` int(11) DEFAULT NULL,
  `vitamin_a_date` date DEFAULT NULL,
  `mnp_date` date DEFAULT NULL,
  `mmr_dose1_date` date DEFAULT NULL,
  `immu_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `immunization_3`
--

INSERT INTO `immunization_3` (`id`, `ebf_6_months`, `date_assessed_ebf_6_months`, `complementary_feeding_6_months`, `bfed_6_months`, `vitamin_a_date`, `mnp_date`, `mmr_dose1_date`, `immu_id`) VALUES
(1, '', '0000-00-00', '', 0, '0000-00-00', '0000-00-00', '0000-00-00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `immunization_4`
--

CREATE TABLE `immunization_4` (
  `id` int(11) NOT NULL,
  `age_in_months` int(11) DEFAULT NULL,
  `length_cm` int(11) DEFAULT NULL,
  `date_taken_length` date DEFAULT NULL,
  `weight_kg` int(11) DEFAULT NULL,
  `date_taken_weight` date DEFAULT NULL,
  `status` enum('N','S','W-MAM','W-SAM','O') DEFAULT NULL,
  `mmr_dose2_date` date DEFAULT NULL,
  `fic_date` date DEFAULT NULL,
  `immu_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `immunization_4`
--

INSERT INTO `immunization_4` (`id`, `age_in_months`, `length_cm`, `date_taken_length`, `weight_kg`, `date_taken_weight`, `status`, `mmr_dose2_date`, `fic_date`, `immu_id`) VALUES
(1, 0, 0, '0000-00-00', 0, '0000-00-00', '', '0000-00-00', '0000-00-00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `immunization_5`
--

CREATE TABLE `immunization_5` (
  `id` int(11) NOT NULL,
  `cic_date` date DEFAULT NULL,
  `mam_status` varchar(50) DEFAULT NULL,
  `sam_status` varchar(50) DEFAULT NULL,
  `immu_id` int(11) DEFAULT NULL,
  `remarks` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `immunization_5`
--

INSERT INTO `immunization_5` (`id`, `cic_date`, `mam_status`, `sam_status`, `immu_id`, `remarks`) VALUES
(1, '0000-00-00', '', '', 1, 'asdfghjk');

-- --------------------------------------------------------

--
-- Table structure for table `influenza_vaccination`
--

CREATE TABLE `influenza_vaccination` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `suffix` varchar(255) DEFAULT NULL,
  `zone` varchar(255) NOT NULL,
  `barangay` varchar(255) NOT NULL,
  `city_municipality` varchar(255) NOT NULL,
  `province` varchar(255) NOT NULL,
  `vaccination_date` date NOT NULL,
  `vaccination_site` varchar(50) NOT NULL,
  `date_of_birth` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `influenza_vaccination`
--

INSERT INTO `influenza_vaccination` (`id`, `first_name`, `middle_name`, `last_name`, `suffix`, `zone`, `barangay`, `city_municipality`, `province`, `vaccination_date`, `vaccination_site`, `date_of_birth`) VALUES
(2, 'Zhongli', 'sasasa', 'Sato', 'adsdwds', 'Purok 1', 'HAhaha', 'Daraga', 'Albay', '2024-12-02', 'Left', '2024-12-02'),
(4, 'Mavuika', 'Pyro', 'Natlan', '', 'Purok 1', 'aserere', 'ererere', 'Albay', '2024-12-12', 'Left', '2000-01-11'),
(5, 'Zhongli', 'asdfrg', 'asdfg', 'sff', 'Purok 2', 'Bagumbayansfsf', 'Daragasfsf', 'Albayfsf', '2024-12-03', 'Left', '2024-11-29');

-- --------------------------------------------------------

--
-- Table structure for table `logo`
--

CREATE TABLE `logo` (
  `id` int(11) NOT NULL,
  `navbar_logo` varchar(255) DEFAULT NULL,
  `logo_pic` varchar(255) DEFAULT NULL,
  `center_name` varchar(255) DEFAULT NULL,
  `short_desc` text DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `contact` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `logo`
--

INSERT INTO `logo` (`id`, `navbar_logo`, `logo_pic`, `center_name`, `short_desc`, `email`, `contact`, `address`) VALUES
(2, '1695383273813.png', '1695383273813.png', 'Rawis', ' gugugu', 'alaka@gmail.com', '09467812431', 'N/A');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `msg_id` int(11) NOT NULL,
  `incoming_msg_id` int(255) NOT NULL,
  `outgoing_msg_id` int(255) NOT NULL,
  `msg` varchar(1000) NOT NULL,
  `status` varchar(10) DEFAULT 'unread'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`msg_id`, `incoming_msg_id`, `outgoing_msg_id`, `msg`, `status`) VALUES
(1, 0, 14, 'HELLO', 'unread'),
(2, 0, 11, 'ffff', 'unread'),
(3, 0, 11, 'hi', 'unread');

-- --------------------------------------------------------

--
-- Table structure for table `nutrition`
--

CREATE TABLE `nutrition` (
  `id` int(11) NOT NULL,
  `reg` varchar(255) NOT NULL,
  `bday` varchar(255) NOT NULL,
  `serial` varchar(255) NOT NULL,
  `se_status` varchar(255) NOT NULL,
  `sex` varchar(255) NOT NULL,
  `length` varchar(255) NOT NULL,
  `weight` varchar(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `mname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `suffix` varchar(255) NOT NULL,
  `zone` varchar(255) NOT NULL,
  `brgy` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `province` varchar(255) NOT NULL,
  `mother_fname` varchar(255) NOT NULL,
  `mother_mname` varchar(255) NOT NULL,
  `mother_lname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nutrition`
--

INSERT INTO `nutrition` (`id`, `reg`, `bday`, `serial`, `se_status`, `sex`, `length`, `weight`, `fname`, `mname`, `lname`, `suffix`, `zone`, `brgy`, `city`, `province`, `mother_fname`, `mother_mname`, `mother_lname`) VALUES
(1, '2024-12-11', '2023-06-11', '', 'NHTS', 'Male', '50', '3', 'Randiel', '', 'Asis', '', 'Purok 1', 'Bagumbayan', 'Daraga', 'Albay', 'Rica', '', 'Asis'),
(4, '2020-06-13', '1999-06-13', '', 'NHTS', 'Male', '50', '3', 'Ethan', 'N/A', 'Lee', '', 'Purok 2', 'Pigcale', 'Legazpi', 'Albay', 'Ella', '', 'Lee');

-- --------------------------------------------------------

--
-- Table structure for table `nutrition_1`
--

CREATE TABLE `nutrition_1` (
  `id` int(11) NOT NULL,
  `nutritional_status` varchar(10) DEFAULT NULL,
  `mnp_date` date DEFAULT NULL,
  `vitamin_a_1st_dose_date` date DEFAULT NULL,
  `vitamin_a_2nd_dose_date` date DEFAULT NULL,
  `deworming_1st_dose_date` date DEFAULT NULL,
  `deworming_2nd_dose_date` date DEFAULT NULL,
  `deworming_yn` varchar(3) DEFAULT NULL,
  `nutrition_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nutrition_1`
--

INSERT INTO `nutrition_1` (`id`, `nutritional_status`, `mnp_date`, `vitamin_a_1st_dose_date`, `vitamin_a_2nd_dose_date`, `deworming_1st_dose_date`, `deworming_2nd_dose_date`, `deworming_yn`, `nutrition_id`) VALUES
(1, 'N', '2024-12-11', '2024-12-13', '2024-12-22', '2024-12-11', '2024-12-13', 'Yes', 0),
(4, 'N', '2021-07-13', '2023-06-13', '2023-06-13', '2024-12-08', '2024-12-13', 'Yes', 4);

-- --------------------------------------------------------

--
-- Table structure for table `nutrition_2`
--

CREATE TABLE `nutrition_2` (
  `id` int(11) NOT NULL,
  `nutrition_id` int(11) DEFAULT NULL,
  `vitamin_a_1st_dose_date` date DEFAULT NULL,
  `vitamin_a_2nd_dose_date` date DEFAULT NULL,
  `deworming_1st_dose_date` date DEFAULT NULL,
  `deworming_2nd_dose_date` date DEFAULT NULL,
  `deworming_yn` varchar(3) DEFAULT NULL,
  `nutritional_status2` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nutrition_2`
--

INSERT INTO `nutrition_2` (`id`, `nutrition_id`, `vitamin_a_1st_dose_date`, `vitamin_a_2nd_dose_date`, `deworming_1st_dose_date`, `deworming_2nd_dose_date`, `deworming_yn`, `nutritional_status2`) VALUES
(1, 0, '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', ''),
(4, 4, '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `nutrition_3`
--

CREATE TABLE `nutrition_3` (
  `id` int(11) NOT NULL,
  `nutrition_id` int(11) DEFAULT NULL,
  `vitamin_a_1st_dose_date` date DEFAULT NULL,
  `vitamin_a_2nd_dose_date` date DEFAULT NULL,
  `deworming_1st_dose_date` date DEFAULT NULL,
  `deworming_2nd_dose_date` date DEFAULT NULL,
  `deworming_yn` varchar(3) DEFAULT NULL,
  `nutritional_status3` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nutrition_3`
--

INSERT INTO `nutrition_3` (`id`, `nutrition_id`, `vitamin_a_1st_dose_date`, `vitamin_a_2nd_dose_date`, `deworming_1st_dose_date`, `deworming_2nd_dose_date`, `deworming_yn`, `nutritional_status3`) VALUES
(1, 0, '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', ''),
(4, 4, '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `nutrition_4`
--

CREATE TABLE `nutrition_4` (
  `id` int(11) NOT NULL,
  `nutrition_id` int(11) DEFAULT NULL,
  `vitamin_a_1st_dose_date` date DEFAULT NULL,
  `vitamin_a_2nd_dose_date` date DEFAULT NULL,
  `deworming_1st_dose_date` date DEFAULT NULL,
  `deworming_2nd_dose_date` date DEFAULT NULL,
  `deworming_yn` varchar(3) DEFAULT NULL,
  `nutritional_status4` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nutrition_4`
--

INSERT INTO `nutrition_4` (`id`, `nutrition_id`, `vitamin_a_1st_dose_date`, `vitamin_a_2nd_dose_date`, `deworming_1st_dose_date`, `deworming_2nd_dose_date`, `deworming_yn`, `nutritional_status4`) VALUES
(1, 0, '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', ''),
(4, 4, '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `nutrition_5`
--

CREATE TABLE `nutrition_5` (
  `id` int(11) NOT NULL,
  `mam_status` varchar(255) DEFAULT NULL,
  `sam_status` varchar(255) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `nutrition_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nutrition_5`
--

INSERT INTO `nutrition_5` (`id`, `mam_status`, `sam_status`, `remarks`, `nutrition_id`) VALUES
(1, '', '', '', 0),
(4, '', '', '', 4);

-- --------------------------------------------------------

--
-- Table structure for table `organization`
--

CREATE TABLE `organization` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `contact_info` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `organization`
--

INSERT INTO `organization` (`id`, `name`, `position`, `photo`, `contact_info`, `description`, `parent_id`, `created_at`, `updated_at`) VALUES
(1, 'Ayato', 'Chairman', 'images/bnc/bnc_674769a3b1fb35.30124610.png', '12345678', '', NULL, '2024-11-25 03:10:34', '2024-11-27 18:49:07'),
(2, 'Kazuha', 'Chairman, Committee on Health', 'images/bnc/118586589_p0.jpg', '12345678', '', 1, '2024-11-25 03:47:04', '2024-11-25 03:47:04'),
(3, 'Ayata', 'Councilor, Environment and Sanitation', 'images/bnc/121873677_p0.png', 'nsnsns', 'bdjbjsd', 2, '2024-11-25 05:37:04', '2024-11-25 05:37:04');

-- --------------------------------------------------------

--
-- Table structure for table `otp`
--

CREATE TABLE `otp` (
  `id` int(11) NOT NULL,
  `otp_number` int(6) NOT NULL,
  `email` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `otp`
--

INSERT INTO `otp` (`id`, `otp_number`, `email`, `created_at`) VALUES
(1, 939162, 'randielasis15@gmail.com', '2024-12-10 08:56:29');

-- --------------------------------------------------------

--
-- Table structure for table `otpa`
--

CREATE TABLE `otpa` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `otp_number` varchar(6) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `otpa`
--

INSERT INTO `otpa` (`id`, `email`, `otp_number`, `created_at`) VALUES
(1, 'shakosako46@gmail.com', '161534', '2024-12-08 20:50:20');

-- --------------------------------------------------------

--
-- Table structure for table `prenatal`
--

CREATE TABLE `prenatal` (
  `prenatal_id` int(11) NOT NULL,
  `resident_id` int(11) NOT NULL,
  `checkup_date` date NOT NULL,
  `gestational_age` int(11) DEFAULT NULL,
  `blood_pressure` varchar(50) DEFAULT NULL,
  `weight` decimal(10,2) DEFAULT NULL,
  `fetal_heartbeat` varchar(50) DEFAULT NULL,
  `calcium_supplementation` tinyint(1) DEFAULT 0,
  `iodine_capsules` tinyint(1) DEFAULT 0,
  `deworming_tablets` tinyint(1) DEFAULT 0,
  `syphilis_screened` tinyint(1) DEFAULT 0,
  `syphilis_positive` tinyint(1) DEFAULT 0,
  `hepB_screened` tinyint(1) DEFAULT 0,
  `hepB_positive` tinyint(1) DEFAULT 0,
  `hiv_screened` tinyint(1) DEFAULT 0,
  `cbc_tested` tinyint(1) DEFAULT 0,
  `cbc_anemia` tinyint(1) DEFAULT 0,
  `gestational_diabetes_screened` tinyint(1) DEFAULT 0,
  `gestational_diabetes_positive` tinyint(1) DEFAULT 0,
  `remarks` text DEFAULT NULL,
  `td_vaccination` tinyint(1) DEFAULT 0,
  `td2plus_vaccination` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `prenatal`
--

INSERT INTO `prenatal` (`prenatal_id`, `resident_id`, `checkup_date`, `gestational_age`, `blood_pressure`, `weight`, `fetal_heartbeat`, `calcium_supplementation`, `iodine_capsules`, `deworming_tablets`, `syphilis_screened`, `syphilis_positive`, `hepB_screened`, `hepB_positive`, `hiv_screened`, `cbc_tested`, `cbc_anemia`, `gestational_diabetes_screened`, `gestational_diabetes_positive`, `remarks`, `td_vaccination`, `td2plus_vaccination`) VALUES
(2, 4, '2024-10-30', 1, '23', 76.00, '59', 0, 1, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, '', 0, 0),
(3, 1, '2024-11-02', 3, '34', 55.00, '57', 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `programs`
--

CREATE TABLE `programs` (
  `id` int(11) NOT NULL,
  `program_type` varchar(100) DEFAULT NULL,
  `prog_heading` varchar(255) DEFAULT NULL,
  `prog_body` text DEFAULT NULL,
  `prog_pic` varchar(255) DEFAULT NULL,
  `post_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `purok_boundaries`
--

CREATE TABLE `purok_boundaries` (
  `id` int(11) NOT NULL,
  `barangay_name` varchar(255) NOT NULL,
  `purok_name` varchar(255) NOT NULL,
  `boundary_coordinates` text NOT NULL,
  `color` varchar(7) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `purok_boundaries`
--

INSERT INTO `purok_boundaries` (`id`, `barangay_name`, `purok_name`, `boundary_coordinates`, `color`, `created_at`, `updated_at`) VALUES
(7, 'Barangay 1', 'purok 1', '{\"type\":\"Polygon\",\"coordinates\":[[[123.751883,13.139023],[123.751275,13.138747],[123.751368,13.138548],[123.751404,13.138413],[123.75312,13.138773],[123.754721,13.139211],[123.7536,13.13952],[123.753272,13.139671],[123.75294,13.139708],[123.752396,13.139374],[123.751883,13.139023]]]}', '#33ff8b', '2024-11-21 07:31:30', '2024-11-21 14:23:55'),
(8, 'Barangay 1', 'purok 3', '{\"type\":\"Polygon\",\"coordinates\":[[[123.757808,13.141495],[123.756585,13.140972],[123.757572,13.140555],[123.758581,13.140429],[123.759246,13.140722],[123.758881,13.141704],[123.757808,13.141495]]]}', '#be33ff', '2024-11-21 08:03:39', '2024-11-21 08:03:39');

-- --------------------------------------------------------

--
-- Table structure for table `residents`
--

CREATE TABLE `residents` (
  `id` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `mname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `suffix` varchar(255) NOT NULL,
  `sex` varchar(255) NOT NULL,
  `bday` varchar(255) NOT NULL,
  `pob` varchar(255) NOT NULL,
  `religion` varchar(255) NOT NULL,
  `citizenship` varchar(255) NOT NULL,
  `street` varchar(255) NOT NULL,
  `zone` varchar(255) NOT NULL,
  `brgy` varchar(255) NOT NULL,
  `mun` varchar(255) NOT NULL,
  `province` varchar(255) NOT NULL,
  `zipcode` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `educational` varchar(255) NOT NULL,
  `occupation` varchar(255) NOT NULL,
  `civil_status` varchar(255) NOT NULL,
  `labor_status` varchar(255) NOT NULL,
  `voter_status` varchar(255) NOT NULL,
  `pwd_status` varchar(255) NOT NULL,
  `four_p` varchar(255) NOT NULL,
  `vac_status` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `longitude` varchar(255) NOT NULL,
  `latitude` varchar(255) NOT NULL,
  `id_card_no` varchar(50) DEFAULT NULL,
  `profile` varchar(255) DEFAULT NULL,
  `qr_code` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `residents`
--

INSERT INTO `residents` (`id`, `fname`, `mname`, `lname`, `suffix`, `sex`, `bday`, `pob`, `religion`, `citizenship`, `street`, `zone`, `brgy`, `mun`, `province`, `zipcode`, `contact`, `educational`, `occupation`, `civil_status`, `labor_status`, `voter_status`, `pwd_status`, `four_p`, `vac_status`, `status`, `longitude`, `latitude`, `id_card_no`, `profile`, `qr_code`) VALUES
(1, 'Furina', 'Focalors', 'De Fontaine', '', 'Male', '2023-06-06', 'Daraga', 'Roman Catholic', 'Filipino', 'N/A', 'Purok 1', 'Bagumbayan', 'Daraga', 'Albay', '4501', '09467812431', 'Preschool', 'Tambay', 'Single', 'Not in the Labor Force', 'Yes', 'Yes', 'Yes', 'Fully Vaccinated', 'Active', '123.71827', '13.142307', NULL, '', NULL),
(2, 'Navia', 'spina', 'De Rosula', '', 'Female', '2019-06-28', 'Daraga', 'Roman Catholic', 'Filipino', '', 'Purok 3', 'Bagumbayan', 'Daraga', 'Albay', '4501', '', 'Preschool', 'Tambay sa bahay', 'Single', 'Employed', 'Yes', 'Yes', 'Yes', 'Fully Vaccinated', 'Active', '123.71580578679966', '13.141973617231812', NULL, '', NULL),
(3, 'danica', 'Focalors', 'De Fontaine', '', 'Female', '2024-09-24', 'Daraga', 'Roman Catholic', 'Filipino', 'N/A', 'Purok 4', 'Bagumbayan', 'Daraga', 'Albay', '4501', '09467812431', 'Preschool', 'Tambay', 'Single', 'Employed', 'Yes', 'Yes', 'Yes', 'Fully Vaccinated', 'Active', '123.71643033164248', '13.140564314980484', NULL, '', 'qrcodes/3.png'),
(4, 'Charlotte', 'Focalors', 'De Bird', '', 'Female', '2002-04-29', 'Fontaine', 'Hydro', 'Filipino', 'Sheesh', 'Purok 1', 'Bagumbayan', 'Legazpi', 'Albay', '4500', '09467812431', 'Preschool', 'Tambay sa bahay', 'Single', 'Employed', 'Yes', 'Yes', 'Yes', 'Fully Vaccinated', 'Active', '123.75236238820679', '13.13891354034876', NULL, '', 'qrcodes/4.png'),
(11, 'Mavuika', 'Pyro', 'Natlan', '', 'Female', '2000-01-11', 'Natlan', 'Pyro', 'Natlan', 'sdfghjk', 'Purok 1', 'Christian', 'Legazpi', 'Albay', '4500', '0978787878923', 'Preschool', 'Archon', 'Single', 'Employed', 'Yes', 'Yes', 'Yes', 'Fully Vaccinated', 'Active', '123.73407425235287', '13.136723639200417', '94365895', '', '94365895_qrcode.png');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `middle_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) NOT NULL,
  `birthday` date NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` varchar(50) NOT NULL DEFAULT 'resident',
  `profile_image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(20) DEFAULT NULL,
  `unique_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `middle_name`, `last_name`, `birthday`, `email`, `password`, `user_type`, `profile_image`, `created_at`, `updated_at`, `status`, `unique_id`) VALUES
(1, 'Furina', 'Focalors', 'De Fontaine', '2002-10-13', 'ayaya28@gmail.com', '$2y$10$JNtgFl5XUT2ewDcnmBWMQOuq1Lp1CZnsrJXDAR.zPpovgDMoa5Su2', 'resident', 'uploads/furi.jpg', '2024-09-12 10:38:29', '2024-10-07 15:01:35', 'Active now', 0),
(2, 'Navia', 'sakosako', 'Rosula', '2002-09-29', 'spinaderosula@gmail.com', '$2y$10$DmQUkL7E7xE1zOGwCvNj3OtJtKKJ9nMfcIlU9SO1zjGKA0V80ZF0q', 'resident', 'uploads/hot ayaka.jpeg', '2024-09-12 16:51:40', '2024-09-12 16:51:40', NULL, 0),
(3, 'Mike', 'Reyes', 'Ogaban', '2002-02-22', 'alaka@gmail.com', '$2y$10$TCUpXVLJiULxy3ZEUOCoyuBl4TePkHn7ZH/M3a7w0m3egt/VIe01q', 'resident', 'uploads/stelle.png', '2024-09-13 06:33:48', '2024-10-07 15:01:35', 'Active now', 0),
(4, 'Ren', 'Malupet', 'Tofu', '2002-08-27', 'ayakaaa28@gmail.com', '$2y$10$wMqU2YdoyY6wbfVFUu2nueqAewDVI/QDJmKRPhuV33nYdeKHSirIy', 'resident', 'uploads/furi.jpg', '2024-09-13 06:39:08', '2024-10-07 15:01:35', 'Active now', 0),
(5, 'Furina', 'Focalors', 'De Fontaine', '0000-00-00', 'furina500@gmail.com', '$2y$10$3bERnFGvPMcBragnBpf4HeFiZCqb2Y8L8nD7rEhcFX9RJGsaAxhxW', 'Health Personnel', '', '2024-09-18 08:52:42', '2024-11-28 10:00:47', 'Active now', 5),
(6, 'Randiel', 'Asis', 'James', '2024-07-04', 'randielasis15@gmail.com', '$2y$10$CkEW8Q3eiDqWcAfL9Dj35eC4bXkBldaUzSTkBdVb7F.Cgxpe6E6kS', 'resident', 'Screenshot 2024-12-10 011803.png', '2024-12-10 08:56:18', '2024-12-10 08:58:50', NULL, 540708);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about`
--
ALTER TABLE `about`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `administrator`
--
ALTER TABLE `administrator`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `animal_bite_records`
--
ALTER TABLE `animal_bite_records`
  ADD PRIMARY KEY (`id`),
  ADD KEY `resident_id` (`resident_id`);

--
-- Indexes for table `announcements`
--
ALTER TABLE `announcements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `anti_pneumonia`
--
ALTER TABLE `anti_pneumonia`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brgy_health`
--
ALTER TABLE `brgy_health`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `family_planning`
--
ALTER TABLE `family_planning`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `home`
--
ALTER TABLE `home`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hypertension`
--
ALTER TABLE `hypertension`
  ADD PRIMARY KEY (`hypertension_id`),
  ADD KEY `resident_id` (`resident_id`);

--
-- Indexes for table `immunization`
--
ALTER TABLE `immunization`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `immunization_1`
--
ALTER TABLE `immunization_1`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `immunization_2`
--
ALTER TABLE `immunization_2`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `immunization_3`
--
ALTER TABLE `immunization_3`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `immunization_4`
--
ALTER TABLE `immunization_4`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `immunization_5`
--
ALTER TABLE `immunization_5`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `influenza_vaccination`
--
ALTER TABLE `influenza_vaccination`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `logo`
--
ALTER TABLE `logo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`msg_id`);

--
-- Indexes for table `nutrition`
--
ALTER TABLE `nutrition`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nutrition_1`
--
ALTER TABLE `nutrition_1`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_nutrition_id` (`nutrition_id`);

--
-- Indexes for table `nutrition_2`
--
ALTER TABLE `nutrition_2`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nutrition_3`
--
ALTER TABLE `nutrition_3`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nutrition_4`
--
ALTER TABLE `nutrition_4`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nutrition_5`
--
ALTER TABLE `nutrition_5`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `organization`
--
ALTER TABLE `organization`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parent_id` (`parent_id`);

--
-- Indexes for table `otp`
--
ALTER TABLE `otp`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`);

--
-- Indexes for table `otpa`
--
ALTER TABLE `otpa`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_email` (`email`);

--
-- Indexes for table `prenatal`
--
ALTER TABLE `prenatal`
  ADD PRIMARY KEY (`prenatal_id`),
  ADD KEY `resident_id` (`resident_id`);

--
-- Indexes for table `programs`
--
ALTER TABLE `programs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purok_boundaries`
--
ALTER TABLE `purok_boundaries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `residents`
--
ALTER TABLE `residents`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_card_no` (`id_card_no`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `email_2` (`email`),
  ADD KEY `email_3` (`email`),
  ADD KEY `email_4` (`email`),
  ADD KEY `email_5` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about`
--
ALTER TABLE `about`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `administrator`
--
ALTER TABLE `administrator`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `animal_bite_records`
--
ALTER TABLE `animal_bite_records`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `announcements`
--
ALTER TABLE `announcements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `anti_pneumonia`
--
ALTER TABLE `anti_pneumonia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `brgy_health`
--
ALTER TABLE `brgy_health`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `family_planning`
--
ALTER TABLE `family_planning`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `home`
--
ALTER TABLE `home`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `hypertension`
--
ALTER TABLE `hypertension`
  MODIFY `hypertension_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `immunization`
--
ALTER TABLE `immunization`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `immunization_1`
--
ALTER TABLE `immunization_1`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `immunization_2`
--
ALTER TABLE `immunization_2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `immunization_3`
--
ALTER TABLE `immunization_3`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `immunization_4`
--
ALTER TABLE `immunization_4`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `immunization_5`
--
ALTER TABLE `immunization_5`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `influenza_vaccination`
--
ALTER TABLE `influenza_vaccination`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `logo`
--
ALTER TABLE `logo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `nutrition`
--
ALTER TABLE `nutrition`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `nutrition_1`
--
ALTER TABLE `nutrition_1`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `nutrition_2`
--
ALTER TABLE `nutrition_2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `nutrition_3`
--
ALTER TABLE `nutrition_3`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `nutrition_4`
--
ALTER TABLE `nutrition_4`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `nutrition_5`
--
ALTER TABLE `nutrition_5`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `organization`
--
ALTER TABLE `organization`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `otp`
--
ALTER TABLE `otp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `otpa`
--
ALTER TABLE `otpa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `prenatal`
--
ALTER TABLE `prenatal`
  MODIFY `prenatal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `programs`
--
ALTER TABLE `programs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `purok_boundaries`
--
ALTER TABLE `purok_boundaries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `residents`
--
ALTER TABLE `residents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `animal_bite_records`
--
ALTER TABLE `animal_bite_records`
  ADD CONSTRAINT `animal_bite_records_ibfk_1` FOREIGN KEY (`resident_id`) REFERENCES `residents` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `hypertension`
--
ALTER TABLE `hypertension`
  ADD CONSTRAINT `hypertension_ibfk_1` FOREIGN KEY (`resident_id`) REFERENCES `residents` (`id`);

--
-- Constraints for table `nutrition_1`
--
ALTER TABLE `nutrition_1`
  ADD CONSTRAINT `fk_nutrition_id` FOREIGN KEY (`nutrition_id`) REFERENCES `nutrition` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `organization`
--
ALTER TABLE `organization`
  ADD CONSTRAINT `organization_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `organization` (`id`);

--
-- Constraints for table `otp`
--
ALTER TABLE `otp`
  ADD CONSTRAINT `otp_ibfk_1` FOREIGN KEY (`email`) REFERENCES `users` (`email`) ON DELETE CASCADE;

--
-- Constraints for table `otpa`
--
ALTER TABLE `otpa`
  ADD CONSTRAINT `otpa_ibfk_1` FOREIGN KEY (`email`) REFERENCES `administrator` (`email`) ON DELETE CASCADE;

--
-- Constraints for table `prenatal`
--
ALTER TABLE `prenatal`
  ADD CONSTRAINT `prenatal_ibfk_1` FOREIGN KEY (`resident_id`) REFERENCES `residents` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
