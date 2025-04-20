<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sector extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'district_id',
    ];

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function jobs()
    {
        return $this->hasMany(Job::class);
    }
}
