<?php

namespace App\Imports;

use App\Models\CrystalReport2;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class CrystalReport2Import implements ToModel, WithStartRow, WithMultipleSheets
{
    private $index_sheet = 0;

    public function __construct($index_sheet)
    {
        $this->index_sheet = $index_sheet - 1;
    }
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        //print_r($row);
        return new CrystalReport2([
            'no_kertas'     => $row[0],
            'site_id'    => $row[1],
            'site_name'    => $row[2],
            'tag_bin_location' => $row[3],
            'area' => $row[4],
            'zone' => $row[5],
            'status' => $row[6]
        ]);
    }

    public function sheets(): array
    {
        return [
            $this->index_sheet => $this,
        ];
    }

    public function startRow(): int
    {
        return 2; // Skip the first row
    }
}
