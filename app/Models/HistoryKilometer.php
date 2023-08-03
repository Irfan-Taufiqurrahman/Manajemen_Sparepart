<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryKilometer extends Model
{
    use HasFactory;

    protected $fillable = [
        'number',
        'vehicle_id',
        'part_id',
        'image',
        'file_service_evidence',
    ];

    public function list_vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function show_vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_id');
    }

    public function listPart()
    {
        return $this->belongsTo(Part::class);
    }

    public function show_part()
    {
        return $this->belongsTo(Part::class, 'part_id');
    }
}
