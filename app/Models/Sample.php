<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sample extends Model
{
    use HasFactory;

    protected $fillable = [
        'sample_id',
        'client_name',
        'sample_type',
        'collection_date',
        'received_date',
        'status',
        'notes',
        'lab_id',
        'created_by',
    ];

    protected $casts = [
        'collection_date' => 'date',
        'received_date' => 'date',
    ];

    public function lab()
    {
        return $this->belongsTo(Lab::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function tests()
    {
        return $this->hasMany(Test::class);
    }

    public function getStatusBadgeAttribute()
    {
        return match($this->status) {
            'pending' => 'badge bg-warning',
            'in_progress' => 'badge bg-info',
            'completed' => 'badge bg-success',
            'rejected' => 'badge bg-danger',
            default => 'badge bg-secondary',
        };
    }
}
