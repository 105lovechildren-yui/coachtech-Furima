<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ProfileRequest;

class ProfileController extends Controller
{
    //マイページ（表示）
    public function index()
    {
        $user = Auth::user();

        if (request('page') === 'buy') {
            //購入した商品
            $purchases = $user->purchases;

            $items = $purchases->map(function ($purchase) {
                return $purchase->item;
            });
        } else {
            //出品した商品
            $items = $user->items;
        }

        return view('profile.mypage', compact('user', 'items'));
    }

    //初回登録時のプロフィール設定画面
    public function edit()
    {
        $user = Auth::user();

        return view('profile.edit', compact('user'));
    }

    //プロフィール更新処理
    public function update(ProfileRequest $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $profile = $user->profile;

        $validated = $request->validated();

        if ($profile === null) {
            $profile = $user->profile()->create([
                'nickname' => $validated['nickname'],
                'postal_code' => $validated['postal_code'],
                'address' => $validated['address'],
                'building' => $validated['building'] ?? null,
                'profile_image' => $request->file('profile_image')
                    ? $request->file('profile_image')->store('profile_images', 'public')
                    : null,
            ]);
        } else {
            $profile->nickname = $validated['nickname'];
            $profile->postal_code = $validated['postal_code'];
            $profile->address = $validated['address'];
            $profile->building = $validated['building'] ?? null;

            if ($request->file('profile_image')) {
                $profile->profile_image = $request->file('profile_image')
                    ->store('profile_images', 'public');
            }

            $profile->save();
        }

        return redirect()
            ->route('item.index')
            ->with('success', 'プロフィールを更新しました。');
    }
}
