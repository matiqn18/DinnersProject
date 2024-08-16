-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 16, 2024 at 10:38 AM
-- Wersja serwera: 10.4.32-MariaDB
-- Wersja PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `obiadki`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `admin_panels`
--

CREATE TABLE `admin_panels` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `startdate` date DEFAULT NULL,
  `enddate` date DEFAULT NULL,
  `price` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_panels`
--

INSERT INTO `admin_panels` (`id`, `name`, `startdate`, `enddate`, `price`) VALUES
(0, 'MealPrice', '2024-01-01', '2024-12-31', 20);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `class`
--

CREATE TABLE `class` (
  `id_class` int(11) NOT NULL,
  `name` varchar(5) NOT NULL,
  `available` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`id_class`, `name`, `available`) VALUES
(1, 'SP_1a', 1),
(2, 'SP_1b', 1),
(3, 'SP_1c', 1),
(4, 'SP_2a', 1),
(5, 'SP_1d', 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `meals`
--

CREATE TABLE `meals` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `meals`
--

INSERT INTO `meals` (`id`, `user_id`, `menu_id`) VALUES
(13, 9, 845),
(20, 2, 844),
(21, 2, 845);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `available` tinyint(1) NOT NULL,
  `ingredients` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `date`, `available`, `ingredients`) VALUES
(690, '2024-01-01', 0, ''),
(691, '2024-01-02', 0, ''),
(692, '2024-01-03', 0, ''),
(693, '2024-01-04', 0, ''),
(694, '2024-01-05', 0, ''),
(695, '2024-01-08', 0, ''),
(696, '2024-01-09', 0, ''),
(697, '2024-01-10', 0, ''),
(698, '2024-01-11', 0, ''),
(699, '2024-01-12', 0, ''),
(700, '2024-01-15', 0, ''),
(701, '2024-01-16', 0, ''),
(702, '2024-01-17', 0, ''),
(703, '2024-01-18', 0, ''),
(704, '2024-01-19', 0, ''),
(705, '2024-01-22', 0, ''),
(706, '2024-01-23', 0, ''),
(707, '2024-01-24', 0, ''),
(708, '2024-01-25', 0, ''),
(709, '2024-01-26', 0, ''),
(710, '2024-01-29', 0, ''),
(711, '2024-01-30', 0, ''),
(712, '2024-01-31', 0, ''),
(713, '2024-02-01', 0, ''),
(714, '2024-02-02', 0, ''),
(715, '2024-02-05', 0, ''),
(716, '2024-02-06', 0, ''),
(717, '2024-02-07', 0, ''),
(718, '2024-02-08', 0, ''),
(719, '2024-02-09', 0, ''),
(720, '2024-02-12', 0, ''),
(721, '2024-02-13', 0, ''),
(722, '2024-02-14', 0, ''),
(723, '2024-02-15', 0, ''),
(724, '2024-02-16', 0, ''),
(725, '2024-02-19', 0, ''),
(726, '2024-02-20', 0, ''),
(727, '2024-02-21', 0, ''),
(728, '2024-02-22', 0, ''),
(729, '2024-02-23', 0, ''),
(730, '2024-02-26', 0, ''),
(731, '2024-02-27', 0, ''),
(732, '2024-02-28', 0, ''),
(733, '2024-02-29', 0, ''),
(734, '2024-03-01', 0, ''),
(735, '2024-03-04', 0, ''),
(736, '2024-03-05', 0, ''),
(737, '2024-03-06', 0, ''),
(738, '2024-03-07', 0, ''),
(739, '2024-03-08', 0, ''),
(740, '2024-03-11', 0, ''),
(741, '2024-03-12', 0, ''),
(742, '2024-03-13', 0, ''),
(743, '2024-03-14', 0, ''),
(744, '2024-03-15', 0, ''),
(745, '2024-03-18', 0, ''),
(746, '2024-03-19', 0, ''),
(747, '2024-03-20', 0, ''),
(748, '2024-03-21', 0, ''),
(749, '2024-03-22', 0, ''),
(750, '2024-03-25', 0, ''),
(751, '2024-03-26', 0, ''),
(752, '2024-03-27', 0, ''),
(753, '2024-03-28', 0, ''),
(754, '2024-03-29', 0, ''),
(755, '2024-04-01', 0, ''),
(756, '2024-04-02', 0, ''),
(757, '2024-04-03', 0, ''),
(758, '2024-04-04', 0, ''),
(759, '2024-04-05', 0, ''),
(760, '2024-04-08', 0, ''),
(761, '2024-04-09', 0, ''),
(762, '2024-04-10', 0, ''),
(763, '2024-04-11', 0, ''),
(764, '2024-04-12', 0, ''),
(765, '2024-04-15', 0, ''),
(766, '2024-04-16', 0, ''),
(767, '2024-04-17', 0, ''),
(768, '2024-04-18', 0, ''),
(769, '2024-04-19', 0, ''),
(770, '2024-04-22', 0, ''),
(771, '2024-04-23', 0, ''),
(772, '2024-04-24', 0, ''),
(773, '2024-04-25', 0, ''),
(774, '2024-04-26', 0, ''),
(775, '2024-04-29', 0, ''),
(776, '2024-04-30', 0, ''),
(777, '2024-05-01', 0, ''),
(778, '2024-05-02', 0, ''),
(779, '2024-05-03', 0, ''),
(780, '2024-05-06', 0, ''),
(781, '2024-05-07', 0, ''),
(782, '2024-05-08', 0, ''),
(783, '2024-05-09', 0, ''),
(784, '2024-05-10', 0, ''),
(785, '2024-05-13', 0, ''),
(786, '2024-05-14', 0, ''),
(787, '2024-05-15', 0, ''),
(788, '2024-05-16', 0, ''),
(789, '2024-05-17', 0, ''),
(790, '2024-05-20', 0, ''),
(791, '2024-05-21', 0, ''),
(792, '2024-05-22', 0, ''),
(793, '2024-05-23', 0, ''),
(794, '2024-05-24', 0, ''),
(795, '2024-05-27', 0, ''),
(796, '2024-05-28', 0, ''),
(797, '2024-05-29', 0, ''),
(798, '2024-05-30', 0, ''),
(799, '2024-05-31', 0, ''),
(800, '2024-06-03', 0, ''),
(801, '2024-06-04', 0, ''),
(802, '2024-06-05', 0, ''),
(803, '2024-06-06', 0, ''),
(804, '2024-06-07', 0, ''),
(805, '2024-06-10', 0, ''),
(806, '2024-06-11', 0, ''),
(807, '2024-06-12', 0, ''),
(808, '2024-06-13', 0, ''),
(809, '2024-06-14', 0, ''),
(810, '2024-06-17', 0, ''),
(811, '2024-06-18', 0, ''),
(812, '2024-06-19', 0, ''),
(813, '2024-06-20', 0, ''),
(814, '2024-06-21', 0, ''),
(815, '2024-06-24', 0, ''),
(816, '2024-06-25', 0, ''),
(817, '2024-06-26', 0, ''),
(818, '2024-06-27', 0, ''),
(819, '2024-06-28', 0, ''),
(820, '2024-07-01', 0, ''),
(821, '2024-07-02', 0, ''),
(822, '2024-07-03', 0, ''),
(823, '2024-07-04', 0, ''),
(824, '2024-07-05', 0, ''),
(825, '2024-07-08', 0, ''),
(826, '2024-07-09', 0, ''),
(827, '2024-07-10', 0, ''),
(828, '2024-07-11', 0, ''),
(829, '2024-07-12', 0, ''),
(830, '2024-07-15', 0, ''),
(831, '2024-07-16', 0, ''),
(832, '2024-07-17', 0, ''),
(833, '2024-07-18', 0, ''),
(834, '2024-07-19', 0, ''),
(835, '2024-07-22', 0, ''),
(836, '2024-07-23', 0, ''),
(837, '2024-07-24', 0, ''),
(838, '2024-07-25', 0, ''),
(839, '2024-07-26', 0, ''),
(840, '2024-07-29', 0, ''),
(841, '2024-07-30', 0, ''),
(842, '2024-07-31', 0, ''),
(843, '2024-08-01', 0, ''),
(844, '2024-08-02', 0, 'Kotlet schabowy z ziemniakami i mizerią'),
(845, '2024-08-05', 1, 'Pizza'),
(846, '2024-08-06', 0, ''),
(847, '2024-08-07', 0, ''),
(848, '2024-08-08', 0, ''),
(849, '2024-08-09', 0, ''),
(850, '2024-08-12', 0, ''),
(851, '2024-08-13', 0, ''),
(852, '2024-08-14', 0, ''),
(853, '2024-08-15', 0, ''),
(854, '2024-08-16', 0, ''),
(855, '2024-08-19', 0, ''),
(856, '2024-08-20', 0, ''),
(857, '2024-08-21', 0, ''),
(858, '2024-08-22', 0, ''),
(859, '2024-08-23', 0, ''),
(860, '2024-08-26', 0, ''),
(861, '2024-08-27', 0, ''),
(862, '2024-08-28', 0, ''),
(863, '2024-08-29', 0, ''),
(864, '2024-08-30', 0, ''),
(865, '2024-09-02', 0, ''),
(866, '2024-09-03', 0, ''),
(867, '2024-09-04', 0, ''),
(868, '2024-09-05', 0, ''),
(869, '2024-09-06', 0, ''),
(870, '2024-09-09', 0, ''),
(871, '2024-09-10', 0, ''),
(872, '2024-09-11', 0, ''),
(873, '2024-09-12', 0, ''),
(874, '2024-09-13', 0, ''),
(875, '2024-09-16', 0, ''),
(876, '2024-09-17', 0, ''),
(877, '2024-09-18', 0, ''),
(878, '2024-09-19', 0, ''),
(879, '2024-09-20', 0, ''),
(880, '2024-09-23', 0, ''),
(881, '2024-09-24', 0, ''),
(882, '2024-09-25', 0, ''),
(883, '2024-09-26', 0, ''),
(884, '2024-09-27', 0, ''),
(885, '2024-09-30', 0, ''),
(886, '2024-10-01', 0, ''),
(887, '2024-10-02', 0, ''),
(888, '2024-10-03', 0, ''),
(889, '2024-10-04', 0, ''),
(890, '2024-10-07', 0, ''),
(891, '2024-10-08', 0, ''),
(892, '2024-10-09', 0, ''),
(893, '2024-10-10', 0, ''),
(894, '2024-10-11', 0, ''),
(895, '2024-10-14', 0, ''),
(896, '2024-10-15', 0, ''),
(897, '2024-10-16', 0, ''),
(898, '2024-10-17', 0, ''),
(899, '2024-10-18', 0, ''),
(900, '2024-10-21', 0, ''),
(901, '2024-10-22', 0, ''),
(902, '2024-10-23', 0, ''),
(903, '2024-10-24', 0, ''),
(904, '2024-10-25', 0, ''),
(905, '2024-10-28', 0, ''),
(906, '2024-10-29', 0, ''),
(907, '2024-10-30', 0, ''),
(908, '2024-10-31', 0, ''),
(909, '2024-11-01', 0, ''),
(910, '2024-11-04', 0, ''),
(911, '2024-11-05', 0, ''),
(912, '2024-11-06', 0, ''),
(913, '2024-11-07', 0, ''),
(914, '2024-11-08', 0, ''),
(915, '2024-11-11', 0, ''),
(916, '2024-11-12', 0, ''),
(917, '2024-11-13', 0, ''),
(918, '2024-11-14', 0, ''),
(919, '2024-11-15', 0, ''),
(920, '2024-11-18', 0, ''),
(921, '2024-11-19', 0, ''),
(922, '2024-11-20', 0, ''),
(923, '2024-11-21', 0, ''),
(924, '2024-11-22', 0, ''),
(925, '2024-11-25', 0, ''),
(926, '2024-11-26', 0, ''),
(927, '2024-11-27', 0, ''),
(928, '2024-11-28', 0, ''),
(929, '2024-11-29', 0, ''),
(930, '2024-12-02', 0, ''),
(931, '2024-12-03', 0, ''),
(932, '2024-12-04', 0, ''),
(933, '2024-12-05', 0, ''),
(934, '2024-12-06', 0, ''),
(935, '2024-12-09', 0, ''),
(936, '2024-12-10', 0, ''),
(937, '2024-12-11', 0, ''),
(938, '2024-12-12', 0, ''),
(939, '2024-12-13', 0, ''),
(940, '2024-12-16', 0, ''),
(941, '2024-12-17', 0, ''),
(942, '2024-12-18', 0, ''),
(943, '2024-12-19', 0, ''),
(944, '2024-12-20', 0, ''),
(945, '2024-12-23', 0, ''),
(946, '2024-12-24', 0, ''),
(947, '2024-12-25', 0, ''),
(948, '2024-12-26', 0, ''),
(949, '2024-12-27', 0, ''),
(950, '2024-12-30', 0, '');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `payments`
--

CREATE TABLE `payments` (
  `payment_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `payment_amount` float NOT NULL,
  `payment_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`payment_id`, `user_id`, `payment_amount`, `payment_date`) VALUES
(5, 2, 50, '2024-08-01'),
(6, 9, 1000000, '2024-08-01');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `surname` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `class_id` int(11) DEFAULT NULL,
  `role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `name`, `surname`, `email`, `password`, `class_id`, `role`) VALUES
