-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: mysql:3306
-- Generation Time: Sep 20, 2023 at 09:38 PM
-- Server version: 8.0.27
-- PHP Version: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pastpc`
--
CREATE DATABASE IF NOT EXISTS `pastpc` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `pastpc`;

-- --------------------------------------------------------

--
-- Table structure for table `carclassification`
--

CREATE TABLE `carclassification` (
  `classificationId` int NOT NULL,
  `classificationName` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `carclassification`
--

INSERT INTO `carclassification` (`classificationId`, `classificationName`) VALUES
(1, 'SUV'),
(2, 'Classic'),
(3, 'Sports'),
(4, 'Trucks'),
(5, 'Used'),
(22, 'EV'),
(23, 'Monster');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `clientId` int UNSIGNED NOT NULL,
  `clientFirstname` varchar(15) NOT NULL,
  `clientLastname` varchar(25) NOT NULL,
  `clientEmail` varchar(40) NOT NULL,
  `clientPassword` varchar(255) NOT NULL,
  `clientLevel` enum('1','2','3') NOT NULL DEFAULT '1',
  `comment` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`clientId`, `clientFirstname`, `clientLastname`, `clientEmail`, `clientPassword`, `clientLevel`, `comment`) VALUES
(5, 'Dave', 'Bibbins', 'davb@gmail.com', '$2y$10$zi.e8CExIH.q/0dln8FSjevrk8bfB6FuY7waaCZkSc7e.CcHrrbzK', '1', NULL),
(6, 'fafsa', 'fsfsfd', 'fs@gmail.com', '$2y$10$fPm1YchpuPnvstfxTAJSOOUe1gN04CHJxnmplaMkdnmXis08JPj/q', '1', NULL),
(7, 'Admin3', 'User', 'admin@cse340.net', '$2y$10$qt13/V.ybvkUKIySPVjw8.aC7SqNVcS5G/1zSQ8Ac0IxsQMC/ARPi', '3', NULL),
(8, 'Joe', 'Bob', 'jb@gmail.com', '$2y$10$E8gOhwXDq5PUTrFaiKzlGOYrkgTBJ8.3iwajQ.nMOAqebLaMjGVwW', '1', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `imgId` int NOT NULL,
  `invId` int NOT NULL,
  `imgName` varchar(100) NOT NULL,
  `imgPath` varchar(150) NOT NULL,
  `imgDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `imgPrimary` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`imgId`, `invId`, `imgName`, `imgPath`, `imgDate`, `imgPrimary`) VALUES
