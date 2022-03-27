-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 27, 2022 at 05:57 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `be15_cr11_petadoption_katek`
--
CREATE DATABASE IF NOT EXISTS `be15_cr11_petadoption_katek` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `be15_cr11_petadoption_katek`;

-- --------------------------------------------------------

--
-- Table structure for table `animals`
--

CREATE TABLE `animals` (
  `animal_id` int(11) NOT NULL,
  `photo` varchar(250) NOT NULL,
  `location` varchar(50) NOT NULL,
  `description` varchar(250) NOT NULL,
  `size` varchar(50) NOT NULL,
  `age` int(11) NOT NULL,
  `hobbies` varchar(250) NOT NULL,
  `breed` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `animals`
--

INSERT INTO `animals` (`animal_id`, `photo`, `location`, `description`, `size`, `age`, `hobbies`, `breed`) VALUES
(1, '62407fed6b2b2.jpg', 'Wienerstrasse, 5', 'His name is Ben. Such a nice fluffy boi!', 'large', 4, 'Likes to play with a ball', 'Labrador'),
(2, '6240865f2e54a.jpg', 'Hartbergstrasse, 10', 'It is Tina. She likes to eat and sleep.', 'small', 9, 'As I said: sleep and eat :)', 'no breed'),
(3, '624086688d481.jpg', 'Meidlingstrasse, 35', 'It is Harry. He is a small chameleon.', 'small', 2, 'He likes to try out new outfits!', 'Chameleon'),
(4, '624086777fc55.jpg', 'Stephansstrasse, 1', 'It is Lui. He is a cool boi!', 'large', 10, 'Now he just wants to be a part of the family and always vibin.', 'German Shepherd'),
(5, '6240867f2f32a.jpg', 'Kepnerstrasse, 8', 'She is Kitty. Noice kitty!', 'small', 1, 'Play, play, sleep, repeat!', 'Munchkin'),
(6, '6240832e051ef.jpg', 'Linzstrasse, 40', 'Meet Bobby. He is a huge hamster!', 'small', 0, 'He likes to build a castles out of toilet paper and everything he sees around.', 'Hamster'),
(7, '6240831e7f1e4.png', 'Koglstrasse, 5', 'Say hello to the Mark! He is a cool birdie.', 'large', 4, 'Sing and look at himself in the mirror!', 'Parrot'),
(8, '62408687460b4.jpg', 'Innsbruckstrasse, 10', 'It is Molly. She is a cute degu :)', 'small', 0, 'She likes to jump around like crazy!', 'Degu'),
(9, '6240869119896.jpg', 'Mariastrasse, 2', 'Meet Chris, he is a beautiful doggo!', 'large', 10, 'He want to go to the walk and and eat smth tasty!', 'Australian Shepherd'),
(10, '624086b0bb003.jpeg', 'Katestrasse, 11', 'Chonky, just a big good Chonky :)', 'large', 9, 'Eat, sleep, eat, eat, play :)', 'Pug');

-- --------------------------------------------------------

--
-- Table structure for table `pet_adoption`
--

CREATE TABLE `pet_adoption` (
  `fk_user_id` int(11) NOT NULL,
  `fk_animal_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pet_adoption`
--

INSERT INTO `pet_adoption` (`fk_user_id`, `fk_animal_id`) VALUES
(6, 1),
(6, 3),
(6, 6);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `users_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone_number` int(20) NOT NULL,
  `address` varchar(50) NOT NULL,
  `picture` varchar(250) NOT NULL,
  `password` varchar(550) NOT NULL,
  `status` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`users_id`, `first_name`, `last_name`, `email`, `phone_number`, `address`, `picture`, `password`, `status`) VALUES
(5, 'Admin', 'Admin', 'admin@admin.com', 123456, 'Adminstrasse, 1', 'avatar.png', '25f43b1486ad95a1398e3eeb3d83bc4010015fcc9bedb35b432e00298d5021f7', 'adm'),
(6, 'User', 'User', 'user@user.com', 123456, 'Userstrasse, 1', '624082f257574.jpg', 'e606e38b0d8c19b24cf0ee3808183162ea7cd63ff7912dbb22b5e803286b4446', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `animals`
--
ALTER TABLE `animals`
  ADD PRIMARY KEY (`animal_id`);

--
-- Indexes for table `pet_adoption`
--
ALTER TABLE `pet_adoption`
  ADD PRIMARY KEY (`fk_user_id`,`fk_animal_id`),
  ADD KEY `fk_animal_id` (`fk_animal_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`users_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `animals`
--
ALTER TABLE `animals`
  MODIFY `animal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `users_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pet_adoption`
--
ALTER TABLE `pet_adoption`
  ADD CONSTRAINT `pet_adoption_ibfk_1` FOREIGN KEY (`fk_user_id`) REFERENCES `users` (`users_id`),
  ADD CONSTRAINT `pet_adoption_ibfk_2` FOREIGN KEY (`fk_animal_id`) REFERENCES `animals` (`animal_id`),
  ADD CONSTRAINT `pet_adoption_ibfk_3` FOREIGN KEY (`fk_user_id`) REFERENCES `users` (`users_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
