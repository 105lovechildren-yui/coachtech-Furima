<?php

namespace App\Http\Controllers;
use App\Http\Requests\CommentRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;
use App\Models\Like;
use App\Models\Comment;

class ItemController extends Controller
{
    /**
     * 商品一覧を表示する
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $keyword = request('keyword');

        if (request('tab') === 'mylist') {
            if (Auth::check()) {
                // ログインしている場合は、自分がいいねした商品を取得
                $items = Item::whereHas('likes', function ($query) {
                    $query->where('user_id', Auth::id());
                })
                    ->where('user_id', '!=', Auth::id())
                    ->get();
            } else {
                // ログインしていない場合は、ログイン画面にリダイレクトする
                return redirect()->route('login');
            }
        } else {
            // おすすめ商品を取得
            if (Auth::check()) {
                // ログインしている場合は、自分が出品した商品を除外して検索対象にする
                $items = Item::where('user_id', '!=', Auth::id());

                // 検索キーワードがある場合は、商品名にキーワードが含まれる商品を取得
                if ($keyword) {
                    $items->where('name', 'like', '%' . $keyword . '%');
                }
                // 条件に合う商品を取得
                $items = $items->get();
            } else {
                // ログインしていない場合は、全ての商品を対象にする
                $items = Item::query();

                // 検索キーワードがある場合は、商品名にキーワードが含まれる商品を取得
                if ($keyword) {
                    $items = $items->where('name', 'like', '%' . $keyword . '%');
                }
                $items = $items->get();

                // TODO: 商品詳細画面実装後、マイリストでも検索キーワードが保持されるよう実装・動作確認
            }
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
        $item = Item::findOrFail($id);

        $isLiked = false;

        // ログインしているユーザーがこの商品にいいねしているかどうかを判定
        if (Auth::check()) {
            $isLiked = $item->likes()
                ->where('user_id', Auth::id())
                ->exists();
        }

        return view('item.show', compact('item', 'isLiked'));
    }

    public function like($id)
    {
        $item = Item::findOrFail($id);

        $like = $item->likes()
            ->where('user_id', Auth::id())
            ->first();

        if ($like) {
            // すでにいいね済み → 解除
            $like->delete();
            $isLiked = false;
        } else {
            // まだいいねしていない → 登録
            $like = new Like();
            $like->user_id = Auth::id();
            $like->item_id = $item->id;
            $like->save();
            $isLiked = true;
        }

        $likeCount = $item->likes()->count();

        return response()->json(
            [
                'isLiked' => $isLiked,
                'likeCount' => $likeCount,
            ]
        );
    }

    public function comment(CommentRequest $request, $id)
    {
        $item = Item::findOrFail($id);

        $comment = new Comment();
        $comment->user_id = Auth::id();
        $comment->item_id = $item->id;
        $comment->content = $request->comment;
        $comment->save();

        return redirect()->route('item.show', $id);
    }
}