(13, 13, 'aerocar.jpg', '/pastpc/images/vehicles/aerocar.jpg', '2023-03-24 21:15:33', 1),
(14, 13, 'aerocar-tn.jpg', '/pastpc/images/vehicles/aerocar-tn.jpg', '2023-03-24 21:15:33', 1),
(15, 6, 'bat.jpg', '/pastpc/images/vehicles/bat.jpg', '2023-03-24 21:16:29', 1),
(16, 6, 'bat-tn.jpg', '/pastpc/images/vehicles/bat-tn.jpg', '2023-03-24 21:16:29', 1),
(17, 10, 'camaro.jpg', '/pastpc/images/vehicles/camaro.jpg', '2023-03-24 21:16:51', 1),
(18, 10, 'camaro-tn.jpg', '/pastpc/images/vehicles/camaro-tn.jpg', '2023-03-24 21:16:51', 1),
(19, 9, 'crown-vic.jpg', '/pastpc/images/vehicles/crown-vic.jpg', '2023-03-24 21:17:15', 1),
(20, 9, 'crown-vic-tn.jpg', '/pastpc/images/vehicles/crown-vic-tn.jpg', '2023-03-24 21:17:15', 1),
(21, 11, 'escalade.jpg', '/pastpc/images/vehicles/escalade.jpg', '2023-03-24 21:17:47', 1),
(22, 11, 'escalade-tn.jpg', '/pastpc/images/vehicles/escalade-tn.jpg', '2023-03-24 21:17:47', 1),
(23, 14, 'fbi.jpg', '/pastpc/images/vehicles/fbi.jpg', '2023-03-24 21:18:10', 1),
(24, 14, 'fbi-tn.jpg', '/pastpc/images/vehicles/fbi-tn.jpg', '2023-03-24 21:18:10', 1),
(25, 8, 'fire-truck.jpg', '/pastpc/images/vehicles/fire-truck.jpg', '2023-03-24 21:18:27', 1),
(26, 8, 'fire-truck-tn.jpg', '/pastpc/images/vehicles/fire-truck-tn.jpg', '2023-03-24 21:18:27', 1),
(27, 2, 'ford-modelt.jpg', '/pastpc/images/vehicles/ford-modelt.jpg', '2023-03-24 21:18:46', 1),
(28, 2, 'ford-modelt-tn.jpg', '/pastpc/images/vehicles/ford-modelt-tn.jpg', '2023-03-24 21:18:46', 1),
(29, 12, 'hummer.jpg', '/pastpc/images/vehicles/hummer.jpg', '2023-03-24 21:19:16', 1),
(30, 12, 'hummer-tn.jpg', '/pastpc/images/vehicles/hummer-tn.jpg', '2023-03-24 21:19:16', 1),
(31, 1, 'jeep-wrangler.jpg', '/pastpc/images/vehicles/jeep-wrangler.jpg', '2023-03-24 21:19:38', 1),
(32, 1, 'jeep-wrangler-tn.jpg', '/pastpc/images/vehicles/jeep-wrangler-tn.jpg', '2023-03-24 21:19:38', 1),
(33, 3, 'lambo-Adve.jpg', '/pastpc/images/vehicles/lambo-Adve.jpg', '2023-03-24 21:19:56', 1),
(34, 3, 'lambo-Adve-tn.jpg', '/pastpc/images/vehicles/lambo-Adve-tn.jpg', '2023-03-24 21:19:56', 1),
(35, 7, 'mm.jpg', '/pastpc/images/vehicles/mm.jpg', '2023-03-24 21:20:26', 1),
(36, 7, 'mm-tn.jpg', '/pastpc/images/vehicles/mm-tn.jpg', '2023-03-24 21:20:26', 1),
(37, 4, 'monster.jpg', '/pastpc/images/vehicles/monster.jpg', '2023-03-24 21:20:45', 1),
(38, 4, 'monster-tn.jpg', '/pastpc/images/vehicles/monster-tn.jpg', '2023-03-24 21:20:45', 1),
(39, 5, 'ms.jpg', '/pastpc/images/vehicles/ms.jpg', '2023-03-24 21:21:11', 1),
(40, 5, 'ms-tn.jpg', '/pastpc/images/vehicles/ms-tn.jpg', '2023-03-24 21:21:11', 1),
(41, 20, 'delorean.jpg', '/pastpc/images/vehicles/delorean.jpg', '2023-03-24 21:24:16', 1),
(42, 20, 'delorean-tn.jpg', '/pastpc/images/vehicles/delorean-tn.jpg', '2023-03-24 21:24:16', 1),
(45, 2, 'bw-modelt.jpg', '/pastpc/images/vehicles/bw-modelt.jpg', '2023-03-24 22:17:38', 0),
(46, 2, 'bw-modelt-tn.jpg', '/pastpc/images/vehicles/bw-modelt-tn.jpg', '2023-03-24 22:17:38', 0),
(47, 20, 'movieset-delorean.jpg', '/pastpc/images/vehicles/movieset-delorean.jpg', '2023-03-24 22:18:13', 0),
(48, 20, 'movieset-delorean-tn.jpg', '/pastpc/images/vehicles/movieset-delorean-tn.jpg', '2023-03-24 22:18:13', 0),
(49, 10, 'racing-camaro.jpg', '/pastpc/images/vehicles/racing-camaro.jpg', '2023-03-24 22:18:37', 0),
(50, 10, 'racing-camaro-tn.jpg', '/pastpc/images/vehicles/racing-camaro-tn.jpg', '2023-03-24 22:18:37', 0),
(53, 15, 'no-image.png', '/pastpc/images/vehicles/no-image.png', '2023-03-24 23:15:19', 1),
(54, 15, 'no-image-tn.png', '/pastpc/images/vehicles/no-image-tn.png', '2023-03-24 23:15:19', 1);

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `invId` int NOT NULL,
  `invMake` varchar(30) NOT NULL,
  `invModel` varchar(30) NOT NULL,
  `invDescription` text NOT NULL,
  `invImage` varchar(50) NOT NULL,
  `invThumbnail` varchar(50) NOT NULL,
  `invPrice` decimal(10,0) NOT NULL,
  `invStock` smallint NOT NULL,
  `invColor` varchar(20) NOT NULL,
  `classificationId` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`invId`, `invMake`, `invModel`, `invDescription`, `invImage`, `invThumbnail`, `invPrice`, `invStock`, `invColor`, `classificationId`) VALUES
