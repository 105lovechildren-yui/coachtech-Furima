<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
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
        'content',
    ];
    /**
     * リレーションシップ: Comment belongs to User.
     */
    public function user() 
    {
        return $this->belongsTo(User::class);
    }

    /**
     * リレーションシップ: Comment belongs to Item.
     */
    public function item()
    {
        return $this->belongsTo(Item::class);
    }
    
}
