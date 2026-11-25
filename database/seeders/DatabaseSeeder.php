<?php

namespace Database\Seeders;

use App\Models\Media;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            MediaSeeder::class,
        ]);

        // Populate initial user collections so relational endpoints return sample data immediately.
        $users = User::all();
        $media = Media::all();

        if ($users->count() >= 3 && $media->count() >= 6) {
            $users[0]->media()->attach([$media[0]->id, $media[2]->id, $media[4]->id]);
            $users[1]->media()->attach([$media[1]->id, $media[3]->id]);
            $users[2]->media()->attach([$media[2]->id, $media[5]->id]);
        }
    }
}
