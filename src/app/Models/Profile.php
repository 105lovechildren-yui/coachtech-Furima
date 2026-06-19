<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    /**
     * 一括代入可能なホワイトリスト。
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'nickname',
        'profile_image',
        'postal_code',
        'address',
        'building',
    ];

    /**
     * リレーションシップ: Profile belongs to User.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
