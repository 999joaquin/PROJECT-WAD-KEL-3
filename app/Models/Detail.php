<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    use HasFactory;

    protected $fillable = ['patient_id', 'medical_record', 'disease', 'medication'];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
