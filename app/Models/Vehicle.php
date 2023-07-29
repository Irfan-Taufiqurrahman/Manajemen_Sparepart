<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'colour',
        'tahun_pembuatan',
    ];

    public function Kilometers()
    {
        return $this->hasMany(Kilometer::class);
    }
}
