<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Saep\Percetakan\App\Router;
use Saep\Percetakan\Config\Database;
use Saep\Percetakan\Middleware\MustAdminMiddlewere;
use Saep\Percetakan\Middleware\MustLoginMiddleware;
use Saep\Percetakan\Middleware\MustNotLoginMiddleware;

Database::getConnection('prod');

Router::add('GET', '/', \Saep\Percetakan\Controller\HomeController::class, 'index', []);

Router::add('GET', '/login', \Saep\Percetakan\Controller\UserController::class, 'login', [MustNotLoginMiddleware::class]);
Router::add('POST', '/login', \Saep\Percetakan\Controller\UserController::class, 'postLogin', [MustNotLoginMiddleware::class]);
Router::add('GET', '/logout', \Saep\Percetakan\Controller\UserController::class, 'logout', [MustLoginMiddleware::class]);


Router::add('GET', '/dashboard/managemen/barang', \Saep\Percetakan\Controller\Admin\ManagemenController::class, 'barang', [MustLoginMiddleware::class, MustAdminMiddlewere::class]);
Router::add('POST', '/dashboard/managemen/barang', \Saep\Percetakan\Controller\Admin\ManagemenController::class, 'PUBarang', [MustLoginMiddleware::class, MustAdminMiddlewere::class]);

Router::add('GET', '/dashboard/managemen/jasa', \Saep\Percetakan\Controller\Admin\ManagemenController::class, 'jasa', [MustLoginMiddleware::class, MustAdminMiddlewere::class]);
Router::add('POST', '/dashboard/managemen/jasa', \Saep\Percetakan\Controller\Admin\ManagemenController::class, 'PUBarang', [MustLoginMiddleware::class, MustAdminMiddlewere::class]);

Router::add('GET', '/dashboard/managemen/barangjasa/delete', \Saep\Percetakan\Controller\Admin\ManagemenController::class, 'deleteBarangJasa', [MustLoginMiddleware::class, MustAdminMiddlewere::class]);

Router::add('GET', '/dashboard/managemen/karyawan', \Saep\Percetakan\Controller\Admin\ManagemenController::class, 'karyawan', [MustLoginMiddleware::class, MustAdminMiddlewere::class]);
Router::add('POST', '/dashboard/managemen/karyawan', \Saep\Percetakan\Controller\Admin\ManagemenController::class, 'PUKaryawan', [MustLoginMiddleware::class, MustAdminMiddlewere::class]);
Router::add('GET', '/dashboard/managemen/karyawan/delete', \Saep\Percetakan\Controller\Admin\ManagemenController::class, 'deleteKaryawan', [MustLoginMiddleware::class, MustAdminMiddlewere::class]);

Router::add('GET', '/dashboard/riwayat/pembelian', \Saep\Percetakan\Controller\Admin\RiwayatController::class, 'pembelian', [MustLoginMiddleware::class, MustAdminMiddlewere::class]);
Router::add('GET', '/dashboard/riwayat/mensuplai', \Saep\Percetakan\Controller\Admin\RiwayatController::class, 'mensuplai', [MustLoginMiddleware::class, MustAdminMiddlewere::class]);

Router::add('GET', '/dashboard/riwayat/mensuplai/delete', \Saep\Percetakan\Controller\Admin\RiwayatController::class, 'deleteSupplier', [MustLoginMiddleware::class, MustAdminMiddlewere::class]);

Router::add('GET', '/dashboard/riwayat/pembelian', \Saep\Percetakan\Controller\Admin\RiwayatController::class, 'pembelian', [MustLoginMiddleware::class, MustAdminMiddlewere::class]);
Router::add('GET', '/dashboard/riwayat/pembelian/get', \Saep\Percetakan\Controller\Admin\RiwayatController::class, 'getDetailBarangJasa', [MustLoginMiddleware::class, MustAdminMiddlewere::class]);
Router::add('GET', '/dashboard/riwayat/pembelian/delete', \Saep\Percetakan\Controller\Admin\RiwayatController::class, 'deletePembelian', [MustLoginMiddleware::class, MustAdminMiddlewere::class]);

Router::add('GET', '/dashboard/restok/restok', \Saep\Percetakan\Controller\Admin\RestokController::class, 'restok', [MustLoginMiddleware::class, MustAdminMiddlewere::class]);
Router::add('POST', '/dashboard/restok/restok/post', \Saep\Percetakan\Controller\Admin\RestokController::class, 'restokPost', [MustLoginMiddleware::class, MustAdminMiddlewere::class]);

// karyawan
Router::add('GET', '/dashboard/kasir', \Saep\Percetakan\Controller\Karyawan\KasirController::class, 'kasir', [MustLoginMiddleware::class]);

Router::add('POST', '/dashboard/kasir/post', \Saep\Percetakan\Controller\Karyawan\KasirController::class, 'postKasir', [MustLoginMiddleware::class]);

Router::run();