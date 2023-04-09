DROP DATABASE IF EXISTS authentification_page;

CREATE DATABASE authentification_page;

USE authentification_page;

CREATE TABLE
    UTILISATEUR(
        username VARCHAR(50) PRIMARY KEY,
        password VARCHAR(90) NOT NULL,
        symkey VARCHAR(30) NOT NULL,
        iv VARCHAR(90) NOT NULL,
        tag VARCHAR(90) NOT NULL
    );