<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicin extends Model
{
    use HasFactory;

    protected $table = 'medicin';

    protected $fillable = [
        'nama_obat',
        'harga',
        'deskripsi',
        'efek_samping',
        'golongan',
        'noregis',
        'stock'
    ];
}
