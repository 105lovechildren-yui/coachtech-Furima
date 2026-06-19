<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Condition extends Model
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
     * リレーションシップ: Condition has many Items.
     */
    public function items()
    {
        return $this->hasMany(Item::class);
    }
}
