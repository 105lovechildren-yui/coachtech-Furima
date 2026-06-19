<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    /**
     * 一括代入可能なホワイトリスト。
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'item_id',
    ];

    /**
     * リレーションシップ: Like belongs to User.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * リレーションシップ: Like belongs to Item.
     */
    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
