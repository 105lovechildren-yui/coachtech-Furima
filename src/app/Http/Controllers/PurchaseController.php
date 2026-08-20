<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AddressRequest;

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
    public function update(AddressRequest $request, $item_id)
    {
        $profile = Auth::user()->profile;

        $profile->update($request->validated());

        return redirect()->route('purchase.create', $item_id);
    }
}
