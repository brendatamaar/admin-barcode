<?php

namespace App\Imports;

use App\Models\MutasiTagBin1;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class MutasiTagBin1Import implements ToModel, WithStartRow, WithMultipleSheets
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
        return new MutasiTagBin1([
            'site_id'     => $row[0],
            'site_name'    => $row[1],
            'tag_bin_location' => $row[2],
            'area' => $row[3],
            'zone' => $row[4],
            'status' => $row[5]
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
