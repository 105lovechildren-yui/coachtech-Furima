<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ProfileController extends Controller
{
    //マイページ（表示）
    public function index()
    {
        $user = Auth::user();
        $items = $user->items;

        return view('profile.mypage', compact('user', 'items'));
    }

    //初回登録時のプロフィール設定画面
    public function edit()
    {
        $user = Auth::user();

        return view('profile.edit', compact('user'));
    }

    //プロフィール更新処理
    public function update(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $profile = $user->profile;

        if ($profile === null) {
            $profile = $user->profile()->create([
                'nickname' => $request->input('nickname'),
                'postal_code' => $request->input('postal_code'),
                'address' => $request->input('address'),
                'building' => $request->input('building'),
                'profile_image' => $request->file('profile_image') ? $request->file('profile_image')->store('profile_images', 'public') : null,
            ]);
        } else {
            $profile->nickname = $request->input('nickname');
            $profile->postal_code = $request->input('postal_code');
            $profile->address = $request->input('address');
            $profile->building = $request->input('building');
            $profile->profile_image = $request->file('profile_image') ? $request->file('profile_image')->store('profile_images', 'public') : $profile->profile_image;
            $profile->save();
        }

        return redirect()->route('item.index')->with('success', 'プロフィールを更新しました。');
    }
}
