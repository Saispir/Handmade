CREATE DATABASE IF NOT EXISTS hm;
USE hm;

CREATE TABLE IF NOT EXISTS author (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fio VARCHAR(100) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    email VARCHAR(50) NOT NULL
);

CREATE TABLE IF NOT EXISTS material (
    id INT AUTO_INCREMENT PRIMARY KEY,
    m_name VARCHAR(30) NOT NULL
);

CREATE TABLE IF NOT EXISTS maden (
    id INT AUTO_INCREMENT PRIMARY KEY,
    price INT NOT NULL CHECK (price>0),
    m_name VARCHAR(30) NOT NULL,
    pic longblob NOT NULL,
    status ENUM('available', 'sold') NOT NULL DEFAULT('available'),

    author_id INT NOT NULL,

    FOREIGN KEY (author_id) REFERENCES author(id) ON UPDATE CASCADE ON DELETE RESTRICT
);

CREATE TABLE IF NOT EXISTS material_maden (
    usage_amount INT NOT NULL DEFAULT(0),

    maden_id INT NOT NULL,
    material_id INT NOT NULL,

    FOREIGN KEY (maden_id) REFERENCES maden(id) ON UPDATE CASCADE ON DELETE RESTRICT,
    FOREIGN KEY (material_id) REFERENCES material(id) ON UPDATE CASCADE ON DELETE RESTRICT
);

CREATE TABLE IF NOT EXISTS customer (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fio VARCHAR(100) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    email VARCHAR(50) NOT NULL
);

CREATE TABLE IF NOT EXISTS customer_maden (
    customer_id INT NOT NULL,
    maden_id INT NOT NULL,

    UNIQUE(maden_id),

    FOREIGN KEY (customer_id) REFERENCES customer(id) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (maden_id) REFERENCES maden(id) ON UPDATE CASCADE ON DELETE RESTRICT
);

CREATE TABLE IF NOT EXISTS customer_order (
    adress VARCHAR(255) NOT NULL,
    status ENUM('waiting', 'payed') NOT NULL DEFAULT('waiting'),

    customer_id INT NOT NULL,
    FOREIGN KEY (customer_id) REFERENCES customer(id) ON UPDATE CASCADE ON DELETE CASCADE
);