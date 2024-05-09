<?php

namespace Saep\Percetakan\Controller\Admin;

use Saep\Percetakan\App\View;

class RIwayatController
{
    function pembelian()
    {
        View::render("Admin/Riwayat/pembelian", []);
    }

    function mensuplai()
    {
        View::render("Admin/Riwayat/mensuplai", []);
    }
}