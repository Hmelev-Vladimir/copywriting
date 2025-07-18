<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'pic',
        'name',
        'surname',
        'login',
        'phone',
        'role',
        'email',
        'image',
        'password',
        'balance',
    ];

        /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Поля для сериализации.
     */
    protected $appends = ['full_name'];

    /**
     * Полное имя пользователя.
     */
    protected function fullName(): Attribute
    {
        return Attribute::make(
            get: function () {
                $fullName = $this->surname . ' ' . $this->name;
                if ($this->patronymic !== null) {
                    $fullName .= ' ' . $this->patronymic;
                }
                return $fullName;
            },
        );
    }

    /**
     * Заявки, которые создал пользователь.
     */
    public function applications(): HasMany
    {
        return $this->hasMany(Application::class);
    }
}
