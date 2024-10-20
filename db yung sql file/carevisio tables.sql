-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 07, 2024 at 05:20 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

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

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `generate_and_insert_otp` (IN `user_email` VARCHAR(100))   BEGIN
    DECLARE otp INT;
    SET otp = FLOOR(100000 + RAND() * 900000);
    INSERT INTO otp (otp_number, email) VALUES (otp, user_email);
END$$

DELIMITER ;

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
  `pfp` longblob NOT NULL,
  `a_status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `administrator`
--

INSERT INTO `administrator` (`id`, `firstname`, `midname`, `lastname`, `cpnumber`, `email`, `password`, `user_type`, `pfp`, `a_status`) VALUES
(1, 'Juan', NULL, 'Dela Cruz', '091234567890', 'admin@gmail.com', '$2y$10$meRTBQGo1MvYRoUrzZAjCuAJ.Knit8dduTFpHVfw0NptDChAx7Xm6', 'System Administrator', '', 'Active'),
(11, 'Furina', 'Focalors', 'De Fontaine', '09467812431', 'furina500@gmail.com', '$2y$10$3bERnFGvPMcBragnBpf4HeFiZCqb2Y8L8nD7rEhcFX9RJGsaAxhxW', 'Barangay Health Worker', '', 'Active'),
(13, 'Agnes', 'Villaranda', 'Ogaban', '09467812431', 'agnesogaban08@gmail.com', '$2y$10$Lcj3urTMu8PkdGPtazMTAOPWPfqz9W2FJy0yawNNHrfkC5H6RCzVe', 'Barangay Health Worker', '', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `animal_bite_records`
--

CREATE TABLE `animal_bite_records` (
  `id` int(11) NOT NULL,
  `resident_id` int(11) DEFAULT NULL,
  `bite_date` date DEFAULT NULL,
  `treatment_date` date DEFAULT NULL,
  `bitten_location` varchar(255) DEFAULT NULL,
  `bite_location` varchar(255) DEFAULT NULL,
  `treatment_center` varchar(255) DEFAULT NULL,
  `remarks` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `animal_bite_records`
--

INSERT INTO `animal_bite_records` (`id`, `resident_id`, `bite_date`, `treatment_date`, `bite_location`, `treatment_center`, `remarks`) VALUES
(1, 2, '2024-09-21', '2024-09-21', 'index finger', 'Rabaxx', 'edgg'),
(3, 4, '2024-10-04', '2024-10-23', 'index finger', 'Rabaxx', '');

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
(4, 'carlo', 'andrie', 'abagay', '', 'Purok 1', 'Bagumbayan', 'Daraga', 'Albay', '2024-01-05', 'left', '2023-12-20');

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
  `fb_link` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(2, 2, '2024-10-04', 'amox', '85/1159', 'hfgdgfghdwdwwfwfddd');

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
  `province` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `nutrition_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `remarks` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `prenatal`
--

INSERT INTO `prenatal` (`prenatal_id`, `resident_id`, `checkup_date`, `gestational_age`, `blood_pressure`, `weight`, `fetal_heartbeat`, `remarks`) VALUES
(2, 4, '2024-10-05', 3, '85/115', 56.00, '35', 'vdvdvssdsdewewew');

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
  `profile` longblob DEFAULT NULL,
  `qr_code` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `residents`
--

