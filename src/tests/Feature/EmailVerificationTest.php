<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Illuminate\Auth\Notifications\VerifyEmail;
use Tests\TestCase;

class EmailVerificationTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    /** @test */
    public function 未認証ユーザーにはメール認証画面が表示される()
    {
        $user = User::find(1);

        $response = $this->actingAs($user)
            ->get('/email/verify');

        $response->assertStatus(200);
        $response->assertSee('メール認証');
    }

    /** @test */
    public function 認証済みユーザーはプロフィール設定画面へ遷移する()
    {
        $user = User::find(1);

        $user->markEmailAsVerified();

        $response = $this->actingAs($user)
            ->get('/email/verify');

        $response->assertRedirect('/mypage/profile');
    }
}
