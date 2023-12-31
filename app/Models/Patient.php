<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'name', 'nim', 'date_of_birth', 'phone', 'address']; // JOAQUIN

    public function users(){
        return $this->belongsTo(User::class);
    }
}
