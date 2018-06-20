<?php

$path = $_SERVER ['DOCUMENT_ROOT'];

include_once $path . '/wp-config.php';
include_once $path . '/wp-load.php';
include_once $path . '/wp-includes/wp-db.php';
include_once $path . '/wp-includes/pluggable.php';
include_once $path . '/wp-includes/class-phpmailer.php';

$create_cort_quiz_utente = " CREATE TABLE IF NOT EXISTS `cort_quiz_utente` ( " 
. " `ID` bigint(20) NOT NULL AUTO_INCREMENT, " 
. " `NICKNAME` varchar(255) NOT NULL, " 
. " `NOME` varchar(255) NOT NULL, " 
. " `COGNOME` varchar(255) NOT NULL, " 
. " `EMAIL` varchar(255) NOT NULL, " 
. " `DATA_ISCRIZIONE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP, " 
. " PRIMARY KEY (`ID`), " 
. " UNIQUE INDEX (`NICKNAME`), " 
. " UNIQUE INDEX (`EMAIL`) " 
. " ) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ";

$create_cort_quiz_anag = " CREATE TABLE IF NOT EXISTS `cort_quiz_anag` ( " 
. " `ID` bigint(20) NOT NULL, " 
. " `DESCRIZIONE` varchar(255) NOT NULL, " 
. " PRIMARY KEY (`ID`) " 
. " ) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ";

$create_cort_quiz_domanda = " CREATE TABLE IF NOT EXISTS `cort_quiz_domanda` ( " 
. " `ID` bigint(20) NOT NULL, " 
. " `FK_QUIZ` bigint(20) NOT NULL, " 
. " `DOMANDA` varchar(255) NOT NULL, " 
. " PRIMARY KEY (`ID`) " 
. " ) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ";

$create_cort_quiz_risposta = " CREATE TABLE IF NOT EXISTS `cort_quiz_risposta` ( " 
. " `ID` bigint(20) NOT NULL, " 
. " `FK_DOMANDA` bigint(20) NOT NULL, " 
. " `RISPOSTA` varchar(255) NOT NULL, " 
. " `PUNTEGGIO` double NOT NULL, " 
. " PRIMARY KEY (`ID`) " 
. " ) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ";

$create_cort_quiz_risultato = " CREATE TABLE IF NOT EXISTS `cort_quiz_risultato` ( " 
. " `ID` bigint(20) NOT NULL AUTO_INCREMENT, " 
. " `FK_UTENTE` bigint(20) NOT NULL, " 
. " `FK_QUIZ` bigint(20) NOT NULL, " 
. " `FK_DOMANDA` bigint(20) NOT NULL, " 
. " `FK_RISPOSTA` bigint(20) NOT NULL, " 
. " `DATA_RISPOSTA` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP, " 
. " PRIMARY KEY (`ID`), " 
. " UNIQUE INDEX (`NICKNAME`), " 
. " UNIQUE INDEX (`EMAIL`) " 
. " ) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ";


$delete_cort_quiz_utente = "DELETE FROM cort_quiz_utente";
$delete_cort_quiz_anag = "DELETE FROM cort_quiz_anag";
$delete_cort_quiz_domanda = "DELETE FROM cort_quiz_domanda";
$delete_cort_quiz_risposta = "DELETE FROM cort_quiz_risposta";
$delete_cort_quiz_risultato = "DELETE FROM cort_quiz_risultato";



$populate_cort_quiz_anag = " INSERT INTO `cort_quiz_anag` (`ID`, `DESCRIZIONE`) VALUES
(1, 'Quiz 1'),
(2, 'Quiz 2'),
(3, 'Quiz 3')";


