<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'model',
        'serial_number',
        'manufacturer',
        'purchase_date',
        'last_calibration_date',
        'next_calibration_date',
        'status',
        'lab_id',
    ];

    protected $casts = [
        'purchase_date' => 'date',
        'last_calibration_date' => 'date',
        'next_calibration_date' => 'date',
    ];

    public function lab()
    {
        return $this->belongsTo(Lab::class);
    }

    public function calibrations()
    {
        return $this->hasMany(Calibration::class);
    }

    public function tests()
    {
        return $this->hasMany(Test::class);
    }

    public function needsCalibration()
    {
        return now()->greaterThanOrEqualTo($this->next_calibration_date);
    }
}
