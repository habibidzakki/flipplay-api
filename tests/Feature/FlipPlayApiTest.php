<?php

namespace Tests\Feature;

use App\Models\Media;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FlipPlayApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_seeder_populates_users_and_media(): void
    {
        $this->seed();

        $this->assertGreaterThanOrEqual(3, User::count());
        $this->assertGreaterThanOrEqual(6, Media::count());
    }

    public function test_media_crud_and_search_work_correctly(): void
    {
        $this->seed();

        $searchResponse = $this->getJson('/api/media?search=Jujutsu');
        $searchResponse->assertOk()
            ->assertJsonCount(1, 'data')
            ->assertJsonPath('data.0.title', 'Jujutsu Kaisen');

        $invalidResponse = $this->postJson('/api/media', []);
        $invalidResponse->assertStatus(422)
            ->assertJsonValidationErrors(['title', 'type', 'genre'])
            ->assertJsonPath('errors.title.0', 'Judul media wajib diisi.');

        $createResponse = $this->postJson('/api/media', [
            'title' => 'Vinland Saga',
            'type' => 'anime',
            'genre' => 'Action, Historical',
            'episodes' => 48,
            'release_year' => 2019,
            'rating' => 8.8,
            'description' => 'Kisah perjalanan Thorfinn.',
        ]);

        $createResponse->assertStatus(201)
            ->assertJsonPath('data.title', 'Vinland Saga');

        $mediaId = $createResponse->json('data.id');

        $showResponse = $this->getJson("/api/media/{$mediaId}");
        $showResponse->assertOk()
            ->assertJsonStructure(['data' => ['id', 'title', 'type', 'genre', 'episodes', 'release_year', 'rating', 'description', 'users']]);

        $updateResponse = $this->putJson("/api/media/{$mediaId}", [
            'title' => 'Vinland Saga',
            'rating' => 9.0,
        ]);
        $updateResponse->assertOk()
            ->assertJsonPath('data.rating', 9);

        $deleteResponse = $this->deleteJson("/api/media/{$mediaId}");
        $deleteResponse->assertOk()
            ->assertExactJson(['message' => 'Media berhasil dihapus']);
    }

    public function test_user_collection_endpoints_work_correctly(): void
    {
        $this->seed();

        $user = User::first();
        $unattachedMedia = Media::whereDoesntHave('users', fn ($q) => $q->where('users.id', $user->id))->first();

        $this->getJson('/api/users')
            ->assertOk()
            ->assertJsonStructure(['data' => [['id', 'name', 'email', 'media']]]);

        $this->getJson("/api/users/{$user->id}")
            ->assertOk()
            ->assertJsonPath('data.id', $user->id);

        $this->postJson("/api/users/{$user->id}/collection", ['media_id' => $unattachedMedia->id])
            ->assertStatus(201)
            ->assertExactJson(['message' => 'Media berhasil ditambahkan ke koleksi']);

        $this->postJson("/api/users/{$user->id}/collection", ['media_id' => $unattachedMedia->id])
            ->assertStatus(409)
            ->assertExactJson(['message' => 'Media sudah ada di koleksi']);

        $this->deleteJson("/api/users/{$user->id}/collection/{$unattachedMedia->id}")
            ->assertOk()
            ->assertExactJson(['message' => 'Media berhasil dihapus dari koleksi']);

        $this->deleteJson("/api/users/{$user->id}/collection/{$unattachedMedia->id}")
            ->assertStatus(404)
            ->assertExactJson(['message' => 'Media tidak ditemukan di koleksi pengguna']);
    }
}
