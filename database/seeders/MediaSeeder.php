<?php

namespace Database\Seeders;

use App\Models\Media;
use Illuminate\Database\Seeder;

class MediaSeeder extends Seeder
{
    /**
     * Seed dummy media catalog for FlipPlay.
     */
    public function run(): void
    {
        $mediaItems = [
            [
                'title' => 'Jujutsu Kaisen',
                'type' => 'anime',
                'genre' => 'Action, Dark Fantasy',
                'episodes' => 47,
                'release_year' => 2020,
                'rating' => 8.7,
                'description' => 'Yuji Itadori bergabung dengan organisasi rahasia penyihir Jujutsu untuk membasmi kutukan setelah menelan jari Sukuna.',
            ],
            [
                'title' => 'My Hero Academia',
                'type' => 'anime',
                'genre' => 'Action, Superhero',
                'episodes' => 159,
                'release_year' => 2016,
                'rating' => 8.4,
                'description' => 'Izuku Midoriya yang lahir tanpa kekuatan super mewarisi Quirk One For All dan berlatih menjadi pahlawan profesional.',
            ],
            [
                'title' => "Frieren: Beyond Journey's End",
                'type' => 'anime',
                'genre' => 'Adventure, Fantasy',
                'episodes' => 28,
                'release_year' => 2023,
                'rating' => 9.1,
                'description' => 'Penyihir elf Frieren memulai perjalanan baru untuk memahami arti persahabatan dan kefanaan hidup manusia.',
            ],
            [
                'title' => 'Demon Slayer: Kimetsu no Yaiba',
                'type' => 'anime',
                'genre' => 'Action, Historical Fantasy',
                'episodes' => 63,
                'release_year' => 2019,
                'rating' => 8.8,
                'description' => 'Tanjiro Kamado menjadi pemburu iblis demi membalaskan dendam keluarganya dan mengembalikan adiknya Nezuko menjadi manusia.',
            ],
            [
                'title' => 'Attack on Titan',
                'type' => 'anime',
                'genre' => 'Action, Mystery, Drama',
                'episodes' => 94,
                'release_year' => 2013,
                'rating' => 9.0,
                'description' => 'Umat manusia berjuang bertahan hidup di balik tembok raksasa melawan serangan para Titan pemakan manusia.',
            ],
            [
                'title' => 'Solo Leveling',
                'type' => 'anime',
                'genre' => 'Action, Fantasy',
                'episodes' => 25,
                'release_year' => 2024,
                'rating' => 8.6,
                'description' => 'Sung Jinwoo, hunter terlemah di dunia, memperoleh sistem misterius yang memungkinkannya terus naik level tanpa batas.',
            ],
            [
                'title' => 'Moving',
                'type' => 'drama',
                'genre' => 'Action, Sci-Fi, Thriller',
                'episodes' => 20,
                'release_year' => 2023,
                'rating' => 8.5,
                'description' => 'Sekelompok remaja dengan kekuatan super tersembunyi dan orang tua mereka menghadapi ancaman masa lalu.',
            ],
            [
                'title' => 'Spirited Away',
                'type' => 'movie',
                'genre' => 'Animation, Fantasy, Adventure',
                'episodes' => 1,
                'release_year' => 2001,
                'rating' => 8.9,
                'description' => 'Chihiro tersesat di dunia roh dan harus bekerja di pemandian milik penyihir Yubaba untuk menyelamatkan orang tuanya.',
            ],
        ];

        foreach ($mediaItems as $item) {
            Media::create($item);
        }
    }
}
