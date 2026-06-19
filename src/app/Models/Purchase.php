<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
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
        'payment_method',
        'shipping_postal_code',
        'shipping_address',
        'shipping_building',
    ];

    /**
     * リレーションシップ: Purchase belongs to User.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * リレーションシップ: Purchase belongs to Item.
     */
    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
