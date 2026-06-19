<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    /**
     * 一括代入可能なホワイトリスト。
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
    ];

    /**
     * リレーションシップ: Category belongs to many Items.
     */
    public function items()
    {
        return $this->belongsToMany(Item::class);
    }
}
