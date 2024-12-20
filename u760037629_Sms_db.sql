-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 24, 2024 at 06:01 AM
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
-- Database: `sms_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

CREATE TABLE `announcements` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `announcement_date` date NOT NULL,
  `announcement_time` time NOT NULL,
  `author` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `announcements`
--

INSERT INTO `announcements` (`id`, `title`, `announcement_date`, `announcement_time`, `author`, `content`, `image`, `created_at`) VALUES
(1, 'Exciting News: DWCC SMS Opening Soon!', '2024-11-05', '05:57:07', 'Janica Dimaano', 'We are excited to share that the DWCC SMS (Scholarship Management System) will open soon! This new platform will make it easier for students to apply for scholarships and manage their applications. Stay tuned for updates and be ready to take advantage of this exciting new resource!', 'announcement.png', '2024-11-05 09:33:49'),
(2, 'Test Announcement ', '2024-11-05', '06:02:15', 'Dr. Van Doom', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc sollicitudin elementum ipsum, vitae semper dolor sodales quis. Ut quis elit eget elit accumsan sodales vitae sed dui. Nunc nisi nibh, ornare at lacus a, bibendum aliquet dui. Sed venenatis purus volutpat, venenatis diam eget, luctus mi. Nulla facilisi.', NULL, '2024-11-05 10:02:15');

-- --------------------------------------------------------

--
-- Table structure for table `applicants`
--

CREATE TABLE `applicants` (
  `account_no` int(5) NOT NULL,
  `id_number` int(5) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `middlename` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) NOT NULL,
  `birthdate` date NOT NULL,
  `gender` enum('Male','Female') NOT NULL,
  `contact` char(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `program_type` enum('College','Senior High School','Junior High School','Grade School') NOT NULL,
  `year` enum('5th','4th','3rd','2nd','1st','Grade 12','Grade 11','Grade 10','Grade 9','Grade 8','Grade 7','Grade 6','Grade 5','Grade 4','Grade 3','Grade 2','Grade 1','Senior Kinder','Junior Kinder','Special Education') NOT NULL,
  `program` varchar(100) NOT NULL,
  `campus` enum('Janssen','Freinademetz') NOT NULL,
  `address` varchar(100) NOT NULL,
  `applicant_residence` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` enum('pending','accepted','declined') NOT NULL DEFAULT 'pending',
  `account_status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `applicant_photo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `applicants`
--