$populate_cort_quiz_domanda = " INSERT INTO `cort_quiz_domanda` (`ID`, `FK_QUIZ`, `DOMANDA`) VALUES
(1, 1, 'Domanda 1'),
(2, 1, 'Domanda 2'),
(3, 1, 'Domanda 3'),
(4, 1, 'Domanda 4'),		
(5, 1, 'Domanda 5'),
(6, 1, 'Domanda 6'),
(7, 1, 'Domanda 7'),
(8, 1, 'Domanda 8'),
(9, 1, 'Domanda 9'),
(10, 1, 'Domanda 10'),
(11, 1, 'Domanda 11'),
(12, 1, 'Domanda 12'),
(13, 1, 'Domanda 13'),
(14, 1, 'Domanda 14'),		
(15, 1, 'Domanda 15'),
(16, 1, 'Domanda 16'),
(17, 1, 'Domanda 17'),
(18, 1, 'Domanda 18'),
(19, 1, 'Domanda 19'),		
(20, 1, 'Domanda 20'),
(21, 2, 'Domanda 1'),
(22, 2, 'Domanda 2'),
(23, 2, 'Domanda 3'),
(24, 2, 'Domanda 4'),		
(25, 2, 'Domanda 5'),
(26, 2, 'Domanda 6'),
(27, 2, 'Domanda 7'),
(28, 2, 'Domanda 8'),
(29, 2, 'Domanda 9'),
(30, 2, 'Domanda 10'),
(31, 2, 'Domanda 11'),
(32, 2, 'Domanda 12'),
(33, 2, 'Domanda 13'),
(34, 2, 'Domanda 14'),		
(35, 2, 'Domanda 15'),
(36, 2, 'Domanda 16'),
(37, 2, 'Domanda 17'),
(38, 2, 'Domanda 18'),
(39, 2, 'Domanda 19'),
(40, 2, 'Domanda 20'),		
(41, 3, 'Domanda 1'),
(42, 3, 'Domanda 2'),
(43, 3, 'Domanda 3'),
(44, 3, 'Domanda 4'),		
(45, 3, 'Domanda 5'),
(46, 3, 'Domanda 6'),
(47, 3, 'Domanda 7'),
(48, 3, 'Domanda 8'),
(49, 3, 'Domanda 9'),
(50, 3, 'Domanda 10'),
(51, 3, 'Domanda 11'),
(52, 3, 'Domanda 12'),
(53, 3, 'Domanda 13'),
(54, 3, 'Domanda 14'),		
(55, 3, 'Domanda 15'),
(56, 3, 'Domanda 16'),
(57, 3, 'Domanda 17'),
(58, 3, 'Domanda 18'),
(59, 3, 'Domanda 19'),
(60, 3, 'Domanda 20')";


