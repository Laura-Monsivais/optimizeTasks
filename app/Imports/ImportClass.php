<?php

namespace App\Imports;

use App\Models\Family;
use App\Models\TemporaryTable;
use Maatwebsite\Excel\Concerns\ToArray;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ImportClass implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new TemporaryTable(['data' => $row]);
    }
}
