CREATE TABLE `register` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `name` varchar(100),
    `service` varchar(100),
    `country` varchar(100),
    `citie` varchar(100),
    `district` varchar(100),
    `contact` varchar(100),
    `mail` varchar(100),
    `pass` text,
    `hash` text,
    PRIMARY KEY (`id`)
);