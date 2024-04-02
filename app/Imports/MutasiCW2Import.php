<?php

namespace App\Imports;

use App\Models\MutasiCW2;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MutasiCW2Import implements ToModel, WithMultipleSheets, WithHeadingRow, WithValidation
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
        if (!array_filter($row)) {
            return null;
        }

        return new MutasiCW2([
            'no_kertas' => $row['no_kertas'],
            'site_id' => $row['site_id'],
            'site_name' => $row['site_name'],
            'tag_bin_location' => $row['tag_bin_location'],
            'area' => $row['area'],
            'zone' => $row['zone'],
            'status' => $row['status']
        ]);
    }

    public function rules(): array
    {
        return [
            'no_kertas' => 'required',
            'site_id' => 'required',
            'site_name' => 'required',
            'tag_bin_location' => 'required',
            'area' => 'required',
            'zone' => 'required',
            'status' => 'required',
        ];
    }

    public function sheets(): array
    {
        return [
            $this->index_sheet => $this,
        ];
    }
}
