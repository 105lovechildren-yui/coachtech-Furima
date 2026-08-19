<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{
    /**
     * 商品購入画面を表示する
     */
    public function create($item_id)
    {
        $item = Item::findOrFail($item_id);
        $profile = Auth::user()->profile;

        return view('purchase.create', compact('item', 'profile'));
    }

    /**
     * 住所変更画面を表示する
     */
    public function edit($item_id)
    {
        $item = Item::findOrFail($item_id);
        $profile = Auth::user()->profile;

        return view('purchase.address', compact('item', 'profile'));
    }

    /**
     * 住所を更新する
     */
    public function update(Request $request, $item_id)
    {
        $profile = Auth::user()->profile;

        $profile->update([
            'postal_code' => $request->postal_code,
            'address' => $request->address,
            'building' => $request->building,
        ]);

        return redirect()->route('purchase.create', $item_id);
    }
}
