<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MutasiD3 extends Model
{
    public $table = "mutasi_d3s";
    use HasFactory;

    protected $fillable = [
        'no_kertas',
        'site_id',
        'site_name',
        'tag_bin_location',
        'area',
        'zone',
        'status'
    ];
}
