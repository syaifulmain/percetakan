<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Saep\Percetakan\App\Router;
use Saep\Percetakan\Config\Database;
use Saep\Percetakan\Middleware\MustNotLoginMiddleware;

Database::getConnection('prod');

Router::add('GET', '/', \Saep\Percetakan\Controller\HomeController::class, 'index', []);

Router::add('GET', '/login', \Saep\Percetakan\Controller\LoginController::class, 'login', [MustNotLoginMiddleware::class]);
Router::add('POST', '/login', \Saep\Percetakan\Controller\LoginController::class, 'postLogin', [MustNotLoginMiddleware::class]);


Router::add('GET', '/dashboard/managemen/barang', \Saep\Percetakan\Controller\Admin\ManagemenController::class, 'barang', []);
Router::add('POST', '/dashboard/managemen/barang', \Saep\Percetakan\Controller\Admin\ManagemenController::class, 'PUBarang', []);

Router::add('GET', '/dashboard/managemen/barangjasa/delete', \Saep\Percetakan\Controller\Admin\ManagemenController::class, 'deleteBarangJasa', []);

Router::add('GET', '/dashboard/managemen/jasa', \Saep\Percetakan\Controller\Admin\ManagemenController::class, 'jasa', []);
Router::add('GET', '/dashboard/managemen/karyawan', \Saep\Percetakan\Controller\Admin\ManagemenController::class, 'karyawan', []);

Router::add('GET', '/dashboard/riwayat/pembelian', \Saep\Percetakan\Controller\Admin\RIwayatController::class, 'pembelian', []);
Router::add('GET', '/dashboard/riwayat/mensuplai', \Saep\Percetakan\Controller\Admin\RIwayatController::class, 'mensuplai', []);
// User Controller

Router::run();