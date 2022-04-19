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
CREATE TABLE reservations (
  id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  lastname VARCHAR(50) NOT NULL,
  firstname VARCHAR(50) NOT NULL,
  email VARCHAR(50) NOT NULL,
  hostelname VARCHAR(50) NOT NULL,
  bedroomname VARCHAR(50) NOT NULL,
  datearrived DATE NOT NULL,
  datedeparture DATE NOT NULL,
  price FLOAT(11) NOT NULL
);
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
