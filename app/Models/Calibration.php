<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calibration extends Model
{
    use HasFactory;

    protected $fillable = [
        'calibration_date',
        'performed_by',
        'next_due_date',
        'status',
        'notes',
        'certificate',
        'device_id',
    ];

    protected $casts = [
        'calibration_date' => 'date',
        'next_due_date' => 'date',
    ];

    public function device()
    {
        return $this->belongsTo(Device::class);
    }

    public function performer()
    {
        return $this->belongsTo(User::class, 'performed_by');
    }
}
