<?php

namespace Tests\Feature;

use App\Models\Item;
use App\Models\Purchase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PurchaseTest extends TestCase
{
    use RefreshDatabase;

    /**
     * ID10：購入するボタンを押すと購入が完了する
     */
    public function test_user_can_purchase_item()
    {
        $this->seed();

        $user = User::find(1);
        $item = Item::find(6);

        $response = $this->actingAs($user)->post(
            route('purchase.store', $item->id),
            [
                'payment_method' => 'card',
            ]
        );

        $response->assertRedirect('/');

        $this->assertDatabaseHas('purchases', [
            'user_id' => $user->id,
            'item_id' => $item->id,
            'payment_method' => 'card',
        ]);
    }

    /**
     * ID10：購入した商品は商品一覧でSoldと表示される
     */
    public function test_purchased_item_is_displayed_as_sold()
    {
        $this->seed();

        $user = User::find(1);
        $item = Item::find(6);

        Purchase::create([
            'user_id' => $user->id,
            'item_id' => $item->id,
            'payment_method' => 'card',
            'shipping_postal_code' => $user->profile->postal_code,
            'shipping_address' => $user->profile->address,
            'shipping_building' => $user->profile->building,
        ]);

        $response = $this->actingAs($user)->get(route('item.index'));

        $response->assertSee('Sold');
    }

    /**
     * ID10：購入した商品が購入商品一覧に追加される
     */
    public function test_purchased_item_is_displayed_in_buy_list()
    {
        $this->seed();

        $user = User::find(1);
        $item = Item::find(6);

        Purchase::create([
            'user_id' => $user->id,
            'item_id' => $item->id,
            'payment_method' => 'card',
            'shipping_postal_code' => $user->profile->postal_code,
            'shipping_address' => $user->profile->address,
            'shipping_building' => $user->profile->building,
        ]);

        $response = $this->actingAs($user)->get('/mypage?page=buy');

        $response->assertSee($item->name);
    }

    /**
     * ID11：選択した支払い方法が購入処理に反映される
     */
    public function test_selected_payment_method_is_saved()
    {
        $this->seed();

        $user = User::find(1);
        $item = Item::find(6);

        $this->actingAs($user)->post(
            route('purchase.store', $item->id),
            [
                'payment_method' => 'convenience',
            ]
        );

        $this->assertDatabaseHas('purchases', [
            'user_id' => $user->id,
            'item_id' => $item->id,
            'payment_method' => 'convenience',
        ]);
    }

    /**
     * ID12：変更した住所が購入画面に反映される
     */
    public function test_updated_address_is_reflected_on_purchase_page()
    {
        $this->seed();

        $user = User::find(1);
        $item = Item::find(6);

        $this->actingAs($user)->patch(
            route('purchase.address.update', $item->id),
            [
                'postal_code' => '123-4567',
                'address' => '新潟市中央区テスト町1-1',
                'building' => 'テストビル101',
            ]
        );

        $response = $this->actingAs($user)->get(
            route('purchase.create', $item->id)
        );

        $response->assertSee('123-4567');
        $response->assertSee('新潟市中央区テスト町1-1');
        $response->assertSee('テストビル101');
    }

    /**
     * ID12：購入した商品に送付先住所が紐づいて保存される
     */
    public function test_shipping_address_is_saved_with_purchase()
    {
        $this->seed();

        $user = User::find(1);
        $item = Item::find(6);

        $this->actingAs($user)->patch(
            route('purchase.address.update', $item->id),
            [
                'postal_code' => '123-4567',
                'address' => '新潟市中央区テスト町1-1',
                'building' => 'テストビル101',
            ]
        );

        $this->actingAs($user)->post(
            route('purchase.store', $item->id),
            [
                'payment_method' => 'card',
            ]
        );

        $this->assertDatabaseHas('purchases', [
            'user_id' => $user->id,
            'item_id' => $item->id,
            'shipping_postal_code' => '123-4567',
            'shipping_address' => '新潟市中央区テスト町1-1',
            'shipping_building' => 'テストビル101',
        ]);
    }
}
