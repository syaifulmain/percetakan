CREATE DATABASE IF NOT EXISTS percetakan_db;

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
    bayar        decimal(10, 0)          not null
);

desc pembelian;

ALTER TABLE pembelian
    ADD FOREIGN KEY fk_pembelian_pelanggan (id_pelanggan) REFERENCES pelanggan (id),
    ADD FOREIGN KEY fk_pembelian_karyawan (id_karyawan) REFERENCES karyawan (username);

create table detail_pembelian
(
    no_transaksi VARCHAR(50)    not null,
    kode_barang  varchar(100)   not null,
    jumlah       int            not null,
    harga        decimal(10, 0) not null
);

alter table detail_pembelian
    add FOREIGN KEY fk_detail_pembelian_pembelian (no_transaksi) REFERENCES pembelian (no_transaksi),
    add FOREIGN KEY fk_detail_pembelian_barang_jasa (kode_barang) REFERENCES barang_jasa (kode);

create table supplier
(
    id       int primary key not null auto_increment,
    supplier varchar(100)    not null,
    barang   varchar(100)    not null,
    harga    decimal(10, 0)  not null,
    stok     int             not null,
    tanggal  date            not null
);

INSERT INTO percetakan_db.barang_jasa (kode, nama, stok, harga, jenis) VALUES ('B001', 'Buku', 7, 10000, 'barang');
INSERT INTO percetakan_db.barang_jasa (kode, nama, stok, harga, jenis) VALUES ('B002', 'Pensil', 20, 2000, 'barang');
INSERT INTO percetakan_db.barang_jasa (kode, nama, stok, harga, jenis) VALUES ('B003', 'Penghapus', 29, 3000, 'barang');
INSERT INTO percetakan_db.barang_jasa (kode, nama, stok, harga, jenis) VALUES ('B004', 'Penggaris', 38, 4000, 'barang');
INSERT INTO percetakan_db.barang_jasa (kode, nama, stok, harga, jenis) VALUES ('B005', 'Penggaris', 49, 5000, 'barang');
INSERT INTO percetakan_db.barang_jasa (kode, nama, stok, harga, jenis) VALUES ('B006', 'Kertas A4', 99, 500, 'barang');
INSERT INTO percetakan_db.barang_jasa (kode, nama, stok, harga, jenis) VALUES ('B007', 'Tinta Printer', 100, 200, 'barang');
INSERT INTO percetakan_db.barang_jasa (kode, nama, stok, harga, jenis) VALUES ('B008', 'Kertas Foto', 98, 1000, 'barang');
INSERT INTO percetakan_db.barang_jasa (kode, nama, stok, harga, jenis) VALUES ('J001', 'Cetak Foto', 22, 2000, 'jasa');
INSERT INTO percetakan_db.barang_jasa (kode, nama, stok, harga, jenis) VALUES ('J002', 'Cetak Dokumen', 20, 3000, 'jasa');
INSERT INTO percetakan_db.barang_jasa (kode, nama, stok, harga, jenis) VALUES ('J003', 'Cetak Brosur', 30, 3000, 'jasa');
INSERT INTO percetakan_db.barang_jasa (kode, nama, stok, harga, jenis) VALUES ('J004', 'Cetak Poster', 40, 4000, 'jasa');
INSERT INTO percetakan_db.barang_jasa (kode, nama, stok, harga, jenis) VALUES ('J005', 'Cetak Buku', 50, 5000, 'jasa');
INSERT INTO percetakan_db.barang_jasa (kode, nama, stok, harga, jenis) VALUES ('J006', 'Jasa Print', 100, 500, 'jasa');
INSERT INTO percetakan_db.barang_jasa (kode, nama, stok, harga, jenis) VALUES ('J007', 'Jasa Fotocopy', 100, 200, 'jasa');
INSERT INTO percetakan_db.barang_jasa (kode, nama, stok, harga, jenis) VALUES ('J008', 'Jasa Design', 100, 1000, 'jasa');



