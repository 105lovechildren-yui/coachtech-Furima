<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;

class ItemController extends Controller
{
    /**
     * 商品一覧を表示する
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check()) {
            // ログインしている場合は、商品一覧(出品商品を除く)を取得する処理を追加する
            $items = Item::where('user_id', '!=', Auth::id())->get();
        } else {
            // ログインしていない場合は、全ての商品を取得
            $items = Item::all();
        }

        return view('item.index', compact('items'));
    }

    /**
     * 商品出品フォームを表示する
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('item.create');
    }

    /**
     * 商品を出品する
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return redirect()->route('item.index');
    }

    /**
     * 商品詳細を表示する
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('item.show');
    }
}
