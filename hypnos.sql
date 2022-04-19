--création de la base de données--
CREATE DATABASE hypnosevaluation;

--association de rôles aux utilisateurs--
CREATE TABLE users (
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    lastname VARCHAR(50) NOT NULL,
    firstname VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL UNIQUE,
    password TEXT(50) NOT NULL,
    token TEXT NOT NULL
);

ALTER TABLE users ADD role INT NOT NULL DEFAULT 1;

--hotels--
CREATE TABLE hostels (
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    hostelname VARCHAR(50) NOT NULL,
    adress VARCHAR(50) NOT NULL
);

ALTER TABLE hostels ADD description VARCHAR(200) NOT NULL;
--chambres et association à un gérant--
CREATE TABLE bedrooms (
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    bedroomname VARCHAR(50) NOT NULL,
    picture BLOB NOT NULL,
    descript VARCHAR(200) NOT NULL,
    price FLOAT(11) NOT NULL,
    pictureOne BLOB NOT NULL,
    pictureTwo BLOB NOT NULL,
    booking VARCHAR(100) NOT NULL,
    hostelId INT(11) NOT NULL
);
DROP TABLE bedrooms;

--reservations et association aux clients--
CREATE TABLE `reservations` (
  `res_id` int(11) NOT NULL,
  `res_date` date,
  `res_slot` varchar(32) DEFAULT NULL,
  `res_name` varchar(255) NOT NULL,
  `res_email` varchar(255) NOT NULL,
  `res_tel` varchar(60) NOT NULL,
  `res_notes` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `reservations`
  ADD PRIMARY KEY (`res_id`),
  ADD KEY `res_date` (`res_date`),
  ADD KEY `res_slot` (`res_slot`),
  ADD KEY `res_name` (`res_name`),
  ADD KEY `res_email` (`res_email`),
  ADD KEY `res_tel` (`res_tel`);

ALTER TABLE `reservations`
  MODIFY `res_id` int(11) NOT NULL AUTO_INCREMENT;
--contact-
CREATE TABLE contact (
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    lastname VARCHAR(50) NOT NULL,
    firstname VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL,
    subject VARCHAR(100) NOT NULL,
    message VARCHAR(200) NOT NULL
);
--retouches--
DROP TABLE userreservations;