$populate_cort_quiz_risposta = " INSERT INTO `cort_quiz_risposta` (`ID`, `FK_DOMANDA`, `RISPOSTA`, `PUNTEGGIO`) VALUES
(1, 1, 'Risposta1', 1),
(61, 1, 'Risposta2', 0),
(121, 1, 'Risposta3', 0),
(181, 1, 'Risposta4', 0),
(2, 2, 'Risposta1', 1),
(62, 2, 'Risposta2', 0),
(122, 2, 'Risposta3', 0),
(182, 2, 'Risposta4', 0),
(3, 3, 'Risposta1', 1),
(63, 3, 'Risposta2', 0),
(123, 3, 'Risposta3', 0),
(183, 3, 'Risposta4', 0),
(4, 4, 'Risposta1', 1),
(64, 4, 'Risposta2', 0),
(124, 4, 'Risposta3', 0),
(184, 4, 'Risposta4', 0),
(5, 5, 'Risposta1', 1),
(65, 5, 'Risposta2', 0),
(125, 5, 'Risposta3', 0),
(185, 5, 'Risposta4', 0),
(6, 6, 'Risposta1', 1),
(66, 6, 'Risposta2', 0),
(126, 6, 'Risposta3', 0),
(186, 6, 'Risposta4', 0),
(7, 7, 'Risposta1', 1),
(67, 7, 'Risposta2', 0),
(127, 7, 'Risposta3', 0),
(187, 7, 'Risposta4', 0),
(8, 8, 'Risposta1', 1),
(68, 8, 'Risposta2', 0),
(128, 8, 'Risposta3', 0),
(188, 8, 'Risposta4', 0),
(9, 9, 'Risposta1', 1),
(69, 9, 'Risposta2', 0),
(129, 9, 'Risposta3', 0),
(189, 9, 'Risposta4', 0),
(10, 10, 'Risposta1', 1),
(70, 10, 'Risposta2', 0),
(130, 10, 'Risposta3', 0),
(190, 10, 'Risposta4', 0),
(11, 11, 'Risposta1', 1),
(71, 11, 'Risposta2', 0),
(131, 11, 'Risposta3', 0),
(191, 11, 'Risposta4', 0),
(12, 12, 'Risposta1', 1),
(72, 12, 'Risposta2', 0),
(132, 12, 'Risposta3', 0),
(192, 12, 'Risposta4', 0),
(13, 13, 'Risposta1', 1),
(73, 13, 'Risposta2', 0),
(133, 13, 'Risposta3', 0),
(193, 13, 'Risposta4', 0),
(14, 14, 'Risposta1', 1),
(74, 14, 'Risposta2', 0),
(134, 14, 'Risposta3', 0),
(194, 14, 'Risposta4', 0),
(15, 15, 'Risposta1', 1),
(75, 15, 'Risposta2', 0),
(135, 15, 'Risposta3', 0),
(195, 15, 'Risposta4', 0),
(16, 16, 'Risposta1', 1),
(76, 16, 'Risposta2', 0),
(136, 16, 'Risposta3', 0),
(196, 16, 'Risposta4', 0),
(17, 17, 'Risposta1', 1),
(77, 17, 'Risposta2', 0),
(137, 17, 'Risposta3', 0),
(197, 17, 'Risposta4', 0),
(18, 18, 'Risposta1', 1),
(78, 18, 'Risposta2', 0),
(138, 18, 'Risposta3', 0),
(198, 18, 'Risposta4', 0),
(19, 19, 'Risposta1', 1),
(79, 19, 'Risposta2', 0),
(139, 19, 'Risposta3', 0),
(199, 19, 'Risposta4', 0),
(20, 20, 'Risposta1', 1),
(80, 20, 'Risposta2', 0),
(140, 20, 'Risposta3', 0),
(200, 20, 'Risposta4', 0),
(21, 21, 'Risposta1', 1),
(81, 21, 'Risposta2', 0),
(141, 21, 'Risposta3', 0),
(201, 21, 'Risposta4', 0),
(22, 22, 'Risposta1', 1),
(82, 22, 'Risposta2', 0),
(142, 22, 'Risposta3', 0),
(202, 22, 'Risposta4', 0),
(23, 23, 'Risposta1', 1),
(83, 23, 'Risposta2', 0),
(143, 23, 'Risposta3', 0),
(203, 23, 'Risposta4', 0),
(24, 24, 'Risposta1', 1),
(84, 24, 'Risposta2', 0),
(144, 24, 'Risposta3', 0),
(204, 24, 'Risposta4', 0),
(25, 25, 'Risposta1', 1),
(85, 25, 'Risposta2', 0),
(145, 25, 'Risposta3', 0),
(205, 25, 'Risposta4', 0),
(26, 26, 'Risposta1', 1),
(86, 26, 'Risposta2', 0),
(146, 26, 'Risposta3', 0),
(206, 26, 'Risposta4', 0),
(27, 27, 'Risposta1', 1),
(87, 27, 'Risposta2', 0),
(147, 27, 'Risposta3', 0),
(207, 27, 'Risposta4', 0),
(28, 28, 'Risposta1', 1),
(88, 28, 'Risposta2', 0),
(148, 28, 'Risposta3', 0),
(208, 28, 'Risposta4', 0),
(29, 29, 'Risposta1', 1),
(89, 29, 'Risposta2', 0),
(149, 29, 'Risposta3', 0),
(209, 29, 'Risposta4', 0),
(30, 30, 'Risposta1', 1),
(90, 30, 'Risposta2', 0),
(150, 30, 'Risposta3', 0),
(210, 30, 'Risposta4', 0),
(31, 31, 'Risposta1', 1),
(91, 31, 'Risposta2', 0),
(151, 31, 'Risposta3', 0),
(211, 31, 'Risposta4', 0),
(32, 32, 'Risposta1', 1),
(92, 32, 'Risposta2', 0),
(152, 32, 'Risposta3', 0),
(212, 32, 'Risposta4', 0),
(33, 33, 'Risposta1', 1),
(93, 33, 'Risposta2', 0),
(153, 33, 'Risposta3', 0),
(213, 33, 'Risposta4', 0),
(34, 34, 'Risposta1', 1),
(94, 34, 'Risposta2', 0),
(154, 34, 'Risposta3', 0),
(214, 34, 'Risposta4', 0),
(35, 35, 'Risposta1', 1),
(95, 35, 'Risposta2', 0),
(155, 35, 'Risposta3', 0),
(215, 35, 'Risposta4', 0),
(36, 36, 'Risposta1', 1),
(96, 36, 'Risposta2', 0),
(156, 36, 'Risposta3', 0),
(216, 36, 'Risposta4', 0),
(37, 37, 'Risposta1', 1),
(97, 37, 'Risposta2', 0),
(157, 37, 'Risposta3', 0),
(217, 37, 'Risposta4', 0),
(38, 38, 'Risposta1', 1),
(98, 38, 'Risposta2', 0),
(158, 38, 'Risposta3', 0),
(218, 38, 'Risposta4', 0),
(39, 39, 'Risposta1', 1),
(99, 39, 'Risposta2', 0),
(159, 39, 'Risposta3', 0),
(219, 39, 'Risposta4', 0),
(40, 40, 'Risposta1', 1),
(100, 40, 'Risposta2', 0),
(160, 40, 'Risposta3', 0),
(220, 40, 'Risposta4', 0),
(41, 41, 'Risposta1', 1),
(101, 41, 'Risposta2', 0),
(161, 41, 'Risposta3', 0),
(221, 41, 'Risposta4', 0),
(42, 42, 'Risposta1', 1),
(102, 42, 'Risposta2', 0),
(162, 42, 'Risposta3', 0),
(222, 42, 'Risposta4', 0),
(43, 43, 'Risposta1', 1),
(103, 43, 'Risposta2', 0),
(163, 43, 'Risposta3', 0),
(223, 43, 'Risposta4', 0),
(44, 44, 'Risposta1', 1),
(104, 44, 'Risposta2', 0),
(164, 44, 'Risposta3', 0),
(224, 44, 'Risposta4', 0),
(45, 45, 'Risposta1', 1),
(105, 45, 'Risposta2', 0),
(165, 45, 'Risposta3', 0),
(225, 45, 'Risposta4', 0),
(46, 46, 'Risposta1', 1),
(106, 46, 'Risposta2', 0),
(166, 46, 'Risposta3', 0),
(226, 46, 'Risposta4', 0),
(47, 47, 'Risposta1', 1),
(107, 47, 'Risposta2', 0),
(167, 47, 'Risposta3', 0),
(227, 47, 'Risposta4', 0),
(48, 48, 'Risposta1', 1),
(108, 48, 'Risposta2', 0),
(168, 48, 'Risposta3', 0),
(228, 48, 'Risposta4', 0),
(49, 49, 'Risposta1', 1),
(109, 49, 'Risposta2', 0),
(169, 49, 'Risposta3', 0),
(229, 49, 'Risposta4', 0),
(50, 50, 'Risposta1', 1),
(110, 50, 'Risposta2', 0),
(170, 50, 'Risposta3', 0),
(230, 50, 'Risposta4', 0),
(51, 51, 'Risposta1', 1),
(111, 51, 'Risposta2', 0),
(171, 51, 'Risposta3', 0),
(231, 51, 'Risposta4', 0),
(52, 52, 'Risposta1', 1),
(112, 52, 'Risposta2', 0),
(172, 52, 'Risposta3', 0),
(232, 52, 'Risposta4', 0),
(53, 53, 'Risposta1', 1),
(113, 53, 'Risposta2', 0),
(173, 53, 'Risposta3', 0),
(233, 53, 'Risposta4', 0),
(54, 54, 'Risposta1', 1),
(114, 54, 'Risposta2', 0),
(174, 54, 'Risposta3', 0),
(234, 54, 'Risposta4', 0),
(55, 55, 'Risposta1', 1),
(115, 55, 'Risposta2', 0),
(175, 55, 'Risposta3', 0),
(235, 55, 'Risposta4', 0),
(56, 56, 'Risposta1', 1),
(116, 56, 'Risposta2', 0),
(176, 56, 'Risposta3', 0),
(236, 56, 'Risposta4', 0),
(57, 57, 'Risposta1', 1),
(117, 57, 'Risposta2', 0),
(177, 57, 'Risposta3', 0),
(237, 57, 'Risposta4', 0),
(58, 58, 'Risposta1', 1),
(118, 58, 'Risposta2', 0),
(178, 58, 'Risposta3', 0),
(238, 58, 'Risposta4', 0),
(59, 59, 'Risposta1', 1),
(119, 59, 'Risposta2', 0),
(179, 59, 'Risposta3', 0),
(239, 59, 'Risposta4', 0),
(60, 60, 'Risposta1', 1),
(120, 60, 'Risposta2', 0),
(180, 60, 'Risposta3', 0),
(240, 60, 'Risposta4', 0)";


global $wpdb;

echo $wpdb->query($delete_cort_quiz_utente);
echo $wpdb->query($delete_cort_quiz_anag);
echo $wpdb->query($delete_cort_quiz_domanda);
echo $wpdb->query($delete_cort_quiz_risposta);
echo $wpdb->query($delete_cort_quiz_risultato);

echo $wpdb->query($create_cort_quiz_utente);
echo $wpdb->query($create_cort_quiz_anag);
echo $wpdb->query($create_cort_quiz_domanda);
echo $wpdb->query($create_cort_quiz_risposta);
echo $wpdb->query($create_cort_quiz_risultato);

echo $wpdb->query($populate_cort_quiz_anag);
echo $wpdb->query($populate_cort_quiz_domanda);
echo $wpdb->query($populate_cort_quiz_risposta);

echo $wpdb->query("commit");

?>