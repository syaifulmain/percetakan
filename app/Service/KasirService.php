<?php

namespace Saep\Percetakan\Service;

use Saep\Percetakan\Model\Kasir\KasirRequest;

interface KasirService
{
    function create(KasirRequest $kasirRequest): void;

}