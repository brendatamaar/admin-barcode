<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MutasiTagBin1 extends Model
{
    use HasFactory;

    protected $fillable = [
        'site_id',
        'site_name',
        'tag_bin_location',
        'area',
        'zone',
        'status'
    ];
}
