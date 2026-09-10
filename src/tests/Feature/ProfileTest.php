<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    /** @test */
    public function プロフィールページに必要な情報が表示される()
    {
        $user = User::find(1);

        $response = $this->actingAs($user)
            ->get('/mypage');

        $response->assertStatus(200);

        $response->assertSee($user->name);

        $response->assertSee('出品した商品');
        $response->assertSee('購入した商品');
    }

    /** @test */
    public function プロフィール編集画面に過去の情報が初期値として表示される()
    {
        $user = User::find(1);
        $profile = $user->profile;

        $response = $this->actingAs($user)
            ->get('/mypage/profile');

        $response->assertStatus(200);

        $response->assertSee($profile->nickname);
        $response->assertSee($profile->postal_code);
        $response->assertSee($profile->address);

        if ($profile->building) {
            $response->assertSee($profile->building);
        }
    }
}
