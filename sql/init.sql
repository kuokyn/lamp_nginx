CREATE DATABASE IF NOT EXISTS appDB;
CREATE USER IF NOT EXISTS 'user'@'%' IDENTIFIED WITH mysql_native_password BY 'toor';
GRANT SELECT,UPDATE,INSERT,DELETE ON appDB.* TO 'user'@'%';
FLUSH PRIVILEGES;

USE appDB;
CREATE TABLE IF NOT EXISTS users
(
    id       INT(11)      NOT NULL AUTO_INCREMENT,
    username VARCHAR(32)  NOT NULL,
    password VARCHAR(256) NOT NULL,
    email    VARCHAR(64)  NOT NULL,
    PRIMARY KEY (ID)
);

CREATE TABLE IF NOT EXISTS requests
(
    id      INT(11)      NOT NULL AUTO_INCREMENT,
    name    VARCHAR(256) NOT NULL,
    email   VARCHAR(64)  NOT NULL,
    service VARCHAR(20)  NOT NULL,
    message text         NOT NULL,
    PRIMARY KEY (id)
);

INSERT INTO requests (id, name, email, service, message) VALUES ('1', 'harry', 'harry@mail.ru', 'Front-end', 'hello');