(1, 'Jeep', 'Wrangler', 'The Jeep Wrangler is small and compact with enough power to get you where you want to go. It is great for everyday driving as well as off-roading whether that be on the rocks or in the mud!', '/pastpc/images/vehicles/jeep-wrangler.jpg', '/pastpc/images/vehicles/jeep-wrangler-tn.jpg', '28045', 1, 'Orange', 1),
(2, 'Ford', 'Model T', 'The Ford Model T can be a bit tricky to drive. It was the first car to be put into production. You can get it in any color you want if it is black.', '/pastpc/images/vehicles/ford-modelt.jpg', '/pastpc/images/vehicles/ford-modelt-tn.jpg', '30000', 1, 'Black', 2),
(3, 'Lamborghini', 'Adventador', 'This V-12 engine packs a punch in this sporty car. Make sure you wear your seatbelt and obey all traffic laws.', '/pastpc/images/vehicles/no-image.png', '/pastpc/images/vehicles/no-image-tn.png', '417650', 1, 'Blue', 3),
(4, 'Monster', 'Truck', 'Most trucks are for working, this one is for fun. This beast comes with 60 inch tires giving you the traction needed to jump and roll in the mud.', '/pastpc/images/vehicles/monster.jpg', '/pastpc/images/vehicles/monster-tn.jpg', '150000', 1, 'purple', 4),
(5, 'Mechanic', 'Special', 'Not sure where this car came from. However, with a little tender loving care it will run as good a new.', '/pastpc/images/vehicles/ms.jpg', '/pastpc/images/vehicles/ms-tn.jpg', '100', 1, 'Rust', 5),
(6, 'Batmobile', 'Custom', 'Ever want to be a superhero? Now you can with the bat mobile. This car allows you to switch to bike mode allowing for easy maneuvering through traffic during rush hour.', '/pastpc/images/vehicles/bat.jpg', '/pastpc/images/vehicles/bat-tn.jpg', '65000', 1, 'Black', 3),
(7, 'Mystery', 'Machine', 'Scooby and the gang always found luck in solving their mysteries because of their 4 wheel drive Mystery Machine. This Van will help you do whatever job you are required to with a success rate of 100%.', '/pastpc/images/vehicles/mm.jpg', '/pastpc/images/vehicles/mm-tn.jpg', '10000', 1, 'Green', 1),
(8, 'Spartan', 'Fire Truck', 'Emergencies happen often. Be prepared with this Spartan fire truck. Comes complete with 1000 ft. of hose and a 1000-gallon tank.', '/pastpc/images/vehicles/fire-truck.jpg', '/pastpc/images/vehicles/fire-truck-tn.jpg', '50000', 1, 'Red', 4),
(9, 'Ford', 'Crown Victoria', 'After the police force updated their fleet these cars are now available to the public! These cars come equipped with the siren which is convenient for college students running late to class.', '/pastpc/images/vehicles/crown-vic.jpg', '/pastpc/images/vehicles/crown-vic-tn.jpg', '10000', 1, 'White', 5),
(10, 'Chevy', 'Camaro', 'If you want to look cool this is the car you need! This car has great performance at an affordable price. Own it today!', '/pastpc/images/vehicles/camaro.jpg', '/pastpc/images/vehicles/camaro-tn.jpg', '25000', 1, 'Silver', 3),
(11, 'Cadillac', 'Escalade', 'This styling car is great for any occasion from going to the beach to meeting the president. The luxurious inside makes this car a home away from home.', '/pastpc/images/vehicles/no-image.png', '/pastpc/images/vehicles/no-image-tn.png', '75195', 1, 'Black', 1),
(12, 'GM', 'Hummer', 'Do you have 6 kids and like to go off-roading? The Hummer gives you the small interiors with an engine to get you out of any muddy or rocky situation.', '/pastpc/images/vehicles/hummer.jpg', '/pastpc/images/vehicles/hummer-tn.jpg', '58800', 1, 'Yellow', 5),
(13, 'Aerocar International', 'Aerocar', 'Are you sick of rush hour traffic? This car converts into an airplane to get you where you are going fast. Only 6 of these were made, get this one while it lasts!', '/pastpc/images/vehicles/aerocar.jpg', '/pastpc/images/vehicles/aerocar-tn.jpg', '1000000', 1, 'Red', 2),
(14, 'FBI', 'Surveillance Van', 'Do you like police shows? You will feel right at home driving this van. Comes complete with surveillance equipment for an extra fee of $2,000 a month.', '/pastpc/images/vehicles/fbi.jpg', '/pastpc/images/vehicles/fbi-tn.jpg', '20000', 1, 'Green', 1),
(15, 'Dog', 'Car', 'Do you like dogs? Well, this car is for you straight from the 90s from Aspen, Colorado we have the original Dog Car complete with fluffy ears.', '/pastpc/images/vehicles/no-image.png', '/pastpc/images/vehicles/no-image-tn.png', '35000', 1, 'Brown', 2),
(17, 'Chevy', 'Cavalier', 'Very beat up', '/pastpc/images/vehicles/no-image.png', '/pastpc/images/vehicles/no-image-tn.png', '500', 1, 'Tan', 2),
(18, 'Toyota', 'Prius', 'Black, compact', '/pastpc/images/vehicles/no-image.png', '/pastpc/images/vehicles/no-image-tn.png', '4000', 1, 'Black', 23),
(19, 'Dodge', 'Caravan', 'Reliable', '/pastpc/images/vehicles/no-image.png', '/pastpc/images/vehicles/no-image-tn.png', '500', 1, 'Burgundy', 5),
(20, 'DMC', 'DeLorean', '3 Cup holders, Superman doors, Fuzzy dice!', '/images/no-image.png', '/images/no-image.png', '75000', 1, 'Silver', 2);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `reviewId` int NOT NULL,
  `reviewText` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `reviewDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `invId` int NOT NULL,
  `clientId` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`reviewId`, `reviewText`, `reviewDate`, `invId`, `clientId`) VALUES
(2, 'Review test 3', '2023-04-07 04:14:25', 2, 7),
(3, 'Another test', '2023-04-07 05:28:03', 2, 7);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carclassification`
--
ALTER TABLE `carclassification`
  ADD PRIMARY KEY (`classificationId`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`clientId`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`imgId`),
  ADD KEY `invId` (`invId`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`invId`),
  ADD KEY `classificationId` (`classificationId`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`reviewId`),
  ADD KEY `FK_reviews_clients` (`clientId`),
  ADD KEY `FK_reviews_inventory` (`invId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carclassification`
--
ALTER TABLE `carclassification`
  MODIFY `classificationId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `clientId` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `imgId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `invId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `reviewId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `FK_inv_images` FOREIGN KEY (`invId`) REFERENCES `inventory` (`invId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `inventory`
--
ALTER TABLE `inventory`
  ADD CONSTRAINT `inventory_ibfk_1` FOREIGN KEY (`classificationId`) REFERENCES `carclassification` (`classificationId`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `FK_reviews_clients` FOREIGN KEY (`clientId`) REFERENCES `clients` (`clientId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_reviews_inventory` FOREIGN KEY (`invId`) REFERENCES `inventory` (`invId`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
