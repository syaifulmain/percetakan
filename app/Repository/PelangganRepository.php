<?php

namespace Saep\Percetakan\Repository;


use Saep\Percetakan\Domain\Pelanggan;

interface PelangganRepository
{
   function save(Pelanggan $pelanggan): void;

   function getLastIdByNama(string $nama): int;
}