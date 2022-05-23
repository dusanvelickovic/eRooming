-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 21, 2022 at 10:12 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `administracijahotelskogkompleksa`
--

-- --------------------------------------------------------

--
-- Table structure for table `gosti`
--

CREATE TABLE `gosti` (
  `idGosta` int(11) NOT NULL,
  `imeGosta` varchar(30) NOT NULL,
  `prezimeGosta` varchar(30) NOT NULL,
  `telefonskiBroj` varchar(30) NOT NULL,
  `emailAdresa` varchar(30) NOT NULL,
  `idHotela` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gosti`
--

INSERT INTO `gosti` (`idGosta`, `imeGosta`, `prezimeGosta`, `telefonskiBroj`, `emailAdresa`, `idHotela`) VALUES
(1, 'Pera', 'Perovic', '06122334445', 'peraperic@gmail.com', 18),
(2, 'Dušan', 'Mikic', '0618796532', 'mikamikic@hotmail.com', 19),
(3, 'Laza', 'Lazic', '0634455666', 'lazalazic@gmail.com', 20),
(4, 'Ana', 'Anic', '0645566777', 'anaanic@hotmail.com', 21),
(5, 'Ema', 'Emic', '0656677888', 'emaemic@gmail.com', 22),
(6, 'Pera', 'Peric', '3816795464', 'jdoe@gmail.com', 18),
(8, 'Sanja', 'Velickovic', '381642348754', 'sanja@gmail.com', 19),
(9, 'Dragan', 'Velickovic', '381642849765', 'dragan@gmail.com', 20),
(10, 'Milos', 'Misic', '381642319465', 'milos@gmail.com', 21),
(12, 'Mika', 'Mikic', '062 8582251', 'friendsbg@gmail.com', 22),
(14, 'Lazar', 'Lazarevic', '0679845145', 'laza@gmail.com', 18),
(15, 'Joca', 'Jocic', '0654687434', 'joca@gmail.com', 19),
(16, 'Petar', 'Petric', '0628456315', 'petar@gmail.com', 20),
(17, 'Petar', 'Lazic', '0656677888', 'petar@gmail.com', 18),
(18, 'Sanja', 'Jocic', '0651122333', 'sanja@gmail.com', 18),
(19, 'Ivana', 'Ivanovic', '0620011222', 'ivana@gmail.com', 18);

-- --------------------------------------------------------

--
-- Table structure for table `hoteli`
--

CREATE TABLE `hoteli` (
  `idHotela` int(11) NOT NULL,
  `imeHotela` varchar(30) NOT NULL,
  `grad` varchar(30) NOT NULL,
  `ulica` varchar(30) NOT NULL,
  `broj` varchar(30) NOT NULL,
  `telefonskiBroj` varchar(30) NOT NULL,
  `emailAdresa` varchar(30) NOT NULL,
  `lozinka` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hoteli`
--

INSERT INTO `hoteli` (`idHotela`, `imeHotela`, `grad`, `ulica`, `broj`, `telefonskiBroj`, `emailAdresa`, `lozinka`) VALUES
(18, 'Hotel Friends', 'Beograd', 'Nikole Tesle', '15', '0117788999', 'friendsbg@gmail.com', '$2y$10$Nq.Pwm3B4ugnDia4lKh64etJwhCyyJW/jG3oUnKHdgc1t7hypbVMO'),
(19, 'City Hotel', 'Niš', 'Stefana Nemanje', '7', '0181122333', 'cityhotelnis@gmail.com', '$2y$10$i6V3aikm4A6a8o5ADnxDseSwUhxjKO6Jrfw35Wzhp08wp0ksp3qeW'),
(20, 'Hotel Grand', 'Novi Sad', 'Kralja Petra I', '29', '0214455666', 'grandnovisad@gmail.com', '$2y$10$6w8NMU8C.Iq32ltjyu7n7edHTAnWRDJwXuym9UkmCJOexJwUhq5fC'),
(21, 'Hotel Sunrise', 'Kragujevac', 'Svetog Save', '5', '0346677888', 'sunrisekg@gmail.com', '$2y$10$298CLvgHfF8L0txE6O9N6u8PHz9fnbsfKa5tvbVl9i6l51OL7ZHiK'),
(22, 'Hotel Cvet', 'Subotica', 'Resavska', '1', '0242233444', 'cvetsubotica@gmail.com', '$2y$10$1ohMoiYanGsbavMVqusPDuqHC23SGMpx7Tlivy7Uz5O5aGxf7IJaC'),
(24, 'My Place', 'Niš', 'Mike Antića', '45', '0638754545', 'myplace@gmail.com', '$2y$10$k0UMin5uyFWzGpVSvf3ZX.z3HadjpAweHoRWqdjT29VXynrnMqzTq');

-- --------------------------------------------------------

--
-- Table structure for table `radnici`
--

CREATE TABLE `radnici` (
  `idRadnika` int(11) NOT NULL,
  `imeRadnika` varchar(30) NOT NULL,
  `prezimeRadnika` varchar(30) NOT NULL,
  `telefonskiBroj` varchar(30) NOT NULL,
  `pol` varchar(10) NOT NULL,
  `datumRodjenja` date NOT NULL,
  `idHotela` int(11) NOT NULL,
  `idSektora` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `radnici`
--

INSERT INTO `radnici` (`idRadnika`, `imeRadnika`, `prezimeRadnika`, `telefonskiBroj`, `pol`, `datumRodjenja`, `idHotela`, `idSektora`) VALUES
(1, 'Nemanja', 'Nemanjic', '0619988777', 'm', '1995-05-05', 19, 1),
(2, 'Jovan', 'Jovanovic', '0618877666', 'm', '1994-04-04', 19, 2),
(3, 'Nikolina', 'Nikolic', '0627766555', 'm', '1997-07-07', 19, 8),
(4, 'Petra', 'Petrovic', '0635566777', 'm', '1993-03-03', 19, 4),
(5, 'Zarko', 'Zarkovic', '0628877666', 'm', '1989-08-08', 19, 5),
(6, 'Aleska', 'Aleksic', '0634455667', 'm', '1997-07-17', 20, 1),
(7, 'Andjela', 'Andjelkovic', '0617755667', 'z', '1994-01-14', 20, 2),
(8, 'Milica', 'Milic', '0648877665', 'z', '1991-01-15', 20, 3),
(9, 'Dusan', 'Dusanovic', '0658877544', 'm', '1987-04-15', 20, 4),
(10, 'Uros', 'Urosevic', '0642233445', 'm', '1988-02-22', 20, 5),
(11, 'Nikola', 'Nikolic', '0691122333', 'm', '1998-01-01', 21, 1),
(12, 'Uros', 'Urosevic', '0692233444', 'm', '1989-04-04', 21, 2),
(13, 'Jovana', 'Jovanovic', '0693344555', 'z', '1997-07-07', 21, 3),
(14, 'Petra', 'Petrovic', '0694455666', 'z', '1995-06-06', 21, 4),
(15, 'Andjela', 'Andjelkovic', '0695566777', 'z', '1990-05-15', 21, 5),
(16, 'Luka', 'Lukovic', '0696677888', 'm', '1994-04-15', 22, 1),
(17, 'Marko', 'Markovic', '0697788999', 'm', '1991-02-02', 22, 2),
(18, 'Veljko', 'Veljkovic', '0698899000', 'm', '1985-05-05', 22, 3),
(19, 'Sara', 'Sarovic', '0610022333', 'z', '1997-03-03', 22, 4),
(20, 'Ivana', 'Ivanovic', '0620011222', 'z', '1992-10-10', 22, 5),
(21, 'Bojana', 'Bojic', '0634422333', 'z', '1990-11-05', 18, 1),
(22, 'Andrija', 'Andric', '0645533222', 'm', '1994-04-14', 19, 2),
(23, 'Tamara', 'Tamic', '0637788666', 'z', '1992-10-11', 20, 3),
(24, 'David', 'Davidovic', '0615566777', 'm', '1984-05-05', 21, 4),
(25, 'Zorica', 'Zoric', '0651122333', 'z', '1992-07-08', 21, 5),
(26, 'Dusan', 'Petrovic', '0628582251', 'm', '1999-09-15', 19, 3),
(54, 'Dusan', 'Velickovic', '381628582251', 'm', '2003-10-07', 22, 3),
(56, 'Ognjen', 'Igic', '0631578954', 'm', '1999-06-16', 20, 8),
(59, 'Dusan', 'Velickovic', '062 8582251', 'm', '2003-10-07', 18, 1),
(60, 'Mika ', 'Mikic', '0623344555', 'm', '1999-10-04', 18, 2),
(61, 'Ana', 'Anic', '0656677888', 'z', '1999-02-05', 18, 3),
(62, 'Milica', 'Mikic', '0628486315', 'z', '1995-08-23', 18, 4),
(63, 'Katarina', 'Katic', '0634455666', 'z', '2000-04-17', 18, 8),
(64, 'Petar', 'Petric', '0628456315', 'm', '1993-03-30', 18, 1),
(65, 'Ivana', 'Ivic', '0642514875', 'z', '1994-07-20', 19, 1);

-- --------------------------------------------------------

--
-- Table structure for table `rezervacije`
--

CREATE TABLE `rezervacije` (
  `idRezervacije` int(11) NOT NULL,
  `idGosta` int(11) NOT NULL,
  `datumRezervacije` date NOT NULL,
  `krajRezervacije` date DEFAULT NULL,
  `idSobe` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rezervacije`
--

INSERT INTO `rezervacije` (`idRezervacije`, `idGosta`, `datumRezervacije`, `krajRezervacije`, `idSobe`) VALUES
(45, 17, '2022-05-16', '2022-05-24', 47),
(46, 19, '2022-05-16', '2022-05-29', 51),
(47, 10, '2022-05-17', '2022-05-28', 63),
(48, 8, '2022-05-20', '2022-05-29', 55),
(49, 15, '2022-05-20', '2022-05-22', 58),
(50, 2, '2022-05-23', '2022-06-04', 59),
(52, 8, '2022-05-20', '2022-05-22', 56),
(53, 9, '2022-05-24', '2022-06-04', 70);

--
-- Triggers `rezervacije`
--
DELIMITER $$
CREATE TRIGGER `afterUpdateReservation` AFTER UPDATE ON `rezervacije` FOR EACH ROW BEGIN
	UPDATE sobe SET sobe.statusRezervisanosti = 1 WHERE sobe.idSobe = new.idSobe;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `beforeUpdateReservation` BEFORE UPDATE ON `rezervacije` FOR EACH ROW BEGIN
	UPDATE sobe set sobe.statusRezervisanosti = 0 WHERE old.idSobe;
end
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `makeRoomOccupied` AFTER INSERT ON `rezervacije` FOR EACH ROW begin
	update sobe set statusRezervisanosti = 1 where idSobe = new.idSobe; 
end
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `unoccupieRoomAfterReservationDelete` AFTER DELETE ON `rezervacije` FOR EACH ROW BEGIN
UPDATE sobe SET sobe.statusRezervisanosti = 0 WHERE idSobe = old.idSobe;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `sektori`
--

CREATE TABLE `sektori` (
  `idSektora` int(11) NOT NULL,
  `imeSektora` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sektori`
--

INSERT INTO `sektori` (`idSektora`, `imeSektora`) VALUES
(1, 'Administracija i bezbednost'),
(2, 'Usluga'),
(3, 'Odrzavanje'),
(4, 'Kuhinja i restoran'),
(5, 'Obezbedjenje'),
(8, 'Cyber Bezbednost'),
(12, 'Test test');

-- --------------------------------------------------------

--
-- Table structure for table `sobe`
--

CREATE TABLE `sobe` (
  `idSobe` int(11) NOT NULL,
  `idHotela` int(11) NOT NULL,
  `idTipaSobe` int(11) NOT NULL,
  `statusRezervisanosti` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sobe`
--

INSERT INTO `sobe` (`idSobe`, `idHotela`, `idTipaSobe`, `statusRezervisanosti`) VALUES
(47, 18, 1, 1),
(48, 18, 2, 0),
(49, 18, 3, 0),
(50, 18, 4, 0),
(51, 18, 5, 1),
(52, 18, 6, 0),
(53, 19, 3, 0),
(54, 19, 2, 0),
(55, 19, 5, 1),
(56, 19, 1, 1),
(57, 19, 6, 0),
(58, 19, 4, 1),
(59, 19, 1, 1),
(60, 21, 1, 0),
(61, 21, 3, 0),
(62, 21, 4, 0),
(63, 21, 6, 1),
(64, 21, 4, 0),
(65, 21, 2, 0),
(66, 20, 1, 0),
(67, 20, 2, 0),
(68, 20, 2, 0),
(69, 20, 5, 0),
(70, 20, 5, 1),
(71, 19, 4, 0),
(72, 20, 6, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tipovisoba`
--

CREATE TABLE `tipovisoba` (
  `idTipaSobe` int(11) NOT NULL,
  `imeTipaSobe` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tipovisoba`
--

INSERT INTO `tipovisoba` (`idTipaSobe`, `imeTipaSobe`) VALUES
(1, 'Jednokrevetna soba'),
(2, 'Dvokrevetna soba'),
(3, 'Trokrevetna soba'),
(4, 'Cetvorokrevetna soba'),
(5, 'Petokrevetna soba'),
(6, 'Sestokrevetna soba');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `gosti`
--
ALTER TABLE `gosti`
  ADD PRIMARY KEY (`idGosta`),
  ADD KEY `idHotela` (`idHotela`);

--
-- Indexes for table `hoteli`
--
ALTER TABLE `hoteli`
  ADD PRIMARY KEY (`idHotela`);

--
-- Indexes for table `radnici`
--
ALTER TABLE `radnici`
  ADD PRIMARY KEY (`idRadnika`),
  ADD KEY `radnici_ibfk_1` (`idHotela`),
  ADD KEY `radnici_ibfk_2` (`idSektora`);

--
-- Indexes for table `rezervacije`
--
ALTER TABLE `rezervacije`
  ADD PRIMARY KEY (`idRezervacije`),
  ADD UNIQUE KEY `idSobe` (`idSobe`),
  ADD KEY `rezervacije_ibfk_1` (`idGosta`);

--
-- Indexes for table `sektori`
--
ALTER TABLE `sektori`
  ADD PRIMARY KEY (`idSektora`);

--
-- Indexes for table `sobe`
--
ALTER TABLE `sobe`
  ADD PRIMARY KEY (`idSobe`),
  ADD KEY `sobe_ibfk_1` (`idHotela`),
  ADD KEY `sobe_ibfk_2` (`idTipaSobe`);

--
-- Indexes for table `tipovisoba`
--
ALTER TABLE `tipovisoba`
  ADD PRIMARY KEY (`idTipaSobe`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `gosti`
--
ALTER TABLE `gosti`
  MODIFY `idGosta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `hoteli`
--
ALTER TABLE `hoteli`
  MODIFY `idHotela` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `radnici`
--
ALTER TABLE `radnici`
  MODIFY `idRadnika` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `rezervacije`
--
ALTER TABLE `rezervacije`
  MODIFY `idRezervacije` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `sektori`
--
ALTER TABLE `sektori`
  MODIFY `idSektora` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `sobe`
--
ALTER TABLE `sobe`
  MODIFY `idSobe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `tipovisoba`
--
ALTER TABLE `tipovisoba`
  MODIFY `idTipaSobe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `gosti`
--
ALTER TABLE `gosti`
  ADD CONSTRAINT `gosti_ibfk_1` FOREIGN KEY (`idHotela`) REFERENCES `hoteli` (`idHotela`) ON DELETE CASCADE;

--
-- Constraints for table `radnici`
--
ALTER TABLE `radnici`
  ADD CONSTRAINT `radnici_ibfk_1` FOREIGN KEY (`idHotela`) REFERENCES `hoteli` (`idHotela`) ON DELETE CASCADE,
  ADD CONSTRAINT `radnici_ibfk_2` FOREIGN KEY (`idSektora`) REFERENCES `sektori` (`idSektora`) ON DELETE CASCADE;

--
-- Constraints for table `rezervacije`
--
ALTER TABLE `rezervacije`
  ADD CONSTRAINT `rezervacije_ibfk_1` FOREIGN KEY (`idGosta`) REFERENCES `gosti` (`idGosta`) ON DELETE CASCADE,
  ADD CONSTRAINT `rezervacije_ibfk_2` FOREIGN KEY (`idSobe`) REFERENCES `sobe` (`idSobe`) ON DELETE CASCADE;

--
-- Constraints for table `sobe`
--
ALTER TABLE `sobe`
  ADD CONSTRAINT `sobe_ibfk_1` FOREIGN KEY (`idHotela`) REFERENCES `hoteli` (`idHotela`) ON DELETE CASCADE,
  ADD CONSTRAINT `sobe_ibfk_2` FOREIGN KEY (`idTipaSobe`) REFERENCES `tipovisoba` (`idTipaSobe`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
