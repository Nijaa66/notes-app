<?php

namespace Tests\Feature;

use App\Models\Note;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class NotesCrudTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    // public function test_example(): void
    // {
    //     $response = $this->get('/');

    //     $response->assertStatus(200);
    // }
    use RefreshDatabase;

    public function test_user_can_create_update_and_delete_note()
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        // Create
        $response = $this->post(route('notes.store'), [
            'title' => 'Test Note',
            'content' => 'This is a test note content.',
        ]);
        $response->assertRedirect(route('notes.index'));
        $this->assertDatabaseHas('notes', [
            'title' => 'Test Note',
            'content' => 'This is a test note content.',
            'user_id' => $user->id,
        ]);

        $note = Note::first();

        // Update
        $response = $this->put(route('notes.update', $note), [
            'title' => 'Updated Title',
            'content' => 'Updated content',
        ]);
        $response->assertRedirect(route('notes.index'));
        $this->assertDatabaseHas('notes', ['id' => $note->id, 'title' => 'Updated Title']);

        // Delete
        $response = $this->delete(route('notes.destroy', $note));
        $response->assertRedirect(route('notes.index'));
        $this->assertDatabaseMissing('notes', ['id' => $note->id]);
    }
}
