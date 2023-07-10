<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TweetTest extends TestCase
{
    use RefreshDatabase;

    public function test_tweet_screen_can_be_rendered(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
                        ->withSession(['banned' => false])
                        ->get('/api/tweet');

        $response->assertStatus(200);
    }

    public function test_user_can_add_tweet(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
                        ->withSession(['banned' => false])
                        ->post('/api/tweet', [
                            'tweet_body' => 'Random Tweet',
                            'user_id' => $user->id,
                            'file' => null,
                        ]);

        $response->assertStatus(200);
    }
    public function test_user_can_update_tweet(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
                        ->withSession(['banned' => false])
                        ->put('/api/tweet/1', [
                            'tweet_body' => 'Updated Tweet',
                        ]);

        $response->assertStatus(200);
    }
    public function test_user_can_delete_tweet(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
                        ->withSession(['banned' => false])
                        ->delete('/api/tweet/1');

        $response->assertStatus(200);
    }

}
