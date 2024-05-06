-- CREATE DATABASE business_demo COLLATE cp1251_general_ci; 

USE business_demo;

CREATE TABLE users(
	id VARCHAR(36) DEFAULT (UUID()) PRIMARY KEY, 
    username VARCHAR(50) NOT NULL UNIQUE, 
    email VARCHAR(50) NOT NULL UNIQUE, 
    password VARCHAR(70) NOT NULL,
    role VARCHAR(10) DEFAULT("user"),
    verification_code VARCHAR(30) NOT NUll,
    email_verified_at DATETIME NULL,
    created_at DATETIME DEFAULT NOW()
); 

CREATE TABLE team(
	id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100),
    title VARCHAR(60),
    imgURL VARCHAR(40)
); 

CREATE TABLE partners(
	id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100),
    title VARCHAR(60),
    imgURL VARCHAR(60)
); 

CREATE TABLE content(
	id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100),
    title TEXT,
    imgURL VARCHAR(60)
);
