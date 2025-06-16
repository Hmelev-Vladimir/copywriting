<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    /**
     * Поля для автозаполнения.
     */
    protected $fillable = [
        'title',
        'theme',
        'price',
        'description',
        'status',
        'reason',
        'publicationDate',
        'cover',
    ];

    /**
     * Связи для загрузки.
     */
    protected $with = [
       'user',
    ];


    /**
     * Пользователь, который создал заявку.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
