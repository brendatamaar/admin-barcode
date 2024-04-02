<?php

namespace App\Imports;

use App\Models\MutasiTagBin3;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MutasiTagBin3Import implements ToModel, WithMultipleSheets, WithHeadingRow, WithValidation
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

        return new MutasiTagBin3([
            'site_id' => $row['no_kertas'],
            'site_name' => $row['site_id'],
            'tag_bin_location' => $row['site_name'],
            'area' => $row['tag_bin_location'],
            'zone' => $row['area'],
            'status' => $row['zone']
        ]);

    }

    public function rules(): array
    {
        return [
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
