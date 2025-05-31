<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lab extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'location',
        'description',
        'status',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function devices()
    {
        return $this->hasMany(Device::class);
    }

    public function chemicals()
    {
        return $this->hasMany(Chemical::class);
    }

    public function samples()
    {
        return $this->hasMany(Sample::class);
    }

    public function tests()
    {
        return $this->hasMany(Test::class);
    }
}
