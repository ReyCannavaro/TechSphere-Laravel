<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Rating extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'gadget_id',
        'rating',
        'comment',
    ];

    // Relasi ke User yang memberikan rating
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Gadget yang diberi rating
    public function gadget(): BelongsTo
    {
        return $this->belongsTo(Gadget::class);
    }
}