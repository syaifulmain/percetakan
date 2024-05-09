CREATE DATABASE IF NOT EXISTS percetakan_db;

CREATE DATABASE percetakan_db;

use percetakan_db;

create table users
(
    username varchar(100) primary key not null unique,
    password varchar(100)             not null,
    role     ENUM ('admin', 'karyawan')
);

insert into users
values ('admin', 'admin', 'admin');

CREATE TABLE sessions
(
    id       VARCHAR(255) PRIMARY KEY,
    username VARCHAR(100) NOT NULL
);

ALTER TABLE sessions
    ADD FOREIGN KEY fk_sessions_users (username) REFERENCES users (username);

show tables;

create table barang_jasa(
    kode varchar(100) primary key not null unique,
    nama varchar(100) not null,
    stok int,
    harga int,
    jenis ENUM ('barang', 'jasa')
);

create table karyawan(
    username varchar(100) not null unique,
    nama varchar(100) not null,
    alamat varchar(100),
    no_telp varchar(100)
);

ALTER TABLE karyawan
    ADD FOREIGN KEY fk_karyawan_users (username) REFERENCES users (username);
