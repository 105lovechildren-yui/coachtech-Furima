<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use App\Models\User;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    /**
     * ID1：会員登録機能
     * 正常に会員登録できる
     */
    public function test_user_can_register()
    {
        $response = $this->post('/register', [
            'name' => 'テストユーザー',
            'email' => 'test@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $this->assertDatabaseHas('users', [
            'name' => 'テストユーザー',
            'email' => 'test@example.com',
        ]);

        $response->assertRedirect('/email/verify');
    }

    /**
     * ID1：会員登録機能
     * 必須項目が未入力の場合、バリデーションエラーになる
     */
    public function test_register_validation()
    {
        $response = $this->post('/register', []);

        $response->assertSessionHasErrors([
            'name',
            'email',
            'password',
        ]);
    }

    /**
     * ID2：ログイン機能
     * 登録済みユーザーがログインできる
     */
    public function test_user_can_login()
    {
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => Hash::make('password123'),
        ]);

        $response = $this->post('/login', [
            'email' => 'test@example.com',
            'password' => 'password123',
        ]);

        $this->assertAuthenticatedAs($user);

        $response->assertRedirect();
    }

    /**
     * ID2：ログイン機能
     * 登録情報が一致しない場合、ログインできない
     */
    public function test_user_cannot_login_with_invalid_credentials()
    {
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => Hash::make('password123'),
        ]);

        $response = $this->post('/login', [
            'email' => 'test@example.com',
            'password' => 'wrong-password',
        ]);

        $this->assertGuest();

        $response->assertSessionHasErrors('email');
    }

    /**
     * ID3：ログアウト機能
     * ログイン中のユーザーがログアウトできる
     */
    public function test_user_can_logout()
    {

        /** @var User $user */
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->post('/logout');

        $this->assertGuest();

        $response->assertRedirect('/');
    }
}
