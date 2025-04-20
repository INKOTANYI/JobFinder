<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'category_id',
        'sector_id',
        'is_approved',
        'is_featured',
        'type',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function sector()
    {
        return $this->belongsTo(Sector::class);
    }
}
