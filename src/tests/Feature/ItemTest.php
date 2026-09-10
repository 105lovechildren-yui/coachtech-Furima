<?php

namespace Tests\Feature;

use App\Models\Item;
use App\Models\Like;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ItemTest extends TestCase
{
    use RefreshDatabase;

    /**
     * ID4：商品一覧取得
     * 全商品が表示される
     */
    public function test_all_items_are_displayed()
    {
        $this->seed();

        $response = $this->get('/');

        $response->assertStatus(200);

        $response->assertSee('腕時計');
        $response->assertSee('HDD');
        $response->assertSee('玉ねぎ3束');
        $response->assertSee('革靴');
        $response->assertSee('ノートPC');
        $response->assertSee('マイク');
        $response->assertSee('ショルダーバッグ');
        $response->assertSee('タンブラー');
        $response->assertSee('コーヒーミル');
        $response->assertSee('メイクセット');
    }

    /**
     * ID4：商品一覧取得
     * 購入済み商品は「Sold」と表示される
     */
    public function test_purchased_item_is_displayed_as_sold()
    {
        $this->seed();

        $item = Item::find(1);

        $item->purchase()->create([
            'user_id' => 2,
            'payment_method' => 'コンビニ払い',
            'shipping_postal_code' => '123-4567',
            'shipping_address' => '東京都テスト区1-1-1',
            'shipping_building' => null,
        ]);

        $response = $this->get('/');

        $response->assertSee('腕時計');
        $response->assertSee('Sold');
    }

    /**
     * ID4：商品一覧取得
     * 自分が出品した商品は表示されない
     */
    public function test_user_own_items_are_not_displayed()
    {
        $this->seed();

        $user = User::find(1);

        $response = $this->actingAs($user)->get('/');

        $response->assertDontSee('腕時計');
        $response->assertDontSee('HDD');
        $response->assertSee('マイク');
    }

    /**
     * ID5：マイリスト一覧取得
     * いいねした商品だけが表示される
     */
    public function test_mylist_displays_liked_items_only()
    {
        $this->seed();

        $user = User::find(1);
        $likedItem = Item::find(6);

        Like::create([
            'user_id' => $user->id,
            'item_id' => $likedItem->id,
        ]);

        $response = $this->actingAs($user)->get('/?tab=mylist');

        $response->assertSee('マイク');
        $response->assertDontSee('ショルダーバッグ');
    }

    /**
     * ID5：マイリスト一覧取得
     * 購入済み商品は「Sold」と表示される
     */
    public function test_purchased_mylist_item_is_displayed_as_sold()
    {
        $this->seed();

        $user = User::find(1);
        $item = Item::find(6);

        Like::create([
            'user_id' => $user->id,
            'item_id' => $item->id,
        ]);

        $item->purchase()->create([
            'user_id' => $user->id,
            'payment_method' => 'コンビニ払い',
            'shipping_postal_code' => '123-4567',
            'shipping_address' => '東京都テスト区1-1-1',
            'shipping_building' => null,
        ]);

        $response = $this->actingAs($user)->get('/?tab=mylist');

        $response->assertSee('マイク');
        $response->assertSee('Sold');
    }

    /**
     * ID5：マイリスト一覧取得
     * 未認証の場合は何も表示されない
     */
    public function test_guest_cannot_access_mylist()
    {
        $this->seed();

        $response = $this->get('/?tab=mylist');

        $response->assertRedirect(route('login'));
    }

    /**
     * ID6：商品検索機能
     * 商品名で部分一致検索ができる
     */
    public function test_items_can_be_searched_by_name()
    {
        $this->seed();

        $response = $this->get('/?keyword=時計');

        $response->assertSee('腕時計');
        $response->assertDontSee('HDD');
    }

    /**
     * ID6：商品検索機能
     * 検索状態がマイリストでも保持される
     */
    public function test_search_keyword_is_kept_in_mylist()
    {
        $this->seed();

        $user = User::find(1);
        $item = Item::find(6);

        Like::create([
            'user_id' => $user->id,
            'item_id' => $item->id,
        ]);

        $response = $this->actingAs($user)
            ->get('/?tab=mylist&keyword=マイク');

        $response->assertSee('マイク');
        $response->assertDontSee('ショルダーバッグ');
    }

    /**
     * ID7：商品詳細情報取得
     * 必要な情報が表示される
     */
    public function test_item_detail_displays_required_information()
    {
        $this->seed();

        $user = User::find(2);
        $item = Item::find(1);

        Like::create([
            'user_id' => $user->id,
            'item_id' => $item->id,
        ]);

        $user->comments()->create([
            'item_id' => $item->id,
            'content' => 'テストコメントです',
        ]);

        $response = $this->get('/item/1');

        $response->assertStatus(200);

        $response->assertSee('腕時計');
        $response->assertSee('Rolax');
        $response->assertSee('¥15,000');
        $response->assertSee('スタイリッシュなデザインのメンズ腕時計');
        $response->assertSee('ファッション');
        $response->assertSee('メンズ');
        $response->assertSee('テストコメントです');
    }

    /**
     * ID7：商品詳細情報取得
     * 複数選択されたカテゴリが表示される
     */
    public function test_item_detail_displays_multiple_categories()
    {
        $this->seed();

        $response = $this->get('/item/1');

        $response->assertSee('ファッション');
        $response->assertSee('メンズ');
    }

    /**
     * ID8：いいね機能
     * いいね登録・いいね数増加
     */
    public function test_user_can_like_item()
    {
        $this->seed();

        $user = User::find(1);
        $item = Item::find(6);

        $response = $this->actingAs($user)
            ->post("/item/{$item->id}/like");

        $response->assertStatus(200);

        $this->assertDatabaseHas('likes', [
            'user_id' => $user->id,
            'item_id' => $item->id,
        ]);

        $response->assertJson([
            'isLiked' => true,
            'likeCount' => 1,
        ]);
    }

    /**
     * ID8：いいね機能
     * いいね解除・いいね数減少
     */
    public function test_user_can_unlike_item()
    {
        $this->seed();

        $user = User::find(1);
        $item = Item::find(6);

        Like::create([
            'user_id' => $user->id,
            'item_id' => $item->id,
        ]);

        $response = $this->actingAs($user)
            ->post("/item/{$item->id}/like");

        $response->assertStatus(200);

        $this->assertDatabaseMissing('likes', [
            'user_id' => $user->id,
            'item_id' => $item->id,
        ]);

        $response->assertJson([
            'isLiked' => false,
            'likeCount' => 0,
        ]);
    }

    /**
     * ID9：コメント送信機能
     * ログイン済みユーザーはコメントを送信できる
     */
    public function test_user_can_comment()
    {
        $this->seed();

        $user = User::find(1);
        $item = Item::find(6);

        $response = $this->actingAs($user)
            ->post("/item/{$item->id}/comment", [
                'comment' => 'テストコメントです',
            ]);

        $response->assertRedirect(route('item.show', $item->id));

        $this->assertDatabaseHas('comments', [
            'user_id' => $user->id,
            'item_id' => $item->id,
            'content' => 'テストコメントです',
        ]);
    }

    /**
     * ID9：コメント送信機能
     * ログイン前のユーザーはコメントを送信できない
     */
    public function test_guest_cannot_comment()
    {
        $this->seed();

        $response = $this->post('/item/6/comment', [
            'comment' => 'テストコメントです',
        ]);

        $response->assertRedirect(route('login'));
    }

    /**
     * ID9：コメント送信機能
     * コメント未入力の場合、バリデーションエラーになる
     */
    public function test_comment_is_required()
    {
        $this->seed();

        $user = User::find(1);
        $item = Item::find(6);

        $response = $this->actingAs($user)
            ->post("/item/{$item->id}/comment", [
                'comment' => '',
            ]);

        $response->assertSessionHasErrors('comment');
    }

    /**
     * ID9：コメント送信機能
     * コメントが255文字を超える場合、バリデーションエラーになる
     */
    public function test_comment_cannot_exceed_255_characters()
    {
        $this->seed();

        $user = User::find(1);
        $item = Item::find(6);

        $response = $this->actingAs($user)
            ->post("/item/{$item->id}/comment", [
                'comment' => str_repeat('あ', 256),
            ]);

        $response->assertSessionHasErrors('comment');
    }
}
