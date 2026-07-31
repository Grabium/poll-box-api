<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable; 
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['poll_id', 'description', 'votes'])]
class Alternative extends Model
{
    /** @use HasFactory<\Database\Factories\GroupFactory> */
    use HasFactory;

    public function poll(): BelongsTo
    {
        return $this->belongsTo(
            Poll::class,   // 1. Model relacionada
        );
    }

}
