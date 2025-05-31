<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'lab_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Get the lab that the user belongs to.
     */
    public function lab()
    {
        return $this->belongsTo(Lab::class);
    }

    /**
     * Get the samples created by the user.
     */
    public function samples()
    {
        return $this->hasMany(Sample::class, 'created_by');
    }

    /**
     * Get the tests assigned to the user.
     */
    public function assignedTests()
    {
        return $this->hasMany(Test::class, 'assigned_to');
    }

    /**
     * Check if user is an admin.
     */
    public function isAdmin()
    {
        return $this->hasRole('Admin');
    }

    /**
     * Check if user is a lab manager.
     */
    public function isLabManager()
    {
        return $this->hasRole('Lab Manager');
    }

    /**
     * Check if user is a chemist supervisor.
     */
    public function isChemistSupervisor()
    {
        return $this->hasRole('Chemist Supervisor');
    }

    /**
     * Check if user is a lab technician.
     */
    public function isLabTechnician()
    {
        return $this->hasRole('Lab Technician');
    }
}
