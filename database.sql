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

create table barang_jasa
(
    kode  varchar(100) primary key not null unique,
    nama  varchar(100)             not null,
    stok  int,
    harga int,
    jenis ENUM ('barang', 'jasa')
);

create table karyawan
(
    username varchar(100) not null unique,
    nama     varchar(100) not null,
    alamat   varchar(100),
    no_telp  varchar(100)
);

ALTER TABLE karyawan
    ADD FOREIGN KEY fk_karyawan_users (username) REFERENCES users (username);

ALTER TABLE users
    ADD role ENUM ('admin', 'karyawan') DEFAULT 'karyawan';

create table pelanggan
(
    id      int primary key not null,
    nama    varchar(100)    not null,
    no_telp varchar(100)
);

ALTER TABLE pelanggan
    MODIFY COLUMN id INT auto_increment;

create table pembelian
(
    no_transaksi VARCHAR(50) primary key not null,
    id_pelanggan int                     not null,
    id_karyawan  varchar(100)            not null,
    tanggal      date                    not null,
    bayar        decimal(10, 2)          not null
);

desc pembelian;

ALTER TABLE pembelian
    ADD FOREIGN KEY fk_pembelian_pelanggan (id_pelanggan) REFERENCES pelanggan (id),
    ADD FOREIGN KEY fk_pembelian_karyawan (id_karyawan) REFERENCES karyawan (username);

create table detail_pembelian(
    no_transaksi VARCHAR(50) not null,
    kode_barang  varchar(100) not null,
    jumlah       int          not null,
    harga        decimal(10, 2) not null
);

alter table detail_pembelian
add FOREIGN KEY fk_detail_pembelian_pembelian (no_transaksi) REFERENCES pembelian (no_transaksi),
add FOREIGN KEY fk_detail_pembelian_barang_jasa (kode_barang) REFERENCES barang_jasa (kode);

# drop table detail_pembelian;
# drop table pembelian;
# drop table pelanggan;

select * from pelanggan;

insert into karyawan (username, nama, alamat, no_telp) values ('admin', 'admin', 'alamat', 'no_telp');

select * from detail_pembelian;

select * from users;