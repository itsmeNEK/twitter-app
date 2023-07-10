<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FollowTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_follow_user(): void
    {

        $user1 = User::factory()->create();
        $user2 = User::factory()->create();

        $response = $this->actingAs($user1)
                        ->withSession(['banned' => false])
                        ->post('/api/follow/'.$user2->id);

        $response->assertStatus(200);

    }
    public function test_user_can_unfollow_user(): void
    {

        $user1 = User::factory()->create();
        $user2 = User::factory()->create();

        $response = $this->actingAs($user1)
                        ->withSession(['banned' => false])
                        ->delete('/api/follow/'.$user2->id);

        $response->assertStatus(200);
    }
    public function test_user_can_display_followers_user(): void
    {

        $user1 = User::factory()->create();

        $response = $this->actingAs($user1)
                        ->withSession(['banned' => false])
                        ->get('/api/followers');

        $response->assertStatus(200);
    }
    public function test_user_can_display_following_user(): void
    {

        $user1 = User::factory()->create();

        $response = $this->actingAs($user1)
                        ->withSession(['banned' => false])
                        ->get('/api/following');

        $response->assertStatus(200);
    }
    public function test_user_can_display_suggested_user(): void
    {

        $user1 = User::factory()->create();

        $response = $this->actingAs($user1)
                        ->withSession(['banned' => false])
                        ->get('/api/suggested');

        $response->assertStatus(200);
    }
}