INSERT INTO `applicants` (`account_no`, `id_number`, `firstname`, `middlename`, `lastname`, `birthdate`, `gender`, `contact`, `email`, `program_type`, `year`, `program`, `campus`, `address`, `applicant_residence`, `password`, `status`, `account_status`, `applicant_photo`) VALUES
(1, 47293, 'Janica', 'Nagutom', 'Dimaano', '2003-01-13', 'Female', '09812480380', 'djanica21@gmail.com', 'College', '4th', 'Bachelor of Science in Information Technology', 'Janssen', 'Lopez St., Ilaya Calapan City, Oriental Mindoro', 'With Relative', '$2y$10$MPsgmogp17Sf9CFXNc47GO8DQRwKkuwlYfeNosqvlUYhQ2UWuDplG', 'accepted', 'active', '47293_photo.jpg'),
(2, 47325, 'Ichinoshi', 'Benter', 'Paradiang', '2002-11-29', 'Male', '09123456785', 'ichinoship@gmail.com', 'College', '4th', 'Bachelor of Science in Electrical Engineering', 'Janssen', 'Lalud, Calapan City, Oriental Mindoro', 'DWCC Dormitory', '$2y$10$vpnqSMkaXst1naveUnxW9ekY.eygJEjunAVQTMJknT6gyMvLDIhzK', 'accepted', 'active', '47325_photo.jpg'),
(3, 47312, 'Hayley', 'Smith', 'Williams', '1990-03-12', 'Female', '09123456791', 'hayley.smith@gmail.com', 'Junior High School', 'Grade 10', 'No Program', 'Freinademetz', 'Lopez St., Ilaya Calapan City, Oriental Mindoro', 'Off-Campus Boarding House', '$2y$10$fYhnhOlUoAXLudrX3oxlueiFDnJG785TfdCp29U1MyGQjt9B9F97.', 'accepted', 'active', '47312_photo.jpg'),
(4, 3000, 'Tony ', 'Edward ', 'Stark', '1990-09-19', 'Male', '09171234567', 'tony.stark@gmail.com', 'College', '5th', 'Bachelor of Science in Electrical Engineering', 'Janssen', '10880 Malibu Point, New York City', 'DWCC Dormitory', '$2y$10$Q8qUra0KU2xm/m0WDgKEJuw2GRrj9lZ3CKaeOlzUEW3MVDRagNOL2', 'accepted', 'active', '3000_photo.jpg'),
(5, 3001, 'George', 'Michael', 'Smith', '2001-11-12', 'Male', '09876435212', 'ichinoship@gmail.com', 'Grade School', 'Special Education', 'No Program', 'Freinademetz', 'Queens, New York City', 'With Relative', '', 'declined', 'active', '3001_photo.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `application_form`
--

CREATE TABLE `application_form` (
  `applicant_no` int(5) NOT NULL,
  `account_no` int(5) NOT NULL,
  `id_number` int(5) NOT NULL,
  `applicant_photo` varchar(255) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `middlename` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) NOT NULL,
  `birthdate` date NOT NULL,
  `gender` enum('Male','Female') NOT NULL,
  `contact` char(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `program_type` enum('College','Senior High School','Junior High School','Grade School') NOT NULL,
  `year` enum('5th','4th','3rd','2nd','1st','Grade 12','Grade 11','Grade 10','Grade 9','Grade 8','Grade 7','Grade 6','Grade 5','Grade 4','Grade 3','Grade 2','Grade 1','Senior Kinder','Junior Kinder','Special Education') NOT NULL,
  `program` varchar(100) NOT NULL,
  `campus` enum('Janssen','Freinademetz') NOT NULL,
  `address` varchar(100) NOT NULL,
  `applicant_residence` varchar(100) NOT NULL,
  `academic_year` varchar(9) NOT NULL,
  `semester` enum('1st Semester','2nd Semester','Whole Semester') NOT NULL,
  `application_type` enum('Renewal','New Applicant') NOT NULL,
  `scholarship_program` varchar(255) NOT NULL,
  `requirements` varchar(255) NOT NULL,
  `comment` text DEFAULT NULL,
  `discount` int(3) NOT NULL,
  `status` enum('pending','qualified','not qualified','conditional') DEFAULT 'pending',
  `date_status_changed` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `application_form`
--

INSERT INTO `application_form` (`applicant_no`, `account_no`, `id_number`, `applicant_photo`, `firstname`, `middlename`, `lastname`, `birthdate`, `gender`, `contact`, `email`, `program_type`, `year`, `program`, `campus`, `address`, `applicant_residence`, `academic_year`, `semester`, `application_type`, `scholarship_program`, `requirements`, `comment`, `discount`, `status`, `date_status_changed`) VALUES
(1, 1, 47293, '47293_photo.jpg', 'Janica', 'Nagutom', 'Dimaano', '2003-01-13', 'Female', '09812480380', 'djanica21@gmail.com', 'College', '4th', 'Bachelor of Science in Information Technology', 'Janssen', 'Lopez St., Ilaya Calapan City, Oriental Mindoro', 'With Relative', '2025-2026', '1st Semester', 'New Applicant', 'Academic Scholar (Dean’s Lister)', 'REQUIREMENTS-SMS.pdf', '', 50, 'qualified', NULL),
(2, 1, 47293, '47293_photo.jpg', 'Janica', 'Nagutom', 'Dimaano', '2003-01-13', 'Female', '09812480380', 'djanica21@gmail.com', 'College', '4th', 'Bachelor of Science in Information Technology', 'Janssen', 'Lopez St., Ilaya Calapan City, Oriental Mindoro', 'With Relative', '2025-2026', '1st Semester', 'New Applicant', 'Gazette Scholarship Program', 'REQUIREMENTS-SMS1.pdf', NULL, 0, 'pending', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `final_list`
--

CREATE TABLE `final_list` (
  `final_list_id` int(5) NOT NULL,
  `applicant_no` int(5) NOT NULL,
  `id_number` int(5) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `middlename` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) NOT NULL,
  `program_type` enum('College','Senior High School','Junior High School','Grade School') NOT NULL,
  `year` enum('5th','4th','3rd','2nd','1st','Grade 12','Grade 11','Grade 10','Grade 9','Grade 8','Grade 7','Grade 6','Grade 5','Grade 4','Grade 3','Grade 2','Grade 1','Senior Kinder','Junior Kinder','Special Education') NOT NULL,
  `program` varchar(100) NOT NULL,
  `campus` enum('Janssen','Freinademetz') NOT NULL,
  `application_type` enum('Renewal','New Applicant') NOT NULL,
  `academic_year` varchar(9) NOT NULL,
  `semester` enum('1st Semester','2nd Semester','Whole Semester') NOT NULL,
  `scholarship_program` varchar(100) NOT NULL,
  `discount` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `final_list`
--

INSERT INTO `final_list` (`final_list_id`, `applicant_no`, `id_number`, `firstname`, `middlename`, `lastname`, `program_type`, `year`, `program`, `campus`, `application_type`, `academic_year`, `semester`, `scholarship_program`, `discount`) VALUES
(3, 1, 47293, 'Janica', 'Nagutom', 'Dimaano', 'College', '4th', 'Bachelor of Science in Information Technology', 'Janssen', 'New Applicant', '2025-2026', '1st Semester', 'Academic Scholar (Dean’s Lister)', 50);

-- --------------------------------------------------------

--
-- Table structure for table `program`
--

CREATE TABLE `program` (
  `program_id` int(11) NOT NULL,
  `program` varchar(100) NOT NULL,
  `program_type` enum('College','Senior High School','JHS/Grade School') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `program`
--

INSERT INTO `program` (`program_id`, `program`, `program_type`) VALUES
(1, 'Bachelor of Science in Business Administration', 'College'),
(2, 'Bachelor of Science in Hospitality Management', 'College'),
(3, 'Bachelor of Science in Tourism Management', 'College'),
(4, 'Bachelor of Science in Accountancy', 'College'),
(5, 'Bachelor of Science in Management Accounting', 'College'),
(6, 'Bachelor of Science in Criminology', 'College'),
(7, 'Bachelor of Science in Civil Engineering', 'College'),
(8, 'Bachelor of Science in Computer Engineering', 'College'),
(9, 'Bachelor of Science in Electronics Engineering', 'College'),
(10, 'Bachelor of Science in Electrical Engineering', 'College'),
(11, 'Bachelor of Science in Architecture', 'College'),
(12, 'Bachelor of Science in Fine Arts', 'College'),
(13, 'Bachelor of Elementary Education', 'College'),
(14, 'Bachelor of Secondary Education', 'College'),
(15, 'Bachelor of Physical Education', 'College'),
(16, 'Bachelor of Science in Information Technology', 'College'),
(17, 'Bachelor of Science in Psychology', 'College'),
(18, 'Bachelor of Arts in Political Science', 'College'),
(19, 'Bachelor of Arts in Psychology', 'College'),
(20, 'TRACK - ACADEMIC CSS', 'Senior High School'),
(21, 'TRACK - ACADEMIC TVL', 'Senior High School'),
(22, 'STRAND - STEM', 'Senior High School'),
(23, 'STRAND - ABM', 'Senior High School'),
(24, 'STRAND - HUMSS', 'Senior High School'),
(25, 'No Program', 'JHS/Grade School');

-- --------------------------------------------------------

--
-- Table structure for table `requirements`
--

CREATE TABLE `requirements` (
  `id` int(11) NOT NULL,
  `requirement_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `requirements`
--

INSERT INTO `requirements` (`id`, `requirement_name`) VALUES
(1, 'Certificate of Enrollment from the Registrar'),
(2, 'Certificate of Good Moral Character'),
(3, 'Copy of Grades from MAMS '),
(4, 'Certificate of Indigency'),
(5, 'Class Schedule'),
(6, 'Parent\'s Consent'),
(7, 'Barangay Clearance'),
(8, 'Police Clearance'),
(9, 'Baptismal Certificate'),
(10, 'Recent 1x1 ID photo (one copy)'),
(11, 'Form 137 '),
(12, 'Copy of the latest Income Tax Return (ITR)'),
(13, 'NSO/PSA Birth Certificate'),
(14, 'PWD valid identification card'),
(15, 'Certificate of Employment'),
(16, 'Medical Certificate: ECG, Drug Test, Pregnancy Test'),
(17, 'Down payment of ₱ 1000.00 upon enrollment'),
(18, 'Photocopy of electric and water bills for the last three months'),
(19, 'Recommendation letter from the immediate head'),
(20, 'References/s and/or recommendations from two (2) persons'),
(21, 'Receipt payment during the official enrolment period'),
(22, 'Certification from Non-Government Organizations (NGO) (e.g. Mangyan Mission)'),
(23, 'Scholar should enroll a regular unit load specified in the curriculum'),
(24, 'Submissions must be made through the Accounting Office during official enrollment '),
(25, 'Report Card or transcript with a General Weighted Average (GWA) of at least 81% from the last school attended'),
(26, 'Must come from a family with a monthly income not exceeding ₱ 12,000, as certified by the IP Commission or equivalent agency'),
(27, 'The applicant must submit a certification of total completers/graduates from the School Principal, indicating Highest Honor (98-100%) or High Honor (95-97%)'),
(28, 'Parental consent addressed to the Scholarship Committee allowing the student to work at DWCC and should be submitted to the Administrative Office'),
(29, 'Senior High School card with a general average of at least 83% for incoming freshmen, or MAMS grades with an average of at least 83%'),
(30, 'Letter of Intent addressed to the College President through the DWCC Human Resource Office'),
(31, 'Submit requirements only in the first semester, except for: down payment receipt, certificate of good moral character, class schedule copy, and MAMS grades printout');

-- --------------------------------------------------------

--
-- Table structure for table `scholarship_programs`
--

CREATE TABLE `scholarship_programs` (
  `program_code` int(11) NOT NULL,
  `scholarship_program` varchar(255) NOT NULL,
  `campus` enum('Janssen','Freinademetz','All Campuses') NOT NULL,
  `description` text DEFAULT NULL,
  `qualifications` text DEFAULT NULL,
  `requirements` text NOT NULL,
  `percentage` text NOT NULL,
  `scholarship_type` enum('Non-Merit','Merit') NOT NULL,
  `assigned_to` int(11) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `program_status` enum('active','inactive') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `scholarship_programs`
--

INSERT INTO `scholarship_programs` (`program_code`, `scholarship_program`, `campus`, `description`, `qualifications`, `requirements`, `percentage`, `scholarship_type`, `assigned_to`, `start_date`, `end_date`, `program_status`, `created_at`) VALUES
(1, 'Academic Scholar (Dean’s Lister)', 'Janssen', 'This is given to students who have performed excellently in their academics during the immediate previous semester. There are equivalent numbers of slots per department that applicants will be vying for. The number of slots allotted per department depends on the number of student’s population and determined using the ratio of 50:1 (50 students / one scholar). ', 'Must not have failing grades from the past semester.; Must be a full-time student with regular unit load specified in the curriculum.', 'Certificate of Enrollment from the Registrar;Copy of Grades from MAMS ;Letter of Intent addressed to the College President through the DWCC Human Resource Office', '100% - Full; 50% - Partial', 'Merit', 3, '2024-10-20', '2024-12-31', 'active', '2024-09-12 08:07:09'),
(2, 'Academic Scholarship (BE)', 'Freinademetz', 'This is designed to recognize and reward outstanding basic education students who have demonstrated exceptional academic performance throughout the entire academic year.', 'Rank 1 in the grade level shall receive scholarship in the following year.; Must not have failing grades for the past semester.', 'Certificate of Enrollment from the Registrar;Copy of Grades from MAMS ', '100% - Full; 50% - Partial', 'Merit', 4, '2024-10-20', '2024-12-31', 'active', '2024-09-12 12:55:04'),
(3, 'Gazette Scholarship Program', 'Janssen', 'This is given to exceptional student writers within our school community to empower young writers and appoint them as official school writers. Scholarship recipients will undertake the editorial role assigned to them, actively participating in the creation, review, and publication of content for The Gazette. They will uphold the highest standards of journalistic integrity and professionalism.', 'Should pass the qualifying examinations & interviews conducted by the Selection Panel and must have an average grade of at least 83%.; Must not have failing grades for the past semester.; Must be a full- time student with regular unit load specified in the curriculum.', 'Certificate of Good Moral Character;Copy of Grades from MAMS ', '50% - 100%', 'Non-Merit', 5, '2024-10-20', '2024-12-31', 'active', '2024-09-12 12:57:44'),
(4, 'School Band Scholarship Program', 'Janssen', 'This program is designed to recognize and support outstanding students who excel in playing brass instruments and those who showcase their artistry through majorette and twirling performances. It aims to honor and empower a diverse range of young talents, fostering a deep appreciation for both musical and visual performance arts. The number of slots allotted should not exceed twenty (20) per semester.', 'Should pass the audition and interview by the Selection Panel (VP Administration, Band Master & Organization Adviser).; Must not have failing grades for the past semester.; Must be a full- time student with regular unit load specified in the curriculum.', 'Certificate of Enrollment from the Registrar;Certificate of Good Moral Character;Copy of Grades from MAMS ', '75% - 25%', 'Non-Merit', 6, '2024-10-20', '2024-12-31', 'active', '2024-09-12 12:59:25'),
(5, 'Philharmonics Scholarship Program', 'Janssen', 'This is designed to recognize and support talented individuals who contribute their vocal talents to the solemnity and spirituality of masses and other institutional activities. They form as the backbone of choral performances, enriching the cultural and spiritual life of our institution. The number of slots allotted should not exceed to twenty-one (21) per semester including the musicians', 'Should be endorsed by the Selection Panel (Chaplain, Lay Campus Minister, and Trainer) after the audition and interview.; Must not have failing grades for the past semester.; Must be a full- time student with regular unit load specified in the curriculum. ', 'Certificate of Good Moral Character;Copy of Grades from MAMS ;Class Schedule;Parent\'s Consent;Baptismal Certificate', '50%', 'Non-Merit', 7, '2024-10-20', '2024-12-31', 'active', '2024-09-12 13:04:56'),
(6, 'Entrance Scholarship Program', 'Janssen', 'This program is designed to provide an opportunity for exceptional scholars, whether in Junior High School (JHS), \r\nSenior High School (SHS), or College, to continue their educational journey in our institution\r\n', 'Applicants must have received the highest honors or distinctions in their previous school, attaining the top academic rank in their class.; Eligible students should be part of a graduating batch with a number of completers ranging from 49 \r\nto 100. ', 'Certificate of Good Moral Character;Copy of Grades from MAMS ;Form 137 ;The applicant must submit a certification of total completers/graduates from the School Principal, indicating Highest Honor (98-100%) or High Honor (95-97%)', '100% - Highest Honor with 100 Graduates; 50% - High Honor with below 100 Graduates', 'Non-Merit', 8, '2024-10-20', '2024-12-31', 'active', '2024-09-12 13:07:51'),
(7, 'Special College Scholarship Program  for  The Children of DWCC Security Force', 'All Campuses', 'This is is granted by the Administration to the children of DWCC Security Force Members in return to their loyalty and continuous service to the College. Aside from this, this Scholarship program aims to promote education as \r\nvehicle for the improvement of the socio- economic status of their families as well as to impart in them a Christian \r\nvalue system that will equip the students to be highly valuable, committed, and dedicated professionals of the future.\r\nThis scholarship program started school year 2015-2016.', 'Security Personnel who are working for at least five (5) consecutive years at DWCC and practicing Catholics may avail this Special Scholarship program.; Must be a full- time student with regular unit load specified in the curriculum.', 'Certificate of Good Moral Character;Copy of Grades from MAMS ', '50%', 'Non-Merit', 9, '2024-10-20', '2024-12-31', 'active', '2024-09-12 13:09:34'),
(8, 'Scholarship Program for Indigenous People ', 'Janssen', 'This is specifically tailored for members of cultural minority groups, is a vital and inclusive initiative that seeks to recognize, uplift, and empower individuals from indigenous communities. This program is dedicated to addressing \r\nthe unique challenges faced by these talented and promising individuals, with a focus on preserving cultural diversity, knowledge, and heritage while supporting their educational aspirations. The number of slots allotted should \r\nnot exceed sixty (60) per semester.', 'Applicants must belong to an indigenous community or cultural minority group, as recognized by relevant authorities or local organizations.; Must be a full- time student with regular unit load specified in the curriculum.', 'Certificate of Good Moral Character;Barangay Clearance;Certification from Non-Government Organizations (NGO) (e.g. Mangyan Mission);Report Card or transcript with a General Weighted Average (GWA) of at least 81% from the last school attended;Must come from a family with a monthly income not exceeding ₱ 12,000, as certified by the IP Commission or equivalent agency', '50%', 'Non-Merit', 10, '2024-10-20', '2024-12-31', 'active', '2024-09-12 13:12:23'),
(9, 'Student Assistant /Parish Stipendiary Scholarship Grant Program', 'Janssen', 'This is a unique and inclusive initiative designed to provide financial support and educational opportunities to \r\nstudents based on their economic status and their affiliation with a parish community. It aims to ensure that deserving \r\nstudents have access to quality education and the opportunity to contribute to both their personal growth and their communities. The number of slots is equivalent to the number of offices. If any office requires additional student \r\nassistants, they must submit a formal letter of request to the chairman of the scholarship committee, providing \r\njustifications.', 'Parish Stipendiary applicant should qualify for admission in Bachelor of Science in Secondary Education Major in Values Education program or any Allied courses in DWCC.; Student Assistant applicant should qualify for admission in any program in DWCC.; The applicant should pass the Entrance Exams, I.Q., and Personality Tests given by the DWCC Guidance.; The applicant should be a poor and deserving student.\r\n', 'Certificate of Good Moral Character;Certificate of Indigency;Class Schedule;Barangay Clearance;Copy of the latest Income Tax Return (ITR);Down payment of ₱ 1000.00 upon enrollment;Photocopy of electric and water bills for the last three months;References/s and/or recommendations from two (2) persons;Scholar should enroll a regular unit load specified in the curriculum;Parental consent addressed to the Scholarship Committee allowing the student to work at DWCC and should be submitted to the Administrative Office;Senior High School card with a general average of at least 83% for incoming freshmen, or MAMS grades with an average of at least 83%;Submit requirements only in the first semester, except for: down payment receipt, certificate of good moral character, class schedule copy, and MAMS grades printout', '100%', 'Non-Merit', 11, '2024-10-20', '2024-12-31', 'active', '2024-09-12 13:16:01'),
(10, 'Sports Scholarship Program', 'All Campuses', 'This program is dedicated to nurturing the talents of student-athletes, promoting teamwork, sportsmanship, and a passion for basketball and volleyball. It provides a platform for students to excel in both sports, representing our institution with pride and determination. By recognizing and supporting their remarkable abilities, the program fosters athletic growth and encourages a culture of individual excellence. Through dedicated training and high-level competition, students are empowered to develop their skills, experience personal growth, and achieve their full potential in these sports.', 'Should qualify for admission in any course at DWCC.; Should pass the Entrance Exam, IQ, and Personality Tests given by the DWCC Guidance and Testing Center.; Should be 18- 23 years old.; Should not have standing criminal records.; Should qualify in the Try- Out by the Selection Panel (Coach, College PE Instructor and one Representative from the Administration).', 'Certificate of Enrollment from the Registrar;Copy of Grades from MAMS ;Barangay Clearance;Police Clearance;Recent 1x1 ID photo (one copy);Medical Certificate: ECG, Drug Test, Pregnancy Test', '500% - Team Sports; 350% Individual Sports', 'Non-Merit', 12, '2024-10-20', '2024-12-31', 'active', '2024-09-12 13:19:58'),
(11, 'Cultural Scholarship Program', 'Janssen', 'This program is designed to recognize and support students who excel in the performing arts and cultural \r\nexpressions, enhancing the atmosphere of our school events and promoting a deep appreciation for culture and \r\ncreativity. It provides a platform for students to showcase their artistic talents during school events, contributing to \r\nthe cultural enrichment of our institution. The number of slots is thirty (30), with 10 slots allocated for each category.', 'Should qualify for admission in any course at DWCC.; Should pass the Entrance Exam, IQ, and Personality Tests given by the DWCC Guidance and Testing Center.; Should be endorsed by the Selection Panel (Trainer & Cultural Coordinator) after the audition and interview.', 'Certificate of Enrollment from the Registrar;Copy of Grades from MAMS ;Barangay Clearance;Police Clearance;Recent 1x1 ID photo (one copy);Medical Certificate: ECG, Drug Test, Pregnancy Test', '25%', 'Non-Merit', 13, '2024-10-20', '2024-12-31', 'active', '2024-09-12 13:22:41'),
(12, 'Scholarship for Persons with Disability (PWD)', 'All Campuses', 'This program is founded on the belief that every person, regardless of their physical or cognitive challenges, deserves access to quality education and the chance to reach their full potential. The scholarship is a testament of \r\ncommitment in promoting inclusivity and supporting the unique needs and talents of PWDs.', 'Applicants must provide verifiable evidence of their disability. ', 'PWD valid identification card', '20%', 'Non-Merit', 14, '2024-10-20', '2024-12-31', 'active', '2024-09-12 13:24:38'),
(13, 'Cash Discount', 'Janssen', 'This program offers an exclusive opportunity for students and their families to benefit from cash discounts as a token of gratitude for their prompt and complete financial commitment', 'Applicants made full payments for tuition, fees, or other educational expenses.', 'Receipt payment during the official enrolment period', '5%', 'Non-Merit', 15, '2024-10-20', '2024-12-31', 'active', '2024-09-12 13:28:41'),
(14, 'Brother/Sister Discount', 'All Campuses', 'This program reflects the commitment in promoting family values, inclusivity, and the importance of sibling relationships by offering financial incentives to families with more than one child attending our school.', 'Must have one sibling or more than that is concurrently enrolled in our institution.', 'NSO/PSA Birth Certificate;Submissions must be made through the Accounting Office during official enrollment ', '5%', 'Non-Merit', 16, '2024-10-20', '2024-12-31', 'active', '2024-09-12 13:30:27'),
(15, 'Faculty/Employee Privilege Discount', 'All Campuses', 'This program extends benefits to the families of our valued staff by offering tuition discounts for their dependents. \r\nThe program allows eligible employees to provide quality education to a maximum of two of their children, creating \r\na supportive and inclusive environment for our school community.', 'Employees must be in active employment with our institution.', 'NSO/PSA Birth Certificate;Certificate of Employment;Submissions must be made through the Accounting Office during official enrollment ', '100%', 'Non-Merit', 17, '2024-10-20', '2024-12-31', 'active', '2024-09-12 13:33:02'),
(16, 'Faculty/Employees Graduate Studies', 'All Campuses', 'This program is designed to assist our employees in pursuing graduate studies, enhancing their qualifications, and \r\nexpanding their knowledge and expertise in their respective fields. The importance of investing in our employees\' \r\ncontinued education to strengthen our institution\'s capabilities and promote lifelong learning.', 'Must have at least two (2) years of continuous service and satisfactory job performance based on the Performance Evaluation submitted by the immediate head.; Must have a satisfactory grade from his/her undergraduate (for Master’s degree applicants) and graduate degrees (for Doctorate degree applicants).; Performance rating 75%; Average/Grade 25%', 'Certificate of Employment;Recommendation letter from the immediate head;Letter of Intent addressed to the College President through the DWCC Human Resource Office', 'Permanent - 100% tuition fee for child; Probationary - 75% tuition fee for each child; Full Time - Contractual - 50% tuition fee for each child', 'Non-Merit', 18, '2024-10-20', '2024-12-31', 'active', '2024-09-12 13:37:20'),
(17, 'NSTP Scholarship Program', 'Janssen', 'This program is founded on the belief that community service and civic engagement are essential components of a \r\nholistic education. It provides financial support to students who have demonstrated commitment and excellence in \r\nNSTP-related activities.', 'Should pass the interview and qualify in the background investigation and ocular visit on applicant’s residence.; Should be endorsed by the NSTP Director and Vice President for Academic Affairs.; Must not have failing grades for the semester.; Scholar should enroll a regular unit load specified in the curriculum.; Must be freshmen enrolled in NSTP in this institution.; Must not receive any government scholarship grant.; Must be poor but deserving student with an average grade of EIGHTY percent (80%) in high school.', 'Certificate of Good Moral Character;Copy of Grades from MAMS ', '100%', 'Non-Merit', 16, '2024-10-20', '2024-12-31', 'active', '2024-09-12 13:39:46');

-- --------------------------------------------------------

--
-- Table structure for table `school_year`
--

CREATE TABLE `school_year` (
  `school_year_id` int(11) NOT NULL,
  `academic_year` varchar(9) NOT NULL,
  `year_status` enum('active','inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `school_year`
--

INSERT INTO `school_year` (`school_year_id`, `academic_year`, `year_status`) VALUES
(1, '2024-2025', 'inactive'),
(2, '2025-2026', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `semester`
--

CREATE TABLE `semester` (
  `semester_id` int(11) NOT NULL,
  `semester` enum('1st Semester','2nd Semester','Whole Semester') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `semester`
--

INSERT INTO `semester` (`semester_id`, `semester`) VALUES
(1, '1st Semester'),
(3, '2nd Semester'),
(2, 'Whole Semester');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `id_number` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `contact` char(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `birthdate` date DEFAULT NULL,
  `gender` enum('male','female') NOT NULL,
  `password` varchar(255) NOT NULL,
  `usertype` enum('Admin','TWC','Scholarship Coordinator') NOT NULL,
  `status` tinyint(1) DEFAULT 1,
  `user_photo` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `id_number`, `name`, `contact`, `email`, `birthdate`, `gender`, `password`, `usertype`, `status`, `user_photo`, `created_at`) VALUES
(1, 'A001', 'Admin', '09123456780', 'admin@gmail.com', '1990-01-05', 'male', '66f5b0a363ec5413c51c2785cd61e579', 'Admin', 1, '1_photo.png', '2024-09-05 09:27:14'),
(2, 'SC001', 'Scholarship Coodinator', '09123456781', 'dwcc-sms@gmail.com', '1990-02-14', 'female', '1bfe895c6878ef32f981ab8239a54c3d', 'Scholarship Coordinator', 1, 'SC_photo.png', '2024-09-05 09:32:04'),
(3, 'TWC001', 'TWC1', '09123456782', 'twc1@gmail.com', '1996-09-04', 'male', '3c5915ec253b0aa5e4b7328890cf2962', 'TWC', 1, '3_photo.png', '2024-09-05 09:33:45'),
(4, 'TWC002', 'TWC2', '09123456783', 'twc2@gmail.com', '1990-09-05', 'female', '293e631f6745d546a9383ae8352c0e51', 'TWC', 1, '', '2024-09-05 09:34:48'),
(5, 'TWC003', 'TWC3', '09123456784', 'twc3@gmail.com', '1996-12-11', 'female', '0c86f0ade55e83cffb94dec827f4a626', 'TWC', 1, '', '2024-09-05 09:49:51'),
(6, 'TWC004', 'TWC4', '09123456785', 'twc4@gmail.com', '1990-09-02', 'male', 'c8874012555bf45a9e63a3defef61324', 'TWC', 1, '', '2024-09-05 09:53:15'),
(7, 'TWC005', 'TWC5', '09123456786', 'twc5@gmail.com', '1990-06-05', 'female', '169fdd6b440050d53075e03f0e4d7a1a', 'TWC', 1, '', '2024-09-05 09:54:31'),
(8, 'TWC006', 'TWC6', '09123456787', 'twc6@gmail.com', '2001-07-05', 'male', '283cfc10b34d0289cae3e1a71ad80945', 'TWC', 1, '', '2024-09-05 09:59:10'),
(9, 'TWC007', 'TWC7', '09123456788', 'twc7@gmail.com', '1998-11-29', 'female', 'a70f11f76f3cfb81622fe7a29da8b6bc', 'TWC', 1, '', '2024-09-05 10:00:51'),
(10, 'TWC008', 'TWC8', '09123456789', 'twc8@gmail.com', '1990-02-11', 'female', '013fc6eeccba5f4ec6adce2d5715ff63', 'TWC', 1, '', '2024-09-05 10:09:28'),
(11, 'TWC009', 'TWC9', '09123456710', 'twc9@gmail.com', '2001-09-03', 'female', 'a13b3087490e52b10bf6b2028123745e', 'TWC', 1, '', '2024-09-05 10:13:22'),
(12, 'TWC010', 'TWC10', '09123456711', 'twc10@gmail.com', '1997-02-05', 'female', '01287255c3268be2b66fe7cf9cd9b021', 'TWC', 1, '', '2024-09-05 10:16:28'),
(13, 'TWC011', 'TWC11', '09123456712', 'twc11@gmail.com', '2000-08-05', 'male', 'aeeb785b142bb2b74a05540f5c5f8bba', 'TWC', 1, '', '2024-09-05 10:17:39'),
(14, 'TWC012', 'TWC12', '09123456713', 'twc12@gmail.com', '2002-04-05', 'female', '589853179cfef0f8659d5e85a5d33c12', 'TWC', 1, '', '2024-09-05 10:18:28'),
(15, 'TWC013', 'TWC13', '09123456714', 'twc13@gmail.com', '1990-04-05', 'female', '6459c229c3eedb34962237c532e744bd', 'TWC', 1, '', '2024-09-05 10:19:42'),
(16, 'TWC014', 'TWC14', '09123456715', 'twc14@gmail.com', '1990-12-23', 'female', '3771326e5a7bd6005c276978afb3404a', 'TWC', 1, '', '2024-09-05 10:20:26'),
(17, 'TWC015', 'TWC15', '09123456716', 'twc15@gmail.com', '2000-03-13', 'male', '2af57afed53a11c80a436b571bc16110', 'TWC', 1, '', '2024-09-05 10:21:10'),
(18, 'TWC016', 'TWC16', '09123456717', 'twc16@gmail.com', '2001-08-05', 'male', '506eaacd17c44e384399f85cfc2f4a0f', 'TWC', 1, '', '2024-09-05 10:21:39'),
(19, 'TWC017', 'TWC17', '09123456718', 'twc17@gmail.com', '1998-12-22', 'male', '3aa03f8481b3f90747d9e6fe0d5c5274', 'TWC', 1, '', '2024-09-05 10:22:15'),
(20, 'TWC018', 'TWC18', '09123456719', 'twc18@gmail.com', '2000-09-01', 'female', 'aa7b2d96d287131c2133b60c728e3174', 'TWC', 1, '', '2024-09-05 10:22:50');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `announcements`
--
ALTER TABLE `announcements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `applicants`
--
ALTER TABLE `applicants`
  ADD PRIMARY KEY (`account_no`),
  ADD KEY `fk_applicants_program` (`program`);

--
-- Indexes for table `application_form`
--
ALTER TABLE `application_form`
  ADD PRIMARY KEY (`applicant_no`),
  ADD KEY `account_no` (`account_no`),
  ADD KEY `fk_scholarship_program` (`scholarship_program`),
  ADD KEY `fk_academic_year` (`academic_year`),
  ADD KEY `fk_application_form_program` (`program`),
  ADD KEY `fk_application_form_semester` (`semester`);

--
-- Indexes for table `final_list`
--
ALTER TABLE `final_list`
  ADD PRIMARY KEY (`final_list_id`),
  ADD KEY `fk_applicant_no` (`applicant_no`);

--
-- Indexes for table `program`
--
ALTER TABLE `program`
  ADD PRIMARY KEY (`program_id`),
  ADD UNIQUE KEY `unique_program` (`program`);

--
-- Indexes for table `requirements`
--
ALTER TABLE `requirements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `scholarship_programs`
--
ALTER TABLE `scholarship_programs`
  ADD PRIMARY KEY (`program_code`),
  ADD UNIQUE KEY `program_unique` (`scholarship_program`,`campus`) USING BTREE,
  ADD KEY `fk_assigned_to_user` (`assigned_to`);

--
-- Indexes for table `school_year`
--
ALTER TABLE `school_year`
  ADD PRIMARY KEY (`school_year_id`),
  ADD UNIQUE KEY `academic_year` (`academic_year`);

--
-- Indexes for table `semester`
--
ALTER TABLE `semester`
  ADD PRIMARY KEY (`semester_id`),
  ADD UNIQUE KEY `semester` (`semester`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_number` (`id_number`),
  ADD UNIQUE KEY `contact` (`contact`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `announcements`
--
ALTER TABLE `announcements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `applicants`
--
ALTER TABLE `applicants`
  MODIFY `account_no` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `application_form`
--
ALTER TABLE `application_form`
  MODIFY `applicant_no` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `final_list`
--
ALTER TABLE `final_list`
  MODIFY `final_list_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `program`
--
ALTER TABLE `program`
  MODIFY `program_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `requirements`
--
ALTER TABLE `requirements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `scholarship_programs`
--
ALTER TABLE `scholarship_programs`
  MODIFY `program_code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `school_year`
--
ALTER TABLE `school_year`
  MODIFY `school_year_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `semester`
--
ALTER TABLE `semester`
  MODIFY `semester_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `applicants`
--
ALTER TABLE `applicants`
  ADD CONSTRAINT `fk_applicants_program` FOREIGN KEY (`program`) REFERENCES `program` (`program`) ON DELETE CASCADE;

--
-- Constraints for table `application_form`
--
ALTER TABLE `application_form`
  ADD CONSTRAINT `application_form_ibfk_1` FOREIGN KEY (`account_no`) REFERENCES `applicants` (`account_no`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_academic_year` FOREIGN KEY (`academic_year`) REFERENCES `school_year` (`academic_year`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_application_form_program` FOREIGN KEY (`program`) REFERENCES `program` (`program`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_application_form_semester` FOREIGN KEY (`semester`) REFERENCES `semester` (`semester`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_scholarship_program` FOREIGN KEY (`scholarship_program`) REFERENCES `scholarship_programs` (`scholarship_program`) ON DELETE CASCADE;

--
-- Constraints for table `final_list`
--
ALTER TABLE `final_list`
  ADD CONSTRAINT `fk_applicant_no` FOREIGN KEY (`applicant_no`) REFERENCES `application_form` (`applicant_no`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `scholarship_programs`
--
ALTER TABLE `scholarship_programs`
  ADD CONSTRAINT `fk_assigned_to_user` FOREIGN KEY (`assigned_to`) REFERENCES `users` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
