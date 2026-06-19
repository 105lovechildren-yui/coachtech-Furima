<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * 一括代入可能なホワイトリスト。
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * シリアライズ時に非表示にする属性。
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * 型キャストする属性。
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * リレーションシップ: User has many Items.
     */
    public function items()
    {
        return $this->hasMany(Item::class);
    }

    /**
     * リレーションシップ: User has many Likes.
     */
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    /**
     * リレーションシップ: User has one Profile.
     */
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }
    /**
     * リレーションシップ: User has many Comments.
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * リレーションシップ: User has many Purchases.
     */
    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }
}
