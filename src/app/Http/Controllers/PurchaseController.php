<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AddressRequest;
use App\Http\Requests\PurchaseRequest;
use App\Models\Purchase;

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

    /**
     * 商品を購入する
     */
    public function store(PurchaseRequest $request, $item_id)
    {
        $item = Item::with('purchase')->findOrFail($item_id);

        if ($item->purchase) {
            return redirect()->route('item.show', $item_id);
        }

        $validated = $request->validated();
        $profile = Auth::user()->profile;

        Purchase::create([
            'user_id' => Auth::id(),
            'item_id' => $item_id,
            'payment_method' => $validated['payment_method'],
            'shipping_postal_code' => $profile->postal_code,
            'shipping_address' => $profile->address,
            'shipping_building' => $profile->building,
        ]);

        return redirect('/');
    }
}
