CREATE DATABASE crud_demo;
USE crud_demo;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(100),
    last_name VARCHAR(100),
    email VARCHAR(150),
    password VARCHAR(255),
    profile_image VARCHAR(255),
    address TEXT,
    phone VARCHAR(20),
    gender VARCHAR(10),
    hobby VARCHAR(255),
    country VARCHAR(100)
);
