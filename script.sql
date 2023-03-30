DROP DATABASE IF EXISTS authentification_page;

CREATE DATABASE authentification_page;

USE authentification_page;

CREATE TABLE
    UTILISATEUR(
        username VARCHAR(50) PRIMARY KEY,
        password VARCHAR(60) NOT NULL
    );