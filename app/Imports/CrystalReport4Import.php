<?php

namespace App\Imports;

use App\Models\CrystalReport4;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CrystalReport4Import implements ToModel, WithMultipleSheets, WithHeadingRow, WithValidation
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

        return new CrystalReport4([
            'site_id' => $row['site_id'],
            'site_name' => $row['site_name'],
            'location' => $row['location'],
            'location_type' => $row['location_type'],
            'category' => $row['category'],
            'item_no' => $row['item_no'],
            'item_name' => $row['item_name'],
            'barcode' => $row['barcode'],
            'uom' => $row['uom']
        ]);
    }

    public function rules(): array
    {
        return [
            'site_id' => 'required',
            'site_name' => 'required',
            'location' => 'required',
            'location_type' => 'required',
            'category' => 'required',
            'item_no' => 'required',
            'item_name' => 'required',
            'barcode' => 'required',
            'uom' => 'required',
        ];
    }

    public function sheets(): array
    {
        return [
            $this->index_sheet => $this,
        ];
    }
}
