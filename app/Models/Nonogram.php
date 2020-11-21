<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Nonogram extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'img', 'width', 'height', 'color'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
