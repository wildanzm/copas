<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Node extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'type', 'order_index', 'video_url'];

    public function questions(): HasMany
    {
        return $this->hasMany(Question::class);
    }

    public function progress(): HasMany
    {
        return $this->hasMany(StudentProgress::class);
    }
}
