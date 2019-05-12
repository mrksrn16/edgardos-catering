-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 12, 2019 at 01:08 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `edgardos-catering`
--

-- --------------------------------------------------------

--
-- Table structure for table `foods`
--

CREATE TABLE `foods` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `price` float NOT NULL,
  `description` text NOT NULL,
  `category` varchar(50) NOT NULL,
  `image` varchar(50) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `foods`
--

INSERT INTO `foods` (`id`, `name`, `price`, `description`, `category`, `image`, `date`) VALUES
(3, 'Lemon iced tea', 100, 'description here', 'Drinks', 'iced_tea.jpg', '0000-00-00'),
(4, 'Fish fillet', 200, 'Desc here', 'Fish', 'fist_fillet.jpg', '0000-00-00'),
(5, 'Carbonara', 500, 'Desc here', 'Pasta', 'carbonara.jpg', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `motifs`
--

CREATE TABLE `motifs` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `details` text NOT NULL,
  `price` int(11) DEFAULT NULL,
  `foods` text,
  `image` varchar(50) DEFAULT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`id`, `name`, `details`, `price`, `foods`, `image`, `date`) VALUES
(3, 'PACKAGE 1 ( 300 PER HEAD)', 'Free:<br />\r\n3x4 tarpaulin<br />\r\n1 round layer cakE<br />\r\n', 300, 'Fish fillet,Carbonara,Lemon iced tea', 'logo.png', '2019-01-27'),
(4, 'PACKAGE 2 (350 PER HEAD)', 'Free:<br />\r\n2 round layer cake<br />\r\n3x4 tarpaulin<br />\r\n', 350, 'Lemon iced tea', 'logo1.png', '2019-01-27'),
(5, 'PACKAGE 3 ( 400 PER HEAD)', 'Free:<br />\r\n2 round layer cake<br />\r\n3x4 tarpaulin<br />\r\n1 bottled of wine<br />\r\n', 400, 'Carbonara', 'logo2.png', '2019-01-27'),
(6, 'PACKAGE 4 ( 450 PER HEAD)', 'Free:<br />\r\n2 round fondant cake<br />\r\n3x4 tarpaulin<br />\r\n2 battled of red wine<br />\r\n', 450, 'Fish fillet', 'logo3.png', '2019-01-27'),
(7, 'PACKAGE 5 ( 500 PER HEAD)', 'Free:<br />\r\n3 fondant layer cake<br />\r\n3 bottled of red wine<br />\r\n3x tarpaulin<br />\r\n', 500, 'Fish fillet,Carbonara', 'logo4.png', '2019-01-27'),
(8, 'AMENITIES', 'Grand Stage designs<br />\nRed Carpet<br />\nCocktail flower arrangement<br />\nBuffet table with elegant set up<br />\nOverall top chafing dish<br />\nBuffet service following the menu of your choice<br />\n10  seater round table with table cloth and fresh floral design<br />\nTable number in each table<br />\nMonoblock chairs with cover for the guest<br />\nGlasses for juice or sufficient ice for drinks<br />\nWe serve unlimited rice<br />\nMineral water<br />\nGift table / Decorative cake table/ Registration table<br />\nWell trained waiters for the uniforms<br />\nFood attendant<br />\nAdditional:<br />\nTiffany chair 					100 each<br />\nSounds and light with projector			Php 5,000<br />\nPhotoboth for 2 hRs				Php 2000<br />\nEmcee	Php 2000<br />\nPhoto and video 				PHp 15000<br />\n', NULL, NULL, 'logo5.png', '2019-01-27');

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE `schedules` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `venue` varchar(50) NOT NULL,
  `event_date` datetime NOT NULL,
  `event_time` time NOT NULL,
  `motif` text,
  `occasion` varchar(50) DEFAULT NULL,
  `no_guests` int(11) NOT NULL,
  `package` int(11) DEFAULT NULL,
  `additionals` text,
  `additional_foods` text,
  `additional_foods_total` int(11) DEFAULT NULL,
  `event_type` int(11) NOT NULL,
  `service_style` varchar(50) NOT NULL,
  `team` varchar(50) DEFAULT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'pending',
  `total` int(11) NOT NULL,
  `date` date NOT NULL,
  `feedback` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `schedules`
--

INSERT INTO `schedules` (`id`, `user_id`, `venue`, `event_date`, `event_time`, `motif`, `occasion`, `no_guests`, `package`, `additionals`, `additional_foods`, `additional_foods_total`, `event_type`, `service_style`, `team`, `status`, `total`, `date`, `feedback`) VALUES
(6, 1, 'Valenzuela', '2019-05-01 00:00:00', '10:00:00', 'Blue and white', NULL, 100, 3, 'Sounds and light with projector', '4', 20000, 10, 'Plated service', 'Team A', 'archived', 55000, '2019-03-04', NULL),
(7, 1, 'Valenzuela', '2019-03-11 00:00:00', '10:11:00', 'Red and black', NULL, 101, 4, 'Sounds and light with projector,Photoboth for 2 hRs', '4,5', 70700, 10, 'Family or lauriat,Buffet', NULL, 'accepted', 113050, '2019-03-12', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `name`, `description`, `image`) VALUES
(10, 'Birthday', 'Desc here', 'logo.png'),
(11, 'Debut', 'Desc here', 'logo1.png'),
(12, 'Wedding', 'Desc here', 'logo2.png'),
(13, 'Anniversary', 'Desc here', 'logo3.png'),
(14, 'Baptismal', 'Desc here', 'logo4.png'),
(15, 'Family Events', 'Desc here', 'logo5.png'),
(16, 'Corporate Events', 'Desc here', 'logo6.png'),
(17, 'Meeting/Seminar', 'Desc here', 'logo7.png'),
(18, 'Other Social Events', 'Desc here', 'logo71.png'),
(19, 'Occasion Motif', 'desc here', 'logo8.png'),
(20, 'Occasion Motif', 'desc here', 'logo9.png');

-- --------------------------------------------------------

--
-- Table structure for table `services_gallery`
--

CREATE TABLE `services_gallery` (
  `id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `image` varchar(100) NOT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `members` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`id`, `name`, `members`) VALUES
(3, 'Team A', 'Member 1<br />\r\nMember 2<br />\r\nMember 3'),
(4, 'Team B', 'Member 1<br />\r\nMember 2<br />\r\nMember 3'),
(5, 'Team C', 'Member 1<br />\r\nMember 2<br />\r\nMember 3');

-- --------------------------------------------------------

--
-- Table structure for table `user_accounts`
--

CREATE TABLE `user_accounts` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` varchar(50) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_accounts`
--

INSERT INTO `user_accounts` (`id`, `username`, `password`, `role`, `status`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'superadmin', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `contact` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`id`, `user_id`, `firstname`, `lastname`, `email`, `address`, `contact`) VALUES
(1, 1, 'Admin', 'Lastname', 'markerwin.serna@gmail.com', 'Meyc', '09111111111');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `foods`
--
ALTER TABLE `foods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `motifs`
--
ALTER TABLE `motifs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services_gallery`
--
ALTER TABLE `services_gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_accounts`
--
ALTER TABLE `user_accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `foods`
--
ALTER TABLE `foods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `motifs`
--
ALTER TABLE `motifs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `services_gallery`
--
ALTER TABLE `services_gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `user_accounts`
--
ALTER TABLE `user_accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
