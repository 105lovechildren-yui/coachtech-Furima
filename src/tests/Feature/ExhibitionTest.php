<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Condition;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;

class ExhibitionTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    /** @test */
    public function 商品を出品できる()
    {
        $user = User::find(1);
        $condition = Condition::find(1);
        $category = Category::find(1);

        $response = $this->actingAs($user)
            ->post('/sell', [
                'name' => 'テスト商品',
                'description' => 'テスト商品の説明です',
                'price' => 15000,
                'condition_id' => $condition->id,
                'categories' => [$category->id],
                'brand_name' => 'テストブランド',
                'image' => UploadedFile::fake()->create('test.jpg', 100, 'image/jpeg'),
            ]);

        $response->assertRedirect();

        $this->assertDatabaseHas('items', [
            'user_id' => $user->id,
            'name' => 'テスト商品',
            'description' => 'テスト商品の説明です',
            'price' => 15000,
            'condition_id' => $condition->id,
        ]);
    }
}
