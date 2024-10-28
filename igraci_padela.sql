-- -------------------------------------------------------------
-- TablePlus 6.1.2(568)
--
-- https://tableplus.com/
--
-- Database: lab1
-- Generation Time: 2024-10-28 02:41:38.1720
-- -------------------------------------------------------------


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


CREATE TABLE `players` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ime` varchar(50) NOT NULL,
  `prezime` varchar(50) NOT NULL,
  `zemlja` varchar(50) DEFAULT NULL,
  `visina` int DEFAULT NULL,
  `datum_rodjenja` date DEFAULT NULL,
  `glavna_strana` enum('lijevo','desno') DEFAULT NULL,
  `partner_id` int DEFAULT NULL,
  `ranking` int DEFAULT NULL,
  `broj_odigranih_matcheva` int DEFAULT NULL,
  `postotak_pobjeda` decimal(5,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `partner_id` (`partner_id`),
  CONSTRAINT `players_ibfk_1` FOREIGN KEY (`partner_id`) REFERENCES `players` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `players` (`id`, `ime`, `prezime`, `zemlja`, `visina`, `datum_rodjenja`, `glavna_strana`, `partner_id`, `ranking`, `broj_odigranih_matcheva`, `postotak_pobjeda`) VALUES
(1, 'Arthur', 'Coello', 'Španjolska', 190, '2002-03-08', 'desno', 2, 15965, 136, 89.00),
(2, 'Agustin', 'Tapia', 'Argentina', 179, '1999-07-24', 'lijevo', 1, 15395, 119, 90.80),
(3, 'Alejandro', 'Galan', 'Španjolska', 186, '1999-05-15', 'lijevo', 4, 12982, 133, 85.70),
(4, 'Federico', 'Chingotto', 'Argentina', 170, '1997-04-13', 'desno', 3, 12982, 125, 80.00),
(5, 'Juan', 'Lebron', 'Španjolska', 184, '1995-01-31', 'desno', 6, 8037, 119, 79.80),
(6, 'Martin', 'Di Nenno', 'Argentina', 175, '1997-03-18', 'desno', 5, 7968, 118, 77.10),
(7, 'Franco', 'Stupaczuk', 'Argentina', 180, '1996-03-25', 'lijevo', 8, 7294, 115, 76.50),
(8, 'Miguel', 'Yanguas', 'Španjolska', 189, '2002-03-18', 'desno', 7, 4980, 87, 67.80),
(9, 'Jorge', 'Nieto', 'Španjolska', 175, '1998-12-18', 'lijevo', 10, 3839, 85, 67.10),
(10, 'Jon', 'Sanz', 'Španjolska', 175, '2000-09-25', 'desno', 9, 3733, 85, 67.10);


/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;