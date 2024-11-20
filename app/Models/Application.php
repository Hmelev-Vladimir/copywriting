<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'theme',
        'price',
        'description',
        'status',
        'reason',
        'publicationDate',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
