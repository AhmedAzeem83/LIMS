<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use HasFactory;

    protected $fillable = [
        'test_type',
        'method',
        'status',
        'started_at',
        'completed_at',
        'results',
        'notes',
        'sample_id',
        'device_id',
        'assigned_to',
        'approved_by',
        'lab_id',
    ];

    protected $casts = [
        'started_at' => 'datetime',
        'completed_at' => 'datetime',
        'results' => 'array',
    ];

    public function sample()
    {
        return $this->belongsTo(Sample::class);
    }

    public function device()
    {
        return $this->belongsTo(Device::class);
    }

    public function assignedUser()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function lab()
    {
        return $this->belongsTo(Lab::class);
    }

    public function reports()
    {
        return $this->hasMany(Report::class);
    }

    public function getStatusBadgeAttribute()
    {
        return match($this->status) {
            'pending' => 'badge bg-warning',
            'in_progress' => 'badge bg-info',
            'completed' => 'badge bg-success',
            'approved' => 'badge bg-primary',
            'rejected' => 'badge bg-danger',
            default => 'badge bg-secondary',
        };
    }
}
