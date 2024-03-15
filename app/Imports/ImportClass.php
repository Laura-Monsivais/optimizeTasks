<?php

namespace App\Imports;

use App\Models\TemporaryTable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ImportClass implements ToModel, WithHeadingRow
{
    protected $casts = [
        'data' => 'json',
    ];
    public function model(array $row)
    {
        $jsonData = $row;
        $jsonData['id'] = 1000; 
        $jsonData = json_encode($row);
        return TemporaryTable::create(['data' => $jsonData]);
    }
}
