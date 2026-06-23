<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Item extends Model
{
    use HasFactory;

    /**
     * 一括代入可能なホワイトリスト。
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'condition_id',
        'name',
        'price',
        'brand_name',
        'description',
        'image_url',
    ];

    /**
     * リレーションシップ: Item belongs to User.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * リレーションシップ: Item belongs to Condition.
     */
    public function condition()
    {
        return $this->belongsTo(Condition::class);
    }

    /**
     * リレーションシップ: Item has many Likes.
     */
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    /**
     * リレーションシップ: Item has many Comments.
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * リレーションシップ: Item belongs to many Categories.
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    /**
     * リレーションシップ: Item has one purchase.
     */
    public function purchase()
    {
        return $this->hasOne(Purchase::class);
    }
}