(1, 'testowy', NULL, NULL, '12@12.pl', '$2y$10$CousDODFbqGHpvTnrywZpu0r.cd52Zs0Kp52gUb1uBfQpKLZBiphC', NULL, 0),
(2, 'testowy2', 'abc', NULL, '12@123.p1', '$2y$10$oj5MyaI3y2YvphxHChD.4OWVm7BNmcQE7gP5l018LF2g1NzWhY9De', 1, 2),
(3, 'testowy3', NULL, NULL, '21@21.pl', '$2y$10$PsWA9g1W8BG3S9IowqiQWOON83oyI3iL.IeFC0Sj676MbPiOnq/vS', NULL, 1),
(4, 'maciek', NULL, NULL, 'mac.pal@protonmail.com', '$2y$10$AsheZLSYY76tSF1xvo32BeliAHs8OglDQK4aTceyijiE4vmK85i7i', NULL, 1),
(9, 'Cat', 'Kasia', 'Miecz', 'Kasia@cat.cat', '$2y$10$G8fGqkuImboTJnTQtWdlsuCZ.fYJwrYFrsti9Bl49zkYQFEHDC0e6', 1, 2);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `admin_panels`
--
ALTER TABLE `admin_panels`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`id_class`);

--
-- Indeksy dla tabeli `meals`
--
ALTER TABLE `meals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `menu_id` (`menu_id`);

--
-- Indeksy dla tabeli `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_class_id` (`class_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `id_class` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `meals`
--
ALTER TABLE `meals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=951;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `meals`
--
ALTER TABLE `meals`
  ADD CONSTRAINT `meals_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `meals_ibfk_2` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`id`);

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_class_id` FOREIGN KEY (`class_id`) REFERENCES `class` (`id_class`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
