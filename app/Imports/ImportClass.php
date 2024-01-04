<?php
namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToArray;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ImportClass implements ToArray, WithHeadingRow
{
    protected $data = [];

    public function array(array $row)
    {
        $this->data[] = $row;
    }

    public function getData()
    {
        return $this->data;
    }
}