INSERT INTO `residents` (`id`, `fname`, `mname`, `lname`, `suffix`, `sex`, `bday`, `pob`, `religion`, `citizenship`, `street`, `zone`, `brgy`, `mun`, `province`, `zipcode`, `contact`, `educational`, `occupation`, `civil_status`, `labor_status`, `voter_status`, `pwd_status`, `four_p`, `vac_status`, `status`, `longitude`, `latitude`, `profile`, `qr_code`) VALUES
(1, 'Furina', 'Focalors', 'De Fontaine', '', 'Male', '2023-06-06', 'Daraga', 'Roman Catholic', 'Filipino', 'N/A', 'Purok 1', 'Bagumbayan', 'Daraga', 'Albay', '4501', '09467812431', 'Preschool', 'Tambay', 'Single', 'Not in the Labor Force', 'Yes', 'Yes', 'Yes', 'Fully Vaccinated', 'Active', '123.71827', '13.142307', '', NULL),
(2, 'Navia', 'spina', 'De Rosula', '', 'Female', '2019-06-28', 'Daraga', 'Roman Catholic', 'Filipino', '', 'Purok 3', 'Bagumbayan', 'Daraga', 'Albay', '4501', '', 'Preschool', 'Tambay sa bahay', 'Single', 'Employed', 'Yes', 'Yes', 'Yes', 'Fully Vaccinated', 'Active', '123.71580578679966', '13.141973617231812', '', NULL),
(3, 'danica', 'Focalors', 'De Fontaine', '', 'Female', '2024-09-24', 'Daraga', 'Roman Catholic', 'Filipino', 'N/A', 'Purok 4', 'Bagumbayan', 'Daraga', 'Albay', '4501', '09467812431', 'Preschool', 'Tambay', 'Single', 'Employed', 'Yes', 'Yes', 'Yes', 'Fully Vaccinated', 'Active', '123.71643033164248', '13.140564314980484', '', 'qrcodes/3.png'),
(4, 'Charlotte', 'Focalors', 'De Bird', '', 'Female', '2002-04-29', 'Fontaine', 'Hydro', 'Filipino', 'Sheesh', 'Purok 1', 'Bagumbayan', 'Daraga', 'Albay', '4501', '09467812431', 'Preschool', 'Tambay sa bahay', 'Single', 'Employed', 'Yes', 'Yes', 'Yes', 'Fully Vaccinated', 'Active', '123.71454388552213', '13.143833181047338', '', 'qrcodes/4.png');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `unique_id` varchar(100) DEFAULT NULL,
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
  `status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `unique_id`, `first_name`, `middle_name`, `last_name`, `birthday`, `email`, `password`, `user_type`, `profile_image`, `created_at`, `updated_at`, `status`) VALUES
(1, '1', 'Furina', 'Focalors', 'De Fontaine', '2002-10-13', 'ayaya28@gmail.com', '$2y$10$JNtgFl5XUT2ewDcnmBWMQOuq1Lp1CZnsrJXDAR.zPpovgDMoa5Su2', 'resident', 'uploads/furi.jpg', '2024-09-12 10:38:29', '2024-10-07 15:01:35', 'Active now'),
(2, NULL, 'Navia', 'sakosako', 'Rosula', '2002-09-29', 'spinaderosula@gmail.com', '$2y$10$DmQUkL7E7xE1zOGwCvNj3OtJtKKJ9nMfcIlU9SO1zjGKA0V80ZF0q', 'resident', 'uploads/hot ayaka.jpeg', '2024-09-12 16:51:40', '2024-09-12 16:51:40', NULL),
(3, '1', 'Mike', 'Reyes', 'Ogaban', '2002-02-22', 'alaka@gmail.com', '$2y$10$TCUpXVLJiULxy3ZEUOCoyuBl4TePkHn7ZH/M3a7w0m3egt/VIe01q', 'resident', 'uploads/stelle.png', '2024-09-13 06:33:48', '2024-10-07 15:01:35', 'Active now'),
(4, '1', 'Ren', 'Malupet', 'Tofu', '2002-08-27', 'ayakaaa28@gmail.com', '$2y$10$wMqU2YdoyY6wbfVFUu2nueqAewDVI/QDJmKRPhuV33nYdeKHSirIy', 'resident', 'uploads/furi.jpg', '2024-09-13 06:39:08', '2024-10-07 15:01:35', 'Active now'),
(5, '1692546841', 'Furina', 'Focalors', 'De Fontaine', '0000-00-00', 'furina500@gmail.com', '$2y$10$3bERnFGvPMcBragnBpf4HeFiZCqb2Y8L8nD7rEhcFX9RJGsaAxhxW', 'Health Personnel', '', '2024-09-18 08:52:42', '2024-09-30 13:00:06', 'Active now');

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
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `logo`
--
ALTER TABLE `logo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `otp`
--
ALTER TABLE `otp`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`);

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
-- Indexes for table `residents`
--
ALTER TABLE `residents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about`
--
ALTER TABLE `about`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `administrator`
--
ALTER TABLE `administrator`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

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
-- AUTO_INCREMENT for table `brgy_health`
--
ALTER TABLE `brgy_health`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `home`
--
ALTER TABLE `home`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `hypertension`
--
ALTER TABLE `hypertension`
  MODIFY `hypertension_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `logo`
--
ALTER TABLE `logo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `otp`
--
ALTER TABLE `otp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `prenatal`
--
ALTER TABLE `prenatal`
  MODIFY `prenatal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `programs`
--
ALTER TABLE `programs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `residents`
--
ALTER TABLE `residents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
-- Constraints for table `otp`
--
ALTER TABLE `otp`
  ADD CONSTRAINT `otp_ibfk_1` FOREIGN KEY (`email`) REFERENCES `users` (`email`) ON DELETE CASCADE;

--
-- Constraints for table `prenatal`
--
ALTER TABLE `prenatal`
  ADD CONSTRAINT `prenatal_ibfk_1` FOREIGN KEY (`resident_id`) REFERENCES `residents` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
