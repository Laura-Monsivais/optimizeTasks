<?php
namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToArray;

class ImportClass implements ToArray
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

