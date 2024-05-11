<?php

namespace Saep\Percetakan\Controller\Admin;

use Saep\Percetakan\App\View;

class RestokController
{
    function restok()
    {
        View::render("Admin/Restok/Restok", []);
    }

}