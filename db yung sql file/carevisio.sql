-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 02, 2023 at 10:54 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.1.17

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
-- Table structure for table `administrator`
--

CREATE TABLE `administrator` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `midname` varchar(255),
  `lastname` varchar(255) NOT NULL,
  `cpnumber` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` varchar(255) NOT NULL,
  `pfp` LONGBLOB NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `administrator`
--

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
(4, '2023-12-29', '2023-12-27', '', 'Non-NHTS', 'Female', 'asd', 'sa', 'dsad', '', 'Purok 1', 'Bagumbayan', 'Daraga', 'Albay', 'TT2/Td2', 'dasd', 'dasd', 'sadas'),
(6, '2023-12-08', '2023-12-13', '342', 'NHTS', 'Male', 'ca', 'asdas', 'das', '', 'Purok 1', 'Bagumbayan', 'Daraga', 'Albay', 'TT2/Td2', 'mning', 'king', 'cande');

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
(6, '34', '43', '', '', '', 4, 'N'),
(8, '3', '34', '', '', '', 6, 'N');

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
(6, 34.00, 43.00, 'N', '0000-00-00', '0000-00-00', '0000-00-00', 0, 0.00, '0000-00-00', 0.00, '0000-00-00', 'N', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 'Yes', '0000-00-00', 'Yes', '0000-00-00', 'Yes', '0000-00-00', 'Yes', '0000-00-00', 4),
(8, 3.00, 34.00, 'N', '0000-00-00', '0000-00-00', '0000-00-00', 0, 0.00, '0000-00-00', 0.00, '0000-00-00', 'N', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 'Yes', '0000-00-00', 'Yes', '0000-00-00', 'Yes', '0000-00-00', 'Yes', '0000-00-00', 6);

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
(6, 'Yes', '0000-00-00', 'Yes', 2, '0000-00-00', '0000-00-00', '0000-00-00', 4),
(8, 'Yes', '0000-00-00', 'Yes', 2, '0000-00-00', '0000-00-00', '0000-00-00', 6);

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
(6, 0, 0, '0000-00-00', 0, '0000-00-00', 'N', '0000-00-00', '0000-00-00', 4),
(8, 0, 0, '0000-00-00', 0, '0000-00-00', 'N', '0000-00-00', '0000-00-00', 6);

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
(6, '0000-00-00', '', '', 4, ''),
(8, '0000-00-00', '', '', 6, '');

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

--
-- Dumping data for table `nutrition`
--

INSERT INTO `nutrition` (`id`, `reg`, `bday`, `serial`, `se_status`, `sex`, `length`, `weight`, `fname`, `mname`, `lname`, `suffix`, `zone`, `brgy`, `city`, `province`) VALUES
(1, '2023-12-01', '2023-12-28', '4324', 'Non-NHTS', 'Male', '34', '43', 's', 'dasd', 'sdsd', 'jr', 'Purok 1', 'Bagumbayan', 'Daraga', 'Albay');

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

--
-- Dumping data for table `nutrition_1`
--

INSERT INTO `nutrition_1` (`id`, `nutritional_status`, `mnp_date`, `vitamin_a_1st_dose_date`, `vitamin_a_2nd_dose_date`, `deworming_1st_dose_date`, `deworming_2nd_dose_date`, `deworming_yn`, `nutrition_id`) VALUES
(2, 'W-MAM', '2024-01-05', '2023-12-19', '2023-12-19', '2023-12-05', '2023-11-27', 'Yes', 1);

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
(2, 1, '2023-12-20', '2023-12-19', '2023-12-05', '2023-11-28', 'Yes', 'W-MAM');

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
(2, 1, '2023-12-21', '2023-12-19', '2023-12-13', '2023-12-12', 'Yes', 'W-MAM');

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
(2, 1, '2023-12-20', '2023-12-21', '2023-12-29', '2023-12-26', 'Yes', 'W-MAM');

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
(2, 'Cured', 'Defaulted', 'fuckyou', 1);

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
  `profile` LONGBLOB
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `home`
--

CREATE TABLE `home` (
  `id` int(11) NOT NULL,
  `center_name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `open_hours` varchar(255) NOT NULL,
  `bg_img` LONGBLOB,
  `short_desc` varchar(255) NOT NULL,
  `mission` varchar(255) NOT NULL,
  `vision` varchar(255) NOT NULL,
  `goal` varchar(255) NOT NULL,
  `chairman` varchar(255) NOT NULL,
  `chairman_pic` LONGBLOB,
  `chairman_comm` varchar(255) NOT NULL,
  `chairman_comm_pic` LONGBLOB,
  `section_pic` LONGBLOB,
  `contact_mess` varchar(255) NOT NULL,
  `office_hrs` varchar(255) NOT NULL,
  `programs_pic` LONGBLOB,
  `announce_pic` LONGBLOB,
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `about`
--

