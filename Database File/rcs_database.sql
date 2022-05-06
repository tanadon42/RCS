-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 06, 2022 at 03:15 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rcs_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `rcs_approve`
--

CREATE TABLE `rcs_approve` (
  `apr_id` int(11) NOT NULL COMMENT 'approve id',
  `apr_state` int(2) NOT NULL COMMENT 'approve state\r\nex. 1: preparer,\r\n2: checker,\r\n3: approver,\r\n4: approver md,\r\n5: receiver(admin),\r\n6: checker(admin),\r\n7: approver(admin)',
  `apr_frm_id` int(10) NOT NULL COMMENT 'form id',
  `apr_preparer_emp_id` varchar(50) CHARACTER SET utf8 NOT NULL COMMENT 'create form by emp_id',
  `apr_preparer_date` date NOT NULL DEFAULT current_timestamp() COMMENT 'create form date',
  `apr_checker_emp_id` varchar(10) CHARACTER SET utf8 DEFAULT NULL COMMENT 'checker each department',
  `apr_checker_status` int(1) DEFAULT NULL COMMENT 'approved status',
  `apr_checker_date` date DEFAULT NULL COMMENT 'approved date',
  `apr_approver_emp_id` varchar(50) CHARACTER SET utf8 DEFAULT NULL COMMENT 'approver each department',
  `apr_approver_status` int(1) DEFAULT NULL COMMENT 'approved status',
  `apr_approver_date` date DEFAULT NULL COMMENT 'approved date',
  `apr_approver_md_emp_id` varchar(50) CHARACTER SET utf8 DEFAULT NULL COMMENT 'approver MD each department',
  `apr_approver_md_status` int(1) DEFAULT NULL COMMENT 'approved status',
  `apr_approver_md_date` date DEFAULT NULL COMMENT 'approved date',
  `apr_receiver_admin_emp_id` varchar(50) CHARACTER SET utf8 DEFAULT NULL COMMENT 'receiver admin',
  `apr_receiver_admin_status` int(1) DEFAULT NULL COMMENT 'approved status',
  `apr_receiver_admin_date` date DEFAULT NULL COMMENT 'approved date',
  `apr_checker_admin_emp_id` varchar(50) CHARACTER SET utf8 DEFAULT NULL COMMENT 'checker admin',
  `apr_checker_admin_status` int(10) DEFAULT NULL COMMENT 'approved status',
  `apr_checker_admin_date` date DEFAULT NULL COMMENT 'approved date',
  `apr_approver_admin_emp_id` varchar(50) DEFAULT NULL COMMENT 'approver admin ',
  `apr_approver_admin_status` int(1) DEFAULT NULL COMMENT 'approved status',
  `apr_approver_admin_date` date DEFAULT NULL COMMENT 'approved date',
  `apr_note` varchar(255) CHARACTER SET utf8 DEFAULT NULL COMMENT 'หมายเหตุ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rcs_approve`
--

INSERT INTO `rcs_approve` (`apr_id`, `apr_state`, `apr_frm_id`, `apr_preparer_emp_id`, `apr_preparer_date`, `apr_checker_emp_id`, `apr_checker_status`, `apr_checker_date`, `apr_approver_emp_id`, `apr_approver_status`, `apr_approver_date`, `apr_approver_md_emp_id`, `apr_approver_md_status`, `apr_approver_md_date`, `apr_receiver_admin_emp_id`, `apr_receiver_admin_status`, `apr_receiver_admin_date`, `apr_checker_admin_emp_id`, `apr_checker_admin_status`, `apr_checker_admin_date`, `apr_approver_admin_emp_id`, `apr_approver_admin_status`, `apr_approver_admin_date`, `apr_note`) VALUES
(6, 7, 35, '100', '2022-03-01', '1013', 1, '2022-03-09', '1024', 1, '2022-03-10', '1025', NULL, NULL, '1032', 1, '2022-03-10', '1034', 1, '2022-03-10', '1035', 1, '2022-03-10', NULL),
(7, 5, 36, '100', '2022-03-01', '1013', 1, '2022-03-28', '1024', 1, '2022-03-28', '1025', NULL, NULL, '1032', 1, '2022-03-28', '1034', 2, '2022-03-28', '1035', NULL, NULL, 'ไม่อนุมัติ เพราะข้อมูลไม่ครบถ้วน'),
(8, 4, 37, '100', '2022-03-01', '1013', 1, '2022-03-30', '1024', 1, '2022-03-30', '1025', NULL, NULL, '1032', NULL, NULL, '1034', NULL, NULL, '1035', NULL, NULL, ''),
(9, 5, 38, '1010', '2022-03-01', '1013', 1, '2022-03-30', '1024', 1, '2022-03-30', '1025', NULL, NULL, '1032', NULL, NULL, '1034', NULL, NULL, '1035', NULL, NULL, ''),
(10, 5, 39, '100', '2022-03-01', '1013', 1, '2022-03-16', '1024', 1, '2022-03-27', '1025', 1, '2022-03-27', '1032', NULL, NULL, '1034', NULL, NULL, '1035', NULL, NULL, ''),
(11, 5, 40, '100', '2022-03-01', '1013', 1, '2022-03-09', '1024', 1, '2022-03-27', '1025', 1, '2022-03-27', '1032', NULL, NULL, '1034', NULL, NULL, '1035', NULL, NULL, ''),
(12, 2, 41, '100', '2022-03-02', '1013', 1, '2022-03-30', '1024', 2, '2022-03-30', '1025', NULL, NULL, '1032', NULL, NULL, '1034', NULL, NULL, '1035', NULL, NULL, 'ข้อมูลไม่ถูกต้อง'),
(14, 2, 44, '101', '2022-03-08', '1013', 1, '2022-03-30', '1024', 2, '2022-03-30', '1025', NULL, NULL, '1032', NULL, NULL, '1034', NULL, NULL, '1035', NULL, NULL, 'ข้อมูลไม่ถูกต้อง'),
(15, 7, 45, '101', '2022-03-08', '1013', 1, '2022-03-14', '1024', 1, '2022-03-14', '1025', 1, '2022-03-14', '1032', 1, '2022-03-14', '1034', 1, '2022-03-14', '1035', 1, '2022-03-19', NULL),
(17, 5, 47, '1010', '2022-03-08', '1013', 1, '2022-03-30', '1024', 1, '2022-03-30', '1025', NULL, NULL, '1032', NULL, NULL, '1034', NULL, NULL, '1035', NULL, NULL, ''),
(18, 4, 48, '1013', '2022-03-08', '1013', 1, '2022-04-09', '1024', 1, '2022-04-13', '1025', NULL, NULL, '1032', NULL, NULL, '1034', NULL, NULL, '1035', NULL, NULL, 'test 13/4/65'),
(20, 4, 51, '1035', '2022-03-08', '1013', 1, '2022-04-10', '1024', 1, '2022-04-13', '1025', NULL, NULL, '1032', NULL, NULL, '1034', NULL, NULL, '1035', NULL, NULL, 'test 13/4/65'),
(21, 5, 52, '1035', '2022-03-16', '1013', 1, '2022-03-30', '1024', 1, '2022-04-18', '1025', NULL, NULL, '1032', 2, '2022-04-18', '1034', NULL, NULL, '1035', NULL, NULL, ''),
(22, 7, 53, '100', '2022-03-30', '1013', 1, '2022-03-30', '1024', 1, '2022-03-30', '1025', NULL, NULL, '1032', 1, '2022-03-30', '1034', 1, '2022-03-30', '1035', 1, '2022-03-30', '                                                                                                                                                                                     \n                                 \n                                 \n     '),
(23, 3, 54, '1024', '2022-04-17', '1013', 1, '2022-04-18', '1024', NULL, NULL, '1025', NULL, NULL, '1032', NULL, NULL, '1034', NULL, NULL, '1035', NULL, NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `rcs_category`
--

CREATE TABLE `rcs_category` (
  `ctg_id` int(11) NOT NULL,
  `ctg_employment_type` int(1) DEFAULT NULL COMMENT '1:internal,\r\n2:external',
  `ctg_internal_type` int(1) DEFAULT NULL COMMENT '1: indirect to direct,\r\n2: indirect to indirect,\r\n3: direct to indirect,\r\n4: direct to direct',
  `ctg_external_type` int(1) DEFAULT NULL,
  `ctg_req_num` int(10) DEFAULT NULL COMMENT 'required number',
  `ctg_start_date` date DEFAULT NULL,
  `ctg_end_date` date DEFAULT NULL,
  `ctg_req_date` date DEFAULT NULL,
  `ctg_pos_id` varchar(50) CHARACTER SET utf8 NOT NULL COMMENT 'position id',
  `ctg_dpm_id` varchar(50) CHARACTER SET utf8 NOT NULL COMMENT 'department id',
  `ctg_sec_id` varchar(50) CHARACTER SET utf8 NOT NULL COMMENT 'section id'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rcs_category`
--

INSERT INTO `rcs_category` (`ctg_id`, `ctg_employment_type`, `ctg_internal_type`, `ctg_external_type`, `ctg_req_num`, `ctg_start_date`, `ctg_end_date`, `ctg_req_date`, `ctg_pos_id`, `ctg_dpm_id`, `ctg_sec_id`) VALUES
(43, 1, 1, 0, 2, '0000-00-00', '0000-00-00', '0000-00-00', 'P521', 'SDM-DP0003', 'SDM-SC0008'),
(44, 1, 2, 0, 3, '0000-00-00', '0000-00-00', '0000-00-00', 'P411', 'SDM-DP0014', 'SDM-SC0042'),
(45, 1, 3, 0, 4, '0000-00-00', '0000-00-00', '0000-00-00', 'P411', 'SDM-DP0001', 'SDM-SC0001'),
(46, 1, 4, 0, 6, '0000-00-00', '0000-00-00', '0000-00-00', 'P412', 'SDM-DP0006', 'SDM-SC0015'),
(47, 2, 0, 4, 10, '2022-03-25', '2022-12-25', '2022-03-18', 'P231', 'SDM-DP0003', 'SDM-SC0011'),
(48, 2, 0, 3, 7, '2022-03-21', '2022-09-25', '2022-04-07', 'P253', 'SDM-DP0011', 'SDM-SC0033'),
(49, 2, 0, 5, 2, '2022-03-31', '2022-10-30', '2022-03-26', 'P512', 'SDM-DP0014', 'SDM-SC0044'),
(51, 2, 0, 1, 2, NULL, NULL, '2022-03-22', 'P112', 'SDM-DP0013', 'SDM-SC0040'),
(54, 2, 0, 5, 5, '2022-03-31', '2022-06-30', '2022-03-27', 'P313', 'SDM-DP0007', 'SDM-SC0019'),
(55, 2, 0, 4, 5, '2022-03-31', '2022-09-30', '2022-03-31', 'P511', 'SDM-DP0003', 'SDM-SC0008'),
(57, 1, 3, 0, 1, NULL, NULL, NULL, 'P112', 'SDM-DP0014', 'SDM-SC0043'),
(58, 1, 3, 0, 1, NULL, NULL, NULL, 'P112', 'SDM-DP0014', 'SDM-SC0043'),
(59, 1, 2, 0, 1, NULL, NULL, NULL, 'P112', 'SDM-DP0014', 'SDM-SC0043'),
(60, 2, 0, 3, 2, '2022-03-30', '2022-09-28', '2022-03-30', 'P522', 'SDM-DP0003', 'SDM-SC0008'),
(63, 2, 0, 5, 2, '2022-03-10', '2022-08-19', '2022-03-31', 'P211', 'SDM-DP0003', 'SDM-SC0011'),
(64, 1, 1, 0, 2, NULL, NULL, NULL, 'P252', 'SDM-DP0003', 'SDM-SC0008'),
(65, 1, 1, 0, 2, NULL, NULL, NULL, 'P212', 'SDM-DP0003', 'SDM-SC0011'),
(66, 1, 2, 0, 1, NULL, NULL, NULL, 'P112', 'SDM-DP0009', 'SDM-SC0023');

-- --------------------------------------------------------

--
-- Table structure for table `rcs_form`
--

CREATE TABLE `rcs_form` (
  `frm_id` int(10) NOT NULL,
  `frm_status` int(1) NOT NULL COMMENT '1: wait for approve,\r\n2: reject,\r\n3: approved',
  `frm_ref_id` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT 'reference JD No.',
  `frm_addition` varchar(255) NOT NULL COMMENT 'additionDuty & responsibility',
  `frm_qlf_id` int(10) NOT NULL COMMENT 'qualification required id',
  `frm_ctg_id` int(10) NOT NULL COMMENT 'category id',
  `frm_hcc_id` int(11) NOT NULL COMMENT 'headcount control id'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rcs_form`
--

INSERT INTO `rcs_form` (`frm_id`, `frm_status`, `frm_ref_id`, `frm_addition`, `frm_qlf_id`, `frm_ctg_id`, `frm_hcc_id`) VALUES
(35, 3, 'JD-1000', 'Planning Support', 38, 43, 32),
(36, 2, 'JD-1001', 'Accounting Support', 39, 44, 33),
(37, 1, 'JD-1002', '-', 40, 45, 34),
(38, 1, 'JD-1003', 'Checker', 41, 46, 35),
(39, 1, 'JD-1004', 'Accounting', 42, 47, 36),
(40, 1, 'JD-1005', 'Planning', 43, 48, 37),
(41, 2, 'JD-100723', 'ตรวจสอบบัญชีการเงินของแผนก', 44, 49, 38),
(44, 2, 'JD-12123', '-', 47, 54, 41),
(45, 3, 'JD-00000123', '-', 48, 55, 42),
(47, 1, 'JD-10332', '-', 50, 59, 44),
(48, 1, 'JD-100321', '-', 51, 60, 45),
(51, 1, 'JD-10332', '-', 54, 63, 48),
(52, 1, 'test jd123', 'test', 55, 64, 49),
(53, 3, 'JD-1231', 'ตรวจสอบบัญชีการเงินของแผนก', 56, 65, 50),
(54, 1, 'JD1234567', '-', 57, 66, 51);

-- --------------------------------------------------------

--
-- Table structure for table `rcs_headcount_control`
--

CREATE TABLE `rcs_headcount_control` (
  `hcc_id` int(11) NOT NULL,
  `hcc_type` int(1) NOT NULL COMMENT '1: ReplacementofResignedMember,\r\n2: Increment from Headcount,\r\n3: ReplacementofJobRotation',
  `hcc_num1` int(5) NOT NULL,
  `hcc_num2` int(5) DEFAULT NULL,
  `hcc_note` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rcs_headcount_control`
--

INSERT INTO `rcs_headcount_control` (`hcc_id`, `hcc_type`, `hcc_num1`, `hcc_num2`, `hcc_note`) VALUES
(32, 1, 2, 1, ''),
(33, 1, 2, 1, ''),
(34, 1, 2, 1, ''),
(35, 1, 2, 1, ''),
(36, 1, 2, 1, ''),
(37, 2, 3, 0, 'เครื่องจักรใช้งานไม่ได้เป็นจำนวนมาก'),
(38, 1, 2, 1, ''),
(40, 1, 2, 1, ''),
(41, 1, 2, 1, NULL),
(42, 1, 2, 1, NULL),
(44, 1, 2, 1, NULL),
(45, 1, 2, 1, NULL),
(46, 1, 2, 1, NULL),
(48, 1, 2, 1, NULL),
(49, 1, 2, 1, NULL),
(50, 1, 2, 1, NULL),
(51, 1, 2, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `rcs_login`
--

CREATE TABLE `rcs_login` (
  `log_id` int(11) NOT NULL,
  `log_username` varchar(50) NOT NULL,
  `log_password` varchar(50) NOT NULL,
  `log_role` int(1) NOT NULL COMMENT '1:user, 2:approve, 3:admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rcs_login`
--

INSERT INTO `rcs_login` (`log_id`, `log_username`, `log_password`, `log_role`) VALUES
(1, '100', '100', 1),
(7, '101', '101', 1),
(8, '1010', '1010', 1),
(9, '1013', '1013', 2),
(10, '1024', '1024', 2),
(11, '1025', '1025', 2),
(12, '1031', '1031', 2),
(13, '1032', '1032', 3),
(14, '1034', '1034', 3),
(15, '1035', '1035', 3);

-- --------------------------------------------------------

--
-- Table structure for table `rcs_name_list`
--

CREATE TABLE `rcs_name_list` (
  `nlt_id` int(11) NOT NULL,
  `nlt_emp_id` varchar(50) CHARACTER SET utf8 NOT NULL COMMENT 'employee id',
  `nlt_start_date` date DEFAULT NULL COMMENT 'start date',
  `nlt_effective_date` date DEFAULT NULL COMMENT 'effective date',
  `nlt_type` int(1) DEFAULT NULL COMMENT '1: ลาออก,\r\n2: ทดแทน',
  `nlt_frm_id` int(10) NOT NULL COMMENT 'form id'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rcs_name_list`
--

INSERT INTO `rcs_name_list` (`nlt_id`, `nlt_emp_id`, `nlt_start_date`, `nlt_effective_date`, `nlt_type`, `nlt_frm_id`) VALUES
(10, '453', '0000-00-00', '2022-03-02', 1, 35),
(11, '1083', '0000-00-00', '2022-03-03', 1, 35),
(12, '2585', '0000-00-00', '2022-03-10', 1, 36),
(13, '2308', '0000-00-00', '2022-03-11', 1, 36),
(14, '3601', '0000-00-00', '2022-03-27', 1, 37),
(15, '669', '0000-00-00', '2022-03-29', 1, 37),
(16, '2670', '0000-00-00', '2022-03-30', 1, 38),
(17, '313', '0000-00-00', '2022-03-31', 1, 38),
(18, '3890', '0000-00-00', '2022-03-13', 1, 39),
(19, '3503', '0000-00-00', '2022-03-30', 1, 39),
(20, '3450', '0000-00-00', '2022-03-31', 1, 41),
(21, '3488', '0000-00-00', '2022-03-20', 1, 41),
(26, '1025', '2022-03-25', NULL, 2, 41),
(27, '1231', '2022-03-09', NULL, 2, 37),
(28, '1013', '2022-03-29', NULL, 2, 36),
(29, '1161', '0000-00-00', '2022-03-20', 1, 44),
(30, '1144', '0000-00-00', '2022-03-31', 1, 44),
(31, '144', NULL, '2022-03-13', 1, 45),
(32, '3003', NULL, '2022-03-26', 1, 45),
(35, '2126', NULL, '2022-03-15', 1, 47),
(36, '183', NULL, '2022-03-17', 1, 47),
(37, '3606', NULL, '2022-03-13', 1, 48),
(38, '3692', NULL, '2022-03-22', 1, 48),
(43, '2167', NULL, '2022-03-13', 1, 51),
(44, '212', NULL, '2022-03-31', 1, 51),
(45, '100', '2022-03-15', NULL, 2, 47),
(46, '1248', '2022-03-18', NULL, 2, 39),
(47, '1270', '2022-03-18', NULL, 2, 35),
(48, '3500', NULL, '2022-03-17', 1, 52),
(49, '1519', NULL, '2022-03-17', 1, 52),
(50, '1050', '2022-03-14', NULL, 2, 52),
(51, '1024', NULL, '2022-03-30', 1, 53),
(52, '3595', NULL, '2022-03-30', 1, 53),
(53, '1249', '2022-04-19', NULL, 2, 53),
(54, '78', NULL, '2022-04-12', 1, 54),
(55, '2433', NULL, '2022-04-23', 1, 54),
(56, '1188', '2022-04-30', NULL, 2, 54);

-- --------------------------------------------------------

--
-- Table structure for table `rcs_qualification`
--

CREATE TABLE `rcs_qualification` (
  `qlf_id` int(11) NOT NULL,
  `qlf_education_level` int(1) NOT NULL COMMENT 'education level',
  `qlf_education_major` varchar(255) NOT NULL COMMENT 'education major',
  `qlf_work_exp` int(10) NOT NULL COMMENT 'work experience',
  `qlf_work_exp_field` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT 'work field',
  `qlf_com` varchar(255) NOT NULL COMMENT 'computer',
  `qlf_com_ect` varchar(255) CHARACTER SET utf8 DEFAULT NULL COMMENT 'computer ect',
  `qlf_eng` int(1) NOT NULL COMMENT 'english',
  `qlf_japan` int(1) NOT NULL COMMENT 'japanese',
  `qlf_ect` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT 'addition requirement'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rcs_qualification`
--

INSERT INTO `rcs_qualification` (`qlf_id`, `qlf_education_level`, `qlf_education_major`, `qlf_work_exp`, `qlf_work_exp_field`, `qlf_com`, `qlf_com_ect`, `qlf_eng`, `qlf_japan`, `qlf_ect`) VALUES
(38, 4, 'Informatics', 2, 'IT Support', '2', '', 1, 1, 'ทำงานภายใต้ความกดดันได้'),
(39, 5, 'Engineering', 5, 'Design of Object', '2', '', 2, 2, 'เดินทางมาทำงานภายใต้รถของบริษัทได้'),
(40, 5, 'Analysis', 3, 'Analysis of Planning', '3', 'Visual Studio Code', 2, 3, 'มีอายุอย่างน้อย 25 ปี'),
(41, 4, 'Nurse', 2, 'Nurse in Hospital', '2', '', 2, 4, 'ทำงานดึกได้'),
(42, 4, 'Developer', 3, 'Web Application Developing', '2', '', 2, 2, 'ทำงานวันเสาร์ได้ (วันหยุด)'),
(43, 4, 'Repair of Computer', 1, 'Repairer', '2', '', 1, 1, 'มีรถยนต์ส่วนตัว'),
(44, 3, 'ธุรกิจการบัญชี', 2, 'บัญชีการเงิน', '2', '', 1, 3, 'ทำงานออนไลน์ได้'),
(46, 4, 'Engineering', 2, 'Engineering for Production', '2', '', 2, 2, 'อายุไม่เกิน 30 ปี'),
(47, 4, 'Logistics', 2, 'Logistics', '2', '', 1, 3, 'ทำงานภายใต้ความกดดันได้'),
(48, 4, 'บริหารทรัพยากรมนุษย์', 2, 'บริหารทรัพยากรมนุษย์', '2', '', 1, 4, 'ทำงานวันหยุดได้ (วันเสาร์)'),
(50, 1, '-', 1, 'Support', '2', '', 1, 1, '-'),
(51, 3, 'เครื่องกล', 2, 'ช่างกล', '1', '', 1, 1, '-'),
(54, 3, 'Management', 2, 'HR', '2', '', 1, 1, '-'),
(55, 4, 'SE', 2, 'IT', '2', '', 1, 1, 'test'),
(56, 4, 'วิศกรรมซอฟต์แวร์', 2, 'IT Support', '2', '', 2, 3, 'มีอายุอย่างน้อย 25 ปี และสามารถทำงานในวันหยุดได้ (วันเสาร์)'),
(57, 3, 'บัญชี', 2, 'การเงิน', '1', '', 1, 1, '-');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `rcs_approve`
--
ALTER TABLE `rcs_approve`
  ADD PRIMARY KEY (`apr_id`);

--
-- Indexes for table `rcs_category`
--
ALTER TABLE `rcs_category`
  ADD PRIMARY KEY (`ctg_id`);

--
-- Indexes for table `rcs_form`
--
ALTER TABLE `rcs_form`
  ADD PRIMARY KEY (`frm_id`);

--
-- Indexes for table `rcs_headcount_control`
--
ALTER TABLE `rcs_headcount_control`
  ADD PRIMARY KEY (`hcc_id`);

--
-- Indexes for table `rcs_login`
--
ALTER TABLE `rcs_login`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `rcs_name_list`
--
ALTER TABLE `rcs_name_list`
  ADD PRIMARY KEY (`nlt_id`);

--
-- Indexes for table `rcs_qualification`
--
ALTER TABLE `rcs_qualification`
  ADD PRIMARY KEY (`qlf_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `rcs_approve`
--
ALTER TABLE `rcs_approve`
  MODIFY `apr_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'approve id', AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `rcs_category`
--
ALTER TABLE `rcs_category`
  MODIFY `ctg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `rcs_form`
--
ALTER TABLE `rcs_form`
  MODIFY `frm_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `rcs_headcount_control`
--
ALTER TABLE `rcs_headcount_control`
  MODIFY `hcc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `rcs_login`
--
ALTER TABLE `rcs_login`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `rcs_name_list`
--
ALTER TABLE `rcs_name_list`
  MODIFY `nlt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `rcs_qualification`
--
ALTER TABLE `rcs_qualification`
  MODIFY `qlf_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
