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

CREATE TABLE roles (
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
);

CREATE TABLE userRoles (
    userId INT(11) NOT NULL,
    roleId INT(11) NOT NULL,
    PRIMARY KEY (userId, roleId),
    FOREIGN KEY (userId) REFERENCES users(id),
    FOREIGN KEY (roleId) REFERENCES roles(id)
);

INSERT INTO users
    (lastname, firstname, email, password)
VALUES
    (Bonnet, Dylan, bonnet.dylan11@gmail.com, !TestHypn0s);

CREATE TABLE hostels (
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    hostelname VARCHAR(50) NOT NULL,
    adress VARCHAR(50) NOT NULL
);
CREATE TABLE hostelManagers (
    userId INT(11) NOT NULL,
    hostelId INT(11) NOT NULL,
    PRIMARY KEY (userId, hostelId),
    FOREIGN KEY (userId) REFERENCES users(id),
    FOREIGN KEY (hostelId) REFERENCES hostels(id)
);


--chambres et association à un gérant--
CREATE TABLE bedrooms (
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    bedroomname VARCHAR(50) NOT NULL,
    hostelId INT(11) NOT NULL
);

CREATE TABLE bedroomManagers (
    userId INT(11) NOT NULL,
    bedroomId INT(11) NOT NULL,
    PRIMARY KEY (userId, bedroomId),
    FOREIGN KEY (userId) REFERENCES users(id),
    FOREIGN KEY (bedroomId) REFERENCES bedrooms(id)
);

--reservations et association aux clients--
CREATE TABLE reservations (
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    bedroomId INT(11) NOT NULL
);

CREATE TABLE userReservations (
    userId INT(11) NOT NULL,
    reservationId INT(11) NOT NULL,
    PRIMARY KEY (userId, reservationId),
    FOREIGN KEY (userId) REFERENCES users(id),
    FOREIGN KEY (reservationId) REFERENCES reservations(id)
);

INSERT INTO roles (role) VALUES ('ROLE_USER'), ('ROLE_MANAGER'), ('ROLE_ADMIN');

SELECT * FROM roles;