CREATE TABLE `about` (
  `id` int(11) NOT NULL,
  `header_pic` LONGBLOB,
  `section_head` varchar(255) NOT NULL,
  `section_subhead` varchar(255) NOT NULL,
  `section_body` varchar(255) NOT NULL,
  `section_pic` LONGBLOB,
  `mission` varchar(255) NOT NULL,
  `vision` varchar(255) NOT NULL,
  `mission_pic` LONGBLOB,
  `vision_pic` LONGBLOB,
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `brgy_health`
--

CREATE TABLE `brgy_health` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `pic` LONGBLOB,
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `programs`
--

CREATE TABLE `programs` (
  `id` int(11) NOT NULL,
  `prog_heading` varchar(255) NOT NULL,
  `prog_body` varchar(255) NOT NULL,
  `prog_pic` LONGBLOB,
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

CREATE TABLE `announcements` (
  `id` int(11) NOT NULL,
  `announce_heading` varchar(255) NOT NULL,
  `announce_body` varchar(255) NOT NULL,
  `announce_pic` LONGBLOB,
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` int(11) NOT NULL,
  `short_mess` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
  `contact` varchar(255) NOT NULL
  `address` varchar(255) NOT NULL
  `fb_name` varchar(255) NOT NULL,
  `fb_link` varchar(255) NOT NULL,
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `logo`
--

CREATE TABLE `logo` (
  `id` int(11) NOT NULL,
  `navbar_logo` LONGBLOB,
  `logo_pic` LONGBLOB,
  `center_name` varchar(255) NOT NULL,
  `short_desc` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------
--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `mname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--


--
-- Table structure for table `user_type`
--

CREATE TABLE `user_type` (
  `id` int(11) NOT NULL,
  `u_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_type`
--

INSERT INTO `user_type` (`id`, `u_type`) VALUES (1, 'system administrator'), (2, 'barangay secretary'), (3, 'barangay healthworker');


--
-- Indexes for table `administrator`
--
ALTER TABLE `administrator`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `anti_pneumonia`
--
ALTER TABLE `anti_pneumonia`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `family_planning`
--
ALTER TABLE `family_planning`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `family_planning_sched`
--
ALTER TABLE `family_planning_sched`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `family_plan_rem`
--
ALTER TABLE `family_plan_rem`
  ADD PRIMARY KEY (`id`);

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
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nutrition`
--
ALTER TABLE `nutrition`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nutrition_1`
--
ALTER TABLE `nutrition_1`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `residents`
--
ALTER TABLE `residents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_type`
--
ALTER TABLE `user_type`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `administrator`
--
ALTER TABLE `administrator`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `anti_pneumonia`
--
ALTER TABLE `anti_pneumonia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `family_planning`
--
ALTER TABLE `family_planning`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `family_planning_sched`
--
ALTER TABLE `family_planning_sched`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `family_plan_rem`
--
ALTER TABLE `family_plan_rem`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `immunization`
--
ALTER TABLE `immunization`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `immunization_1`
--
ALTER TABLE `immunization_1`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `immunization_2`
--
ALTER TABLE `immunization_2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `immunization_3`
--
ALTER TABLE `immunization_3`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `immunization_4`
--
ALTER TABLE `immunization_4`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `immunization_5`
--
ALTER TABLE `immunization_5`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `influenza_vaccination`
--
ALTER TABLE `influenza_vaccination`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `nutrition`
--
ALTER TABLE `nutrition`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `nutrition_1`
--
ALTER TABLE `nutrition_1`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `nutrition_2`
--
ALTER TABLE `nutrition_2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `nutrition_3`
--
ALTER TABLE `nutrition_3`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `nutrition_4`
--
ALTER TABLE `nutrition_4`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `nutrition_5`
--
ALTER TABLE `nutrition_5`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `residents`
--
ALTER TABLE `residents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
