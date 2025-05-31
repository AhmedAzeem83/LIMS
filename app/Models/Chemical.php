<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chemical extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'cas_number',
        'category',
        'quantity',
        'unit',
        'location',
        'expiry_date',
        'msds_file',
        'lab_id',
    ];

    protected $casts = [
        'expiry_date' => 'date',
    ];

    public function lab()
    {
        return $this->belongsTo(Lab::class);
    }

    public function isExpired()
    {
        return now()->greaterThan($this->expiry_date);
    }

    public function isLowStock()
    {
        return $this->quantity < 10; // Threshold can be adjusted
    }
}
