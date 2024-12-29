CREATE DATABASE perpustakaan;
USE perpustakaan;

CREATE TABLE buku (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    judul VARCHAR(255) NOT NULL,
    penulis VARCHAR(255) NOT NULL,
    tahun INT(4) NOT NULL
);