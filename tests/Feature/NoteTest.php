<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class NoteTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;
    public function authenticated_user_can_create_note()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->post(route('item.store'), [
                'title' => 'Test Note',
                'description' => 'This is a test note.',
                'created_at' => now()->format('Y-m-d'),
            ]);

        $response->assertRedirect(route('dashboard'));

        $this->assertDatabaseHas('items', [
            'title' => 'Test Note',
            'description' => 'This is a test note.',
        ]);
    }
}
