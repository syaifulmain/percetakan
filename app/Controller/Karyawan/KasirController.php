<?php

namespace Saep\Percetakan\Controller\Karyawan;

use Saep\Percetakan\App\View;

class KasirController
{
    function kasir()
    {
        View::render("Karyawan/Kasir", [
        ]);
    }

}