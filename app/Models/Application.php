<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

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
        'text',
        'publicationDate',
        'cover',
    ];

    /**
     * Связи для загрузки.
     */
    protected $with = [
       'user',
       'executor',
    ];

    /**
     * Пользователь (исполнитель), который создал заявку.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Заказчик, который создал заявку.
     */
    public function executor(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Полнотекстовый поиск по полям модели.
     */
    public function scopeSearch(Builder $query, string $term): Builder
    {
        return $query->where(function($q) use ($term) {
            $q->where('title', 'like', "%{$term}%")
            ->orWhere('theme', 'like', "%{$term}%")
            ->orWhere('text', 'like', "%{$term}%")
            ->orWhere('description', 'like', "%{$term}%");
        });
    }

    /**
     * Фильтрует модели по уровню владения пользователями.
     */
    public function scopeFilterByUserType(Builder $query, string $type, $user): Builder
    {
        if ($user === null) {
            return $query;
        }

        $userId = $user->id;

        return $query->when($type === 'all-mine', function ($q) use ($userId) {
            $q->where(function ($query) use ($userId) {
                $query->where('user_id', $userId)
                    ->orWhere('executor_id', $userId);
            });
        })
        ->when($type === 'customer', function ($q) use ($userId) {
            $q->where('user_id', $userId);
        })
        ->when($type === 'executor', function ($q) use ($userId) {
            $q->where('executor_id', $userId);
        });
    }
}
