<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{
    /**
     * 商品購入画面を表示する
     */
    public function create($item_id)
    {
        $item = Item::findOrFail($item_id);

        return view('purchase.create', compact('item'));
    }
}